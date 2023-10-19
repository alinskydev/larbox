<?php

namespace Http\Common\System\Controllers;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;
use Modules\Feedback\Enums\FeedbackStatusEnum;
use Modules\Section\Enums\SectionEnum;
use Modules\Section\Models\Section;
use Modules\System\Resources\SettingsResource;
use Modules\User\Enums\NotificationTypeEnum;
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
            'user_notification' => [
                'types' => NotificationTypeEnum::labels(),
            ],
        ];

        if (request()->get('show-all')) {
            $result = array_replace_recursive($result, [
                'feedback' => [
                    'statuses' => FeedbackStatusEnum::labels(),
                ],
                'user_role' => [
                    'routes' => [
                        'list' => RoleHelper::routesList(),
                        'tree' => RoleHelper::routesTree(),
                    ],
                ],
            ]);
        }

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
        return array_map(function ($value) {
            $path = lang_path($value['code']);

            return [
                'fields' => require("$path/fields.php"),
            ];
        }, app('language')->all);
    }
}
