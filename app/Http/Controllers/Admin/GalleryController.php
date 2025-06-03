<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index()
    {
        $images = GalleryImage::ordered()->get();
        
        return view('admin.gallery.index', compact('images'));
    }

    /**
     * Upload new gallery images.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        $uploadedImages = [];

        foreach ($request->file('images') as $file) {
            // Store original image
            $imagePath = $file->store('gallery', 'public');
            
            // Create thumbnail (optional - requires Intervention Image package)
            $thumbnailPath = null;
            try {
                $thumbnailPath = 'gallery/thumbnails/' . basename($imagePath);
                $thumbnail = Image::make(Storage::disk('public')->path($imagePath))
                    ->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());
            } catch (\Exception $e) {
                // If thumbnail creation fails, use original image
                $thumbnailPath = $imagePath;
            }

            $galleryImage = GalleryImage::create([
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'alt_text' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'image_path' => $imagePath,
                'thumbnail_path' => $thumbnailPath,
                'sort_order' => GalleryImage::max('sort_order') + 1,
                'is_active' => true,
            ]);

            $uploadedImages[] = $galleryImage;

            AdminActivityLog::logAction(
                Auth::guard('admin')->user(),
                'created',
                $galleryImage,
                null,
                $galleryImage->toArray()
            );
        }

        return response()->json([
            'success' => true,
            'message' => count($uploadedImages) . ' image(s) uploaded successfully.',
            'images' => $uploadedImages
        ]);
    }

    /**
     * Update the specified gallery image.
     */
    public function update(Request $request, GalleryImage $image)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $oldData = $image->toArray();
        $data = $request->only(['title', 'alt_text', 'sort_order', 'is_active']);
        $data['is_active'] = $request->boolean('is_active');

        $image->update($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $image,
            $oldData,
            $image->fresh()->toArray()
        );

        return response()->json([
            'success' => true,
            'message' => 'Image updated successfully.',
            'image' => $image
        ]);
    }

    /**
     * Remove the specified gallery image.
     */
    public function destroy(GalleryImage $image)
    {
        $oldData = $image->toArray();
        
        $image->delete();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.'
        ]);
    }

    /**
     * Update gallery images order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:gallery_images,id',
            'images.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->images as $imageData) {
            GalleryImage::where('id', $imageData['id'])
                ->update(['sort_order' => $imageData['sort_order']]);
        }

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'reordered',
            null,
            null,
            ['images' => $request->images]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Bulk delete gallery images.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'image_ids' => 'required|array',
            'image_ids.*' => 'required|exists:gallery_images,id',
        ]);

        $images = GalleryImage::whereIn('id', $request->image_ids)->get();
        $deletedCount = 0;

        foreach ($images as $image) {
            $oldData = $image->toArray();
            $image->delete();
            $deletedCount++;

            AdminActivityLog::logAction(
                Auth::guard('admin')->user(),
                'deleted',
                null,
                $oldData,
                null
            );
        }

        return response()->json([
            'success' => true,
            'message' => $deletedCount . ' image(s) deleted successfully.'
        ]);
    }
}
