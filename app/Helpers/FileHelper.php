<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function save(string $path, string $content, ?string $extension = null): string
    {
        $path = "storage/uploads/$path/" . date('Y-m-d');
        $name = uniqid() . '_' . Str::uuid();
        $name .= $extension ? ".$extension" : '';

        if (!is_dir($path)) mkdir($path, 0777, true);
        file_put_contents(base_path("$path/$name"), $content);

        return "$path/$name";
    }

    public static function upload(UploadedFile $file, string $path): string
    {
        $path = "storage/uploads/$path/" . date('Y-m-d');
        $name = uniqid() . '_' . Str::uuid();
        $extension = $file->getClientOriginalExtension();

        $file->move($path, "$name.$extension");

        return "$path/$name.$extension";
    }

    public static function delete(string $file): void
    {
        if (app('settings')->delete_old_files) {
            File::delete($file);
        }
    }
}
