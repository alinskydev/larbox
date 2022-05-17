<?php

namespace Modules\Report\Enums;

class ReportEnums
{
    public static function types(): array
    {
        return [
            'ds' => [
                'label' => 'Display Share',
                'description' => __('enums.report.type.ds.description'),
            ],
            'sr' => [
                'label' => 'Sales Report',
                'description' => __('enums.report.type.sr.description'),
            ],
        ];
    }

    public static function datePeriodTypes(): array
    {
        return [
            'week' => [
                'label' => __('enums.report.date_period_type.week'),
            ],
            'month' => [
                'label' => __('enums.report.date_period_type.month'),
            ],
        ];
    }
}
