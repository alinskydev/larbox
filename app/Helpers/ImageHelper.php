<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
    private static array $availableThumbnailMethods = ['original', 'crop', 'fit', 'resize', 'widen'];

    public static function thumbnail(
        string $sourceUrl,
        string $method,
        array $params = [],
        bool $asWebp = false,
    ): string {
        if (!in_array($method, self::$availableThumbnailMethods)) throw new \Exception("Unavailable 'method'");

        try {
            $sourceFile = public_path($sourceUrl);

            if (!is_file($sourceFile)) throw new \Exception('File not exists');

            if ($asWebp) {
                $extension = 'webp';
            } else {
                $extension = pathinfo($sourceFile, PATHINFO_EXTENSION);
                $extension = mb_strtolower($extension);
            }

            $thumbPath = "storage/thumbs/$method";
            $thumbPath .= $params ? '/' . implode('x', $params) : '';
            $thumbName = md5(filemtime($sourceFile) . File::basename($sourceFile)) . ".$extension";

            $thumbFile = public_path("$thumbPath/$thumbName");
            $thumbUrl = "/$thumbPath/$thumbName";

            if (!is_file($thumbFile)) {
                File::makeDirectory(public_path($thumbPath), 0777, true, true);

                $image = ImageManagerStatic::make($sourceFile);

                if ($method != 'original') $image->{$method}(...$params);
                if ($asWebp) $image->encode('webp', 100);

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
            'original' => [
                'raw' => asset($url),
                'webp' => asset(self::thumbnail(
                    sourceUrl: $url,
                    method: 'original',
                    asWebp: true,
                )),
            ],
        ];

        $types = ['raw' => false, 'webp' => true];

        foreach ($sizes as $size) {
            foreach ($types as $type => $asWebp) {
                $sizeParams = explode('_', $size);

                $thumb = self::thumbnail(
                    sourceUrl: $url,
                    method: array_shift($sizeParams),
                    params: $sizeParams,
                    asWebp: $asWebp,
                );

                $result[$size][$type] = asset($thumb);
            }
        }

        return $result;
    }
}
