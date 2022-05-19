<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper
{
    public static function upload(UploadedFile $file, string $path)
    {
        $path = "storage/uploads/$path/" . date('Y-m-d');
        $name = md5(uniqid());
        $extension = $file->getClientOriginalExtension();

        $file->move($path, "$name.$extension");

        return "/$path/$name.$extension";
    }
}
