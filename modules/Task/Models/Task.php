<?php

namespace Modules\Task\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Modules\User\Models\User;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'task';

    protected $fillable = [
        'agent_id',
        'type',
        'name',
        'description',
        'execution_comment',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date:d.m.Y',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id')->withTrashed();
    }

    public function reports()
    {
        return $this->hasMany(TaskReport::class, 'task_id')->orderBy('sort_index');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (Arr::get($model->original, 'agent_status') != 'completed' && $model->agent_status == 'completed') {
                foreach ($model->reports as $report) {
                    if (!$report->report) {
                        abort(403, __('errors.task.agent_status_incompleted'));
                    }
                }
            }
        });
    }
}
