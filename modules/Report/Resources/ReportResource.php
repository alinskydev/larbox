<?php

namespace Modules\Report\Resources;

use App\Resources\JsonResource;
use App\Helpers\ImageHelper;
use Modules\User\Resources\UserResource;
use Modules\Shop\Resources\ShopResource;
use Modules\Task\Resources\TaskReportResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'shop_id' => $this->shop_id,
            'task_report_id' => $this->task_report_id,
            'type' => $this->type,
            'number' => $this->number,
            'date_period_type' => $this->date_period_type,
            'date_period_from' => $this->date_period_from->format('d.m.Y'),
            'date_period_to' => $this->date_period_to->format('d.m.Y'),
            'images_list' => array_map(fn ($value) => [
                'w_500' => ImageHelper::thumbnail($value, 'widen', [500]),
                'original' => asset($value),
            ], $this->images_list),
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'creator' => UserResource::make($this->whenLoaded('creator')),
            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'task_report' => TaskReportResource::make($this->whenLoaded('task_report')),
            'products' => ReportProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
