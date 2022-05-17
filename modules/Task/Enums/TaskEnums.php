<?php

namespace Modules\Task\Enums;

class TaskEnums
{
    public static function types(): array
    {
        return [
            'v' => [
                'label' => 'v',
            ],
            's' => [
                'label' => 's',
            ],
        ];
    }

    public static function agentStatuses(): array
    {
        return [
            'opened' => [
                'label' => __('enums.task.agent_status.opened'),
            ],
            'in_progress' => [
                'label' => __('enums.task.agent_status.in_progress'),
            ],
            'completed' => [
                'label' => __('enums.task.agent_status.completed'),
            ],
            'overdue' => [
                'label' => __('enums.task.agent_status.overdue'),
            ],
        ];
    }

    public static function adminStatuses(): array
    {
        return [
            'unchecked' => [
                'label' => __('enums.task.admin_status.unchecked'),
            ],
            'moderating' => [
                'label' => __('enums.task.admin_status.moderating'),
            ],
            'accepted' => [
                'label' => __('enums.task.admin_status.accepted'),
            ],
            'declined' => [
                'label' => __('enums.task.admin_status.declined'),
            ],
        ];
    }
}
