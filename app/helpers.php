<?php
use Illuminate\Support\Str;

if (!function_exists('resolveImage')) {
    function resolveImage($image, $fallback = 'images/placeholder.png') {
        if (!$image) return asset($fallback);

        // Cek base64
        if (Str::startsWith($image, 'data:image')) {
            return $image;
        }

        // Cek apakah file path valid di public/
        if (file_exists(public_path($image))) {
            return asset($image);
        }

        // Fallback
        return asset($fallback);
    }
}
