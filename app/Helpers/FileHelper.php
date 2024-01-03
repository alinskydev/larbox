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

        $fullPath = public_path($path);

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777, true);
            chown($fullPath, 'www-data');
        }

        file_put_contents("$fullPath/$name", $content);
        chown("$fullPath/$name", 'www-data');

        return "$path/$name";
    }

    public static function upload(UploadedFile $file, string $path): string
    {
        $path = "storage/uploads/$path/" . date('Y-m-d');
        $extension = $file->getClientOriginalExtension();
        $name = uniqid() . '_' . Str::uuid();
        $name .= $extension ? ".$extension" : '';

        $fullPath = public_path($path);

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777, true);
            chown($fullPath, 'www-data');
        }

        $file->move($fullPath, $name);
        chown("$fullPath/$name", 'www-data');

        return "$path/$name";
    }

    public static function delete(string $file): void
    {
        if (app('settings')->delete_old_files) {
            File::delete($file);
        }
    }
}
