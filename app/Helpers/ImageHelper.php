<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
    private static array $availableThumbnailTypes = ['crop', 'fit', 'resize', 'widen'];

    public static function thumbnail(string $sourceUrl, string $type, array $params): string
    {
        if (!in_array($type, self::$availableThumbnailTypes)) throw new \Exception("Unavailable 'type'");

        try {
            $sourceFile = public_path($sourceUrl);

            if (!is_file($sourceFile)) throw new \Exception('File not exists');

            $extension = pathinfo($sourceFile, PATHINFO_EXTENSION);
            $extension = mb_strtolower($extension);

            $thumbPath = "storage/thumbs/$type/" . implode('x', $params);
            $thumbName = md5(filemtime($sourceFile) . File::basename($sourceFile)) . ".$extension";

            $thumbFile = public_path("$thumbPath/$thumbName");
            $thumbUrl = "/$thumbPath/$thumbName";

            if (!is_file($thumbFile)) {
                File::makeDirectory(public_path($thumbPath), 0777, true, true);

                $image = ImageManagerStatic::make($sourceFile);
                $image->{$type}(...$params);
                $image->save($thumbFile);
            }

            return $thumbUrl;
        } catch (\Throwable $e) {
            return $sourceUrl;
        }
    }

    public static function populateSizes(string $url, array $sizes): array
    {
        $result = [
            'original' => asset($url),
        ];

        foreach ($sizes as $size) {
            $sizeParams = explode('_', $size);

            $thumb = self::thumbnail($url, array_shift($sizeParams), $sizeParams);
            $thumb = asset($thumb);

            $result[$size] = asset($thumb);
        }

        return $result;
    }

    public static function clearSizes(array $urls): string
    {
        return str_replace(asset(''), '/', $urls['original']);
    }
}
