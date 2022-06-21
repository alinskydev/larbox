<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\File;

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

    public static function delete(string $url)
    {
        if (app('settings')->delete_old_files) {
            File::delete($url);
        }
    }
}
