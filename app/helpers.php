<?php

if (!function_exists('storage_asset')) {
    /**
     * Generate a URL for a storage asset that works with cPanel deployment structure.
     *
     * @param string $path
     * @return string
     */
    function storage_asset($path)
    {
        // Handle empty or null paths
        if (empty($path)) {
            return '';
        }

        // If it's already a full URL, return as-is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Remove 'public/' prefix if present
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        // For cPanel deployment, use the storage route
        // This will use APP_URL from .env to generate the correct domain
        // Laravel is auto-naming this route as 'storage.local'
        return route('storage.local', ['path' => $path]);
    }
}

if (!function_exists('storage_url')) {
    /**
     * Alias for storage_asset for consistency with Laravel's Storage::url()
     * 
     * @param string $path
     * @return string
     */
    function storage_url($path)
    {
        return storage_asset($path);
    }
}
