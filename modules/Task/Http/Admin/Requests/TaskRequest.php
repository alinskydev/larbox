<?php

namespace Modules\Task\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Task\Models\Task;
use Modules\Task\Enums\TaskEnums;
use Modules\Report\Enums\ReportEnums;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequestHelper;
use App\Rules\ExistsSoftDeleteRule;

class TaskRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new Task()
        );
    }

    public function rules()
    {
        return [
            'agent_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'user', extraQuery: function ($query) {
                    $query->where('role', 'agent');
                }),
            ],

            'type' => [
                'required',
                Rule::in(array_keys(TaskEnums::types())),
            ],
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:4096',
            'execution_comment' => 'nullable|string|max:4096',
            'deadline' => 'required|date|date_format:d.m.Y',

            'reports' => 'required|array',
            'reports.*.id' => 'integer',
            'reports.*.shop_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'shop', extraQuery: function ($query) {
                    $query->where('agent_id', $this->agent_id);
                }),
            ],
            'reports.*.type' => [
                'required',
                Rule::in(array_keys(ReportEnums::types())),
            ],
            'reports.*.date_period_type' => [
                'required',
                Rule::in(array_keys(ReportEnums::datePeriodTypes())),
            ],
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $reports = array_map(function ($value) {
                    $newValue = [
                        $value['shop_id'],
                        $value['type'],
                        $value['date_period_type'],
                    ];

                    return implode('.', $newValue);
                }, $this->reports);

                if (array_unique($reports) != $reports) {
                    $validator->errors()->add('reports', 'rules.task.reports.unique_combinations');
                }
            });
        }
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_MANY => [
                'reports' => $this->reports,
            ],
        ];
    }
}
