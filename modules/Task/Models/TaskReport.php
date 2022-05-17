<?php

namespace Modules\Task\Models;

use App\Models\Model;
use Modules\Shop\Models\Shop;
use Modules\Report\Models\Report;

class TaskReport extends Model
{
    protected $table = 'task_report';
    
    protected $fillable = [
        'shop_id',
        'type',
        'date_period_type',
        'sort_index',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id')->withTrashed();
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id')->withTrashed();
    }

    public function report()
    {
        return $this->hasOne(Report::class, 'task_report_id')->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $report = $model->report;

            if ($report) {
                abort(403, __('errors.task_report.delete_used_by_report', [
                    'taskReport' => $model->id,
                    'report' => $report->id,
                ]));
            }
        });
    }
}
