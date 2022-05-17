<?php

namespace Modules\Report\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Modules\User\Models\User;
use Modules\Shop\Models\Shop;
use Modules\Task\Models\TaskReport;

class Report extends Model
{
    use SoftDeletes;

    protected $table = 'report';

    protected $fillable = [
        'shop_id',
        'task_report_id',
        'type',
        'number',
        'date_period_type',
        'date_period_from',
        'images_list',
    ];

    protected $casts = [
        'date_period_from' => 'date:d.m.Y',
        'date_period_to' => 'date:d.m.Y',
        'images_list' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id')->withTrashed();
    }

    public function task_report()
    {
        return $this->belongsTo(TaskReport::class, 'task_report_id');
    }

    public function products()
    {
        return $this->hasMany(ReportProduct::class, 'report_id')->orderBy('sort_index');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            switch ($model->date_period_type) {
                case 'week':
                    $model->date_period_to = Carbon::parse($model->date_period_from)->addWeek()->format('d.m.Y');
                    break;
                case 'month':
                    $model->date_period_to = Carbon::parse($model->date_period_from)->addMonth()->format('d.m.Y');
                    break;
            }
        });
    }
}
