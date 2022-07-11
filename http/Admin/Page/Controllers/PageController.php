<?php

namespace Http\Admin\Page\Controllers;

use App\Http\Controllers\Controller;
use Modules\Page\Models\Page;
use Modules\Page\Services\PageService;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class PageController extends Controller
{
    public Page $model;
    private array $config;

    public function __construct()
    {
        $name = request()->route()->parameter('name');

        $this->model = Page::query()->where('name', $name)->firstOrFail();
        $this->config = (new PageService($this->model))->config();

        // Binding FormRequest class

        app()->bind(ValidatesWhenResolved::class, $this->config['request']);
    }

    public function show()
    {
        $response = $this->config['resource']::collection($this->model->blocks);
        return response()->json($response, 200);
    }

    public function update(ValidatesWhenResolved $request)
    {
        $response = ['message' => 'Successfully saved'];
        return response()->json($response, 200);
    }
}
