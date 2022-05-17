<?php

namespace Modules\Report\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Report\Models\Report;
use Modules\Report\Enums\ReportEnums;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequestHelper;
use App\Rules\ExistsSoftDeleteRule;
use Modules\Task\Models\TaskReport;

class ReportRequest extends ActiveFormRequest
{
    protected array $ignoredModelFields = ['images_list'];
    protected array $fileFields = [
        'images_list' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new Report()
        );
    }

    public function rules()
    {
        return [
            'task_report_id' => 'exists:task_report,id',

            'shop_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'shop', extraQuery: function ($query) {
                    $query->where('agent_id', auth()->user()->id)
                        ->where('is_active', 1);
                }),
            ],

            'type' => [
                'required',
                Rule::in(array_keys(ReportEnums::types())),
            ],
            'number' => [
                'required',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],

            'date_period_type' => [
                'required',
                Rule::in(array_keys(ReportEnums::datePeriodTypes())),
            ],
            'date_period_from' => [
                'required',
                'date',
                'date_format:d.m.Y',
                'before_or_equal:' . date('d.m.Y', strtotime('-1 week')),
            ],

            'images_list' => 'array',
            'images_list.*' => 'file|max:1024|mimes:jpg,png,webp',

            'products' => 'required|array',
            'products.*.id' => 'integer',
            'products.*.product_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'product', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
            ],
            'products.*.variation_id' => [
                new ExistsSoftDeleteRule($this->model, 'product_variation'),
            ],
            'products.*.supplier_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'shop_supplier', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
            ],
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {

                // Agent task report

                if ($this->task_report_id) {
                    $taskReport = TaskReport::query()->find($this->task_report_id);

                    if ($taskReport->task->agent_id != auth()->user()->id) {
                        $validator->errors()->add('task_report_id', 'rules.report.task_report_id.not_yours');
                    }
                }

                // Products

                $products = array_map(function ($value) {
                    $newValue = [
                        $value['product_id'],
                        $value['variation_id'] ?? null,
                        $value['supplier_id'],
                    ];

                    return implode('.', $newValue);
                }, $this->products);

                if (array_unique($products) != $products) {
                    $validator->errors()->add('products', 'rules.report.products.unique_combinations');
                }
            });
        }
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $taskReport = TaskReport::query()->find($this->task_report_id);

        if ($taskReport) {
            $this->merge([
                'shop_id' => $taskReport->shop_id,
                'type' => $taskReport->type,
                'date_period_type' => $taskReport->date_period_type,
            ]);
        }
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_MANY => [
                'products' => $this->products,
            ],
        ];
    }
}
