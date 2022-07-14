<?php

namespace Http\Admin\Section\Controllers;

use App\Http\Controllers\Controller;
use Modules\Section\Models\Section;
use Modules\Section\Enums\SectionEnums;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class SectionController extends Controller
{
    public Section $model;
    private array $config;

    public function __construct()
    {
        $name = request()->route()->parameter('name');

        $this->model = Section::query()->where('name', $name)->firstOrFail();
        $this->config = SectionEnums::config($name);

        app()->bind(ValidatesWhenResolved::class, $this->config['admin_request']);
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
