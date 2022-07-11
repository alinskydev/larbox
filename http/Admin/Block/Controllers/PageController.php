<?php

namespace Http\Admin\Block\Controllers;

use App\Http\Controllers\Controller;

use Modules\Block\Models\Page;
use Modules\Block\Resources\BlockResource;
use Http\Admin\Block\Requests\Page\HomeRequest;

class PageController extends Controller
{
    public function show(string $name)
    {
        $page = Page::query()->with(['blocks'])->where('name', $name)->firstOrFail();
        $blocks = $page->blocks->keyBy('name');

        $response = BlockResource::collection($blocks);

        return response()->json($response, 200);
    }

    // public function update(SettingsRequest $request)
    // {
    //     $data = $request->validated();

    //     $data = array_map(fn ($value, $key) => [
    //         'name' => $key,
    //         'value' => $value,
    //     ], $data, array_keys($data));

    //     Settings::upsert($data, 'name');

    //     return $this->index();
    // }
}
