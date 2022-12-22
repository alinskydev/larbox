<?php

namespace Http\Common\System\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Modules\System\Resources\SettingsResource;
use Modules\User\Helpers\RoleHelper;

use Modules\Section\Models\Section;
use Modules\Section\Enums\SectionEnums;

use Modules\Feedback\Enums\FeedbackEnums;
use Modules\User\Enums\NotificationEnums;

class SystemController extends Controller
{
    public function index(): JsonResponse
    {
        $response = [
            'settings' => SettingsResource::collection(app('settings')->items),
            'languages' => app('language'),
            'enums' => $this->enums(),
            'sections' => $this->sections(),
            'translations' => $this->translations(),
        ];

        return response()->json($response, 200);
    }

    private function enums(): array
    {
        $result = [
            'user_notification' => [
                'types' => NotificationEnums::types(),
            ],
        ];

        if (request()->get('show-all')) {
            $result = array_replace_recursive($result, [
                'feedback' => [
                    'statuses' => FeedbackEnums::statuses(),
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
        $sectionConfigs = SectionEnums::config();
        $sections = Section::query()->with(['seo_meta_morph'])->orderBy('name')->get()->keyBy('name');

        return $sections
            ->map(function ($section, $key) use ($sectionConfigs) {
                return array_merge(
                    $sectionConfigs[$key]['resource']::make($section->blocks)->resolve(),
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
