<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
    private static array $availableThumbnailTypes = ['crop', 'fit', 'resize', 'widen'];

    public static function thumbnail(
        string $sourceUrl,
        string $type,
        array $params,
        bool $isAbsoluteThumbUrl = true
    ) {
        if (!in_array($type, self::$availableThumbnailTypes)) {
            throw new \Exception("Unavailable 'type'");
        }

        $sourceFile = public_path($sourceUrl);

        if (!is_file($sourceFile)) {
            return $isAbsoluteThumbUrl ? asset($sourceUrl) : $sourceUrl;
        }

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

        return $isAbsoluteThumbUrl ? asset($thumbUrl) : $thumbUrl;
    }

    public static function populateSizes(string $url, array $sizes)
    {
        $result = [
            'original' => asset($url),
        ];

        foreach ($sizes as $size) {
            $result["w_$size"] = ImageHelper::thumbnail($url, 'widen', [$size]);
        }

        return $result;
    }

    public static function clearSizes(array $urls)
    {
        $result = $urls['original'];
        return str_replace(asset(''), '/', $result);
    }
}
