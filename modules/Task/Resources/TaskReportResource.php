<?php

namespace Modules\Task\Resources;

use App\Resources\JsonResource;
use Modules\Shop\Resources\ShopResource;
use Modules\Report\Resources\ReportResource;

class TaskReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'type' => $this->type,
            'date_period_type' => $this->date_period_type,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),

            'shop' => ShopResource::make($this->whenLoaded('shop')),
            'report' => ReportResource::make($this->whenLoaded('report')),
        ];
    }
}
