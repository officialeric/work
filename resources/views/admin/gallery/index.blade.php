@extends('admin.layouts.app')

@section('title', 'Gallery Management')
@section('page-title', 'Gallery Management')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Gallery</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gallery Management</h1>
            <p class="text-gray-600 mt-1">Upload and organize images for the website gallery</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="toggleSelectMode()" 
                    id="select-mode-btn"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-check-square mr-2"></i>
                Select Mode
            </button>
            <button onclick="openUploadModal()" 
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                <i class="fas fa-upload mr-2"></i>
                Upload Images
            </button>
        </div>
    </div>

    <!-- Bulk Actions Bar (Hidden by default) -->
    <div id="bulk-actions" class="hidden bg-emerald-50 border border-emerald-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span id="selected-count" class="text-sm font-medium text-emerald-800">0 images selected</span>
                <button onclick="selectAll()" 
                        class="text-sm text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                    Select All
                </button>
                <button onclick="deselectAll()" 
                        class="text-sm text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                    Deselect All
                </button>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="bulkDelete()" 
                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>
                    Delete Selected
                </button>
                <button onclick="toggleSelectMode()" 
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-700 bg-white text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($images->count() > 0)
        <div id="gallery-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($images as $image)
                <div class="gallery-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200" 
                     data-id="{{ $image->id }}">
                    <!-- Selection Checkbox (Hidden by default) -->
                    <div class="selection-checkbox hidden absolute top-2 left-2 z-10">
                        <input type="checkbox" 
                               value="{{ $image->id }}"
                               class="w-5 h-5 text-emerald-600 bg-white border-2 border-white rounded focus:ring-emerald-500 focus:ring-2 shadow-lg">
                    </div>

                    <!-- Drag Handle -->
                    <div class="drag-handle absolute top-2 right-2 z-10 w-6 h-6 bg-black bg-opacity-50 rounded-full flex items-center justify-center cursor-move opacity-0 hover:opacity-100 transition-opacity duration-200">
                        <i class="fas fa-grip-vertical text-white text-xs"></i>
                    </div>

                    <!-- Image -->
                    <div class="relative aspect-square">
                        <img src="{{ $image->thumbnail_url }}" 
                             alt="{{ $image->alt_text ?: $image->title }}" 
                             class="w-full h-full object-cover">
                        
                        <!-- Status Badge -->
                        @if(!$image->is_active)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Inactive
                            </div>
                        @endif

                        <!-- Overlay Actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center opacity-0 hover:opacity-100">
                            <div class="flex space-x-2">
                                <button onclick="viewImage('{{ $image->image_url }}', '{{ $image->title }}')" 
                                        class="w-8 h-8 bg-white bg-opacity-90 rounded-full flex items-center justify-center text-gray-700 hover:bg-opacity-100 transition-all duration-200">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editImage({{ $image->id }})" 
                                        class="w-8 h-8 bg-white bg-opacity-90 rounded-full flex items-center justify-center text-gray-700 hover:bg-opacity-100 transition-all duration-200">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="deleteImage({{ $image->id }})" 
                                        class="w-8 h-8 bg-white bg-opacity-90 rounded-full flex items-center justify-center text-red-600 hover:bg-opacity-100 transition-all duration-200">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Image Info -->
                    <div class="p-3">
                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $image->title ?: 'Untitled' }}</h4>
                        <p class="text-xs text-gray-500 mt-1">Order: {{ $image->sort_order }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="text-center py-12">
                <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Images Found</h3>
                <p class="text-gray-500 mb-6">Get started by uploading your first images to the gallery.</p>
                <button onclick="openUploadModal()" 
                        class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                    <i class="fas fa-upload mr-2"></i>
                    Upload First Images
                </button>
            </div>
        </div>
    @endif
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Upload Images</h3>
            <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Upload Area -->
        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-emerald-400 transition-colors duration-200">
            <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
            <h4 class="text-lg font-medium text-gray-900 mb-2">Drop images here or click to browse</h4>
            <p class="text-gray-500 mb-4">Support for multiple images (PNG, JPG, GIF up to 5MB each)</p>
            <input type="file" id="image-input" multiple accept="image/*" class="hidden">
            <button onclick="document.getElementById('image-input').click()" 
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                <i class="fas fa-folder-open mr-2"></i>
                Browse Files
            </button>
        </div>

        <!-- Upload Progress -->
        <div id="upload-progress" class="hidden mt-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Uploading...</span>
                <span id="progress-text" class="text-sm text-gray-500">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="bg-emerald-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        <!-- Preview Area -->
        <div id="preview-area" class="hidden mt-6">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Selected Images</h4>
            <div id="preview-grid" class="grid grid-cols-3 gap-3 max-h-60 overflow-y-auto"></div>
        </div>

        <!-- Upload Actions -->
        <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
            <button onclick="closeUploadModal()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </button>
            <button id="upload-btn" onclick="uploadImages()" disabled
                    class="inline-flex items-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors duration-200">
                <i class="fas fa-upload mr-2"></i>
                Upload Images
            </button>
        </div>
    </div>
</div>

<!-- Image View Modal -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
    <div class="max-w-4xl max-h-[90vh] mx-4">
        <div class="relative">
            <img id="view-image" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-lg">
            <button onclick="closeViewModal()" 
                    class="absolute top-4 right-4 w-10 h-10 bg-black bg-opacity-50 text-white rounded-full flex items-center justify-center hover:bg-opacity-75 transition-all duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="text-center mt-4">
            <h3 id="view-title" class="text-white text-lg font-medium"></h3>
        </div>
    </div>
</div>

<!-- Edit Image Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Edit Image</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="edit-form" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="edit-title" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alt Text</label>
                <input type="text" id="edit-alt" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                <input type="number" id="edit-order" min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            
            <div>
                <label class="flex items-center">
                    <input type="checkbox" id="edit-active" 
                           class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 focus:ring-2">
                    <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>
        </form>

        <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
            <button onclick="closeEditModal()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </button>
            <button onclick="updateImage()" 
                    class="inline-flex items-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>
                Update
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
            <h3 class="text-lg font-medium text-gray-900">Delete Image</h3>
        </div>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this image? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Cancel
            </button>
            <button id="confirm-delete-btn" onclick="confirmDelete()" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                Delete
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    let selectedFiles = [];
    let currentEditId = null;
    let currentDeleteId = null;
    let selectMode = false;
    let selectedImages = new Set();

    // Initialize sortable gallery
    const galleryGrid = document.getElementById('gallery-grid');
    if (galleryGrid) {
        new Sortable(galleryGrid, {
            animation: 150,
            handle: '.drag-handle',
            onEnd: function(evt) {
                updateOrder();
            }
        });
    }

    // File input change handler
    document.getElementById('image-input').addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    // Drag and drop handlers
    const uploadArea = document.getElementById('upload-area');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('border-emerald-400', 'bg-emerald-50');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('border-emerald-400', 'bg-emerald-50');
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        selectedFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
        
        if (selectedFiles.length === 0) {
            alert('Please select valid image files.');
            return;
        }

        showPreview();
        document.getElementById('upload-btn').disabled = false;
    }

    function showPreview() {
        const previewArea = document.getElementById('preview-area');
        const previewGrid = document.getElementById('preview-grid');
        
        previewGrid.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}" class="w-full h-20 object-cover rounded-lg">
                    <button onclick="removeFile(${index})" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                previewGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        
        previewArea.classList.remove('hidden');
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        if (selectedFiles.length === 0) {
            document.getElementById('preview-area').classList.add('hidden');
            document.getElementById('upload-btn').disabled = true;
        } else {
            showPreview();
        }
    }

    function openUploadModal() {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.getElementById('uploadModal').classList.add('flex');
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.getElementById('uploadModal').classList.remove('flex');
        selectedFiles = [];
        document.getElementById('preview-area').classList.add('hidden');
        document.getElementById('upload-progress').classList.add('hidden');
        document.getElementById('image-input').value = '';
        document.getElementById('upload-btn').disabled = true;
    }

    function uploadImages() {
        if (selectedFiles.length === 0) return;

        const formData = new FormData();
        selectedFiles.forEach(file => {
            formData.append('images[]', file);
        });

        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const uploadProgress = document.getElementById('upload-progress');
        
        uploadProgress.classList.remove('hidden');
        document.getElementById('upload-btn').disabled = true;

        fetch('{{ route("admin.gallery.upload") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                progressBar.style.width = '100%';
                progressText.textContent = '100%';
                
                setTimeout(() => {
                    closeUploadModal();
                    location.reload();
                }, 1000);
            } else {
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Upload failed. Please try again.');
        })
        .finally(() => {
            document.getElementById('upload-btn').disabled = false;
        });
    }

    function viewImage(url, title) {
        document.getElementById('view-image').src = url;
        document.getElementById('view-title').textContent = title || 'Untitled';
        document.getElementById('viewModal').classList.remove('hidden');
        document.getElementById('viewModal').classList.add('flex');
    }

    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.getElementById('viewModal').classList.remove('flex');
    }

    function editImage(id) {
        currentEditId = id;
        // You would fetch the image data here and populate the form
        // For now, we'll just open the modal
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        currentEditId = null;
    }

    function updateImage() {
        if (!currentEditId) return;

        const data = {
            title: document.getElementById('edit-title').value,
            alt_text: document.getElementById('edit-alt').value,
            sort_order: document.getElementById('edit-order').value,
            is_active: document.getElementById('edit-active').checked
        };

        fetch(`/admin/gallery/${currentEditId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditModal();
                location.reload();
            } else {
                alert('Update failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Update failed. Please try again.');
        });
    }

    function deleteImage(id) {
        currentDeleteId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        currentDeleteId = null;
    }

    function confirmDelete() {
        if (!currentDeleteId) return;

        fetch(`/admin/gallery/${currentDeleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeDeleteModal();
                location.reload();
            } else {
                alert('Delete failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Delete failed. Please try again.');
        });
    }

    function toggleSelectMode() {
        selectMode = !selectMode;
        const checkboxes = document.querySelectorAll('.selection-checkbox');
        const bulkActions = document.getElementById('bulk-actions');
        const selectBtn = document.getElementById('select-mode-btn');

        if (selectMode) {
            checkboxes.forEach(cb => cb.classList.remove('hidden'));
            bulkActions.classList.remove('hidden');
            selectBtn.innerHTML = '<i class="fas fa-times mr-2"></i>Cancel Select';
            selectBtn.classList.add('bg-red-50', 'text-red-600', 'border-red-200');
        } else {
            checkboxes.forEach(cb => cb.classList.add('hidden'));
            bulkActions.classList.add('hidden');
            selectBtn.innerHTML = '<i class="fas fa-check-square mr-2"></i>Select Mode';
            selectBtn.classList.remove('bg-red-50', 'text-red-600', 'border-red-200');
            deselectAll();
        }
    }

    function selectAll() {
        const checkboxes = document.querySelectorAll('.selection-checkbox input');
        checkboxes.forEach(cb => {
            cb.checked = true;
            selectedImages.add(cb.value);
        });
        updateSelectedCount();
    }

    function deselectAll() {
        const checkboxes = document.querySelectorAll('.selection-checkbox input');
        checkboxes.forEach(cb => {
            cb.checked = false;
        });
        selectedImages.clear();
        updateSelectedCount();
    }

    function updateSelectedCount() {
        document.getElementById('selected-count').textContent = `${selectedImages.size} images selected`;
    }

    function bulkDelete() {
        if (selectedImages.size === 0) {
            alert('Please select images to delete.');
            return;
        }

        if (!confirm(`Are you sure you want to delete ${selectedImages.size} selected images? This action cannot be undone.`)) {
            return;
        }

        fetch('{{ route("admin.gallery.bulk-delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                image_ids: Array.from(selectedImages)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Bulk delete failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bulk delete failed. Please try again.');
        });
    }

    function updateOrder() {
        const items = document.querySelectorAll('.gallery-item');
        const images = [];
        
        items.forEach((item, index) => {
            images.push({
                id: item.dataset.id,
                sort_order: index + 1
            });
        });

        fetch('{{ route("admin.gallery.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ images: images })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update sort order display
                items.forEach((item, index) => {
                    const orderText = item.querySelector('p');
                    if (orderText) {
                        orderText.textContent = `Order: ${index + 1}`;
                    }
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Handle checkbox changes
    document.addEventListener('change', function(e) {
        if (e.target.matches('.selection-checkbox input')) {
            if (e.target.checked) {
                selectedImages.add(e.target.value);
            } else {
                selectedImages.delete(e.target.value);
            }
            updateSelectedCount();
        }
    });
</script>
@endpush
