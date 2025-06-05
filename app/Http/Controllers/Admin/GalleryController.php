<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        try {
            // Validate the request
            $request->validate([
                'images' => 'required|array|max:10',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max
            ]);

            $uploadedImages = [];
            $errors = [];

            foreach ($request->file('images') as $index => $file) {
                try {
                    // Check file size and type
                    if ($file->getSize() > 10 * 1024 * 1024) { // 10MB
                        $errors[] = "File {$file->getClientOriginalName()} is too large (max 10MB)";
                        continue;
                    }

                    // Store original image with unique name
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . $index . '.' . $extension;

                    $imagePath = $file->storeAs('gallery', $fileName, 'public');

                    // Create thumbnail
                    $thumbnailPath = null;
                    try {
                        $manager = new ImageManager(new Driver());
                        $thumbnailFileName = 'thumb_' . $fileName;
                        $thumbnailPath = 'gallery/thumbnails/' . $thumbnailFileName;

                        // Ensure thumbnails directory exists
                        Storage::disk('public')->makeDirectory('gallery/thumbnails');

                        $image = $manager->read(Storage::disk('public')->path($imagePath));

                        // Resize maintaining aspect ratio
                        $image->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

                        Storage::disk('public')->put($thumbnailPath, $image->encode());
                    } catch (\Exception $e) {
                        \Log::warning('Thumbnail creation failed: ' . $e->getMessage());
                        // If thumbnail creation fails, use original image
                        $thumbnailPath = $imagePath;
                    }

                    // Create database record
                    $galleryImage = GalleryImage::create([
                        'title' => $originalName,
                        'alt_text' => $originalName,
                        'image_path' => $imagePath,
                        'thumbnail_path' => $thumbnailPath,
                        'sort_order' => GalleryImage::max('sort_order') + 1,
                        'is_active' => true,
                    ]);

                    $uploadedImages[] = $galleryImage;

                    // Log the action
                    AdminActivityLog::logAction(
                        Auth::guard('admin')->user(),
                        'created',
                        $galleryImage,
                        null,
                        $galleryImage->toArray()
                    );

                } catch (\Exception $e) {
                    \Log::error('Failed to upload image: ' . $e->getMessage());
                    $errors[] = "Failed to upload {$file->getClientOriginalName()}: " . $e->getMessage();
                }
            }

            // Return response
            if (count($uploadedImages) > 0) {
                $message = count($uploadedImages) . ' image(s) uploaded successfully.';
                if (count($errors) > 0) {
                    $message .= ' ' . count($errors) . ' failed.';
                }

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'images' => $uploadedImages,
                    'errors' => $errors
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No images were uploaded successfully.',
                    'errors' => $errors
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Gallery upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
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
