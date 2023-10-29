<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;

class ImageManager
{
    private const DISK = 'public';
    private const CATALOG = '/images';

    public static function save($data){
        return Storage::disk('public')->put('/images', $data);
    }
}
