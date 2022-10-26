<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'full_slug' => $this->whenLoaded('ancestors', function () {
                $fullSlug = [$this->slug];
                $parents = $this->ancestors->toArray();

                array_walk_recursive($parents, function ($value, $key) use (&$fullSlug) {
                    if ($key == 'slug') $fullSlug[] = $value;
                });

                $fullSlug = array_reverse($fullSlug);
                return implode('/', $fullSlug);
            }) ?: $this->slug,

            'ancestors' => $this->when(false, false),
            'parents' => $this->whenLoaded('ancestors', function () {
                $parents = $this->ancestors->toArray();
                return $this->collectParents($parents);
            }) ?: [],
            'children' => $this->whenLoaded('children', function () {
                $children = $this->children->toArray();
                $this->appendChildrenFields($children);

                return $children;
            }),
        ]);
    }

    private function collectParents(array $item, array $result = [])
    {
        $fullSlug = [];

        array_walk_recursive($item, function ($value, $key) use (&$fullSlug) {
            if ($key == 'slug') $fullSlug[] = $value;
        });

        $fullSlug = array_reverse($fullSlug);
        $item['full_slug'] = implode('/', $fullSlug);

        if ($item['ancestors']) {
            $result = $this->collectParents($item['ancestors']);
        }

        Arr::forget($item, 'ancestors');
        $result[] = $item;

        return $result;
    }

    private function appendChildrenFields(array &$items, array $prefix = [])
    {
        foreach ($items as &$item) {
            $item['full_slug'] = implode('/', array_merge($prefix, [$item['slug']]));
            $item['ancestors'] = null;

            if ($item['children']) {
                $this->appendChildrenFields($item['children'], array_merge($prefix, [$item['slug']]));
            }
        }
    }
}
