<?php

namespace Modules\Box\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return array_replace_recursive(parent::toArray($request), [
            'full_slug' => $this->whenLoaded('parent', function () {
                return $this->fullField('slug', '/');
            }) ?: $this->slug,
            'full_text' => $this->whenLoaded('parent', function () {
                return $this->fullField('text', ' => ');
            }) ?: $this->text,

            'parent' => $this->when(false, false),
            'parents' => $this->whenLoaded('parent', function () {
                $parents = $this->parent->toArray();
                return $this->collectParents($parents);
            }) ?: [],
            'children' => $this->whenLoaded('children', function () {
                $children = $this->children->toArray();
                $this->appendChildrenFields($children);

                return $children;
            }),
        ]);
    }

    private function fullField(string $field, string $separator)
    {
        $result = [$this->{$field}];
        $parents = $this->parent->toArray();

        array_walk_recursive($parents, function ($value, $key) use (&$result, $field) {
            if ($key == $field) $result[] = $value;
        });

        $result = array_reverse($result);
        return implode($separator, $result);
    }

    private function collectParents(array $item, array $result = [])
    {
        $fullSlug = [];

        array_walk_recursive($item, function ($value, $key) use (&$fullSlug) {
            if ($key == 'slug') $fullSlug[] = $value;
        });

        $fullSlug = array_reverse($fullSlug);
        $item['full_slug'] = implode('/', $fullSlug);

        if ($item['parent']) {
            $result = $this->collectParents($item['parent']);
        }

        Arr::forget($item, 'parent');
        $result[] = $item;

        return $result;
    }

    private function appendChildrenFields(array &$items, array $prefix = [])
    {
        foreach ($items as &$item) {
            $item['full_slug'] = implode('/', array_merge($prefix, [$item['slug']]));

            if ($item['children']) {
                $this->appendChildrenFields($item['children'], array_merge($prefix, [$item['slug']]));
            }
        }
    }
}
