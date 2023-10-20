<?php

namespace Http\Common\System\Controllers;

use App\Base\Controller;
use App\Helpers\ClassHelper;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;
use Modules\Section\Enums\SectionEnum;
use Modules\Section\Models\Section;
use Modules\System\Resources\SettingsResource;
use Modules\User\Helpers\RoleHelper;

class SystemController extends Controller
{
    public function index(): Response
    {
        $response = [
            'settings' => $this->settings(),
            'languages' => app('language'),
            'enums' => $this->enums(),
            'sections' => $this->sections(),
            'translations' => $this->translations(),
        ];

        return response()->json($response, 200);
    }

    private function settings()
    {
        return Arr::only(
            SettingsResource::collection(app('settings')->items)->resolve(),
            ['favicon', 'logo', 'project_name'],
        );
    }

    private function enums(): array
    {
        $result = [
            'User.Role.RoutesList' => RoleHelper::routesList(false),
            'User.Role.RoutesTree' => RoleHelper::routesTree(false),
        ];

        $types = ['Enum', 'JsonTemplate'];

        foreach ($types as $type) {
            $files = glob(base_path("modules/*/{$type}s/*.php"));

            $pattern = "/^\\\Modules\\\|\\\\{$type}s\\\|$type$/";

            foreach ($files as $file) {
                $class = ClassHelper::classByFile($file);
                $name = preg_replace_array($pattern, ['', '.', ''], $class);

                $result[$name] = method_exists($class, 'labels') ? $class::labels() : $class::cases();
            }
        }

        Arr::forget($result, [
            'Section.Section',
        ]);

        $result = Arr::undot($result);

        ksort($result);

        return $result;
    }

    private function sections(): array
    {
        $sections = Section::query()->with(['seo_meta_morph'])->orderBy('name')->get()->keyBy('name');

        return $sections
            ->map(function ($section, $key) {
                return array_merge(
                    SectionEnum::classByPath("$key.resource")::make($section->blocks)->resolve(),
                    [
                        'seo_meta' => $section->seo_meta,
                        'seo_meta_as_array' => $section->seo_meta_as_array,
                    ],
                );
            })
            ->toArray();
    }

    private function translations(): array
    {
        $path = lang_path(app('language')->all[app()->getLocale()]['code']);

        return [
            'fields' => require("$path/fields.php"),
        ];
    }
}
