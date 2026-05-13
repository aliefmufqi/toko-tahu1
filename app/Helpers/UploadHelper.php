<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadHelper
{
    public static function upload($file, $folder = 'tahubalap')
    {
        return cloudinary()->upload($file->getRealPath(), [
            'folder' => 'tahubalap/' . $folder,
        ])->getSecurePath();
    }

    public static function url($path)
    {
        if (!$path) return null;
        if (str_starts_with($path, 'http')) return $path;
        return Storage::url($path);
    }
}