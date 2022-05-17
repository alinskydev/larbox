<?php

namespace Modules\Shop\Resources;

use App\Resources\JsonResource;
use Modules\Region\Resources\RegionCityResource;
use Modules\Product\Resources\ProductBrandResource;

class ShopResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'agent_id' => $this->agent_id,
            'city_id' => $this->city_id,
            'company_id' => $this->company_id,
            'name' => $this->name,
            'address' => $this->address,
            'has_credit_line' => $this->has_credit_line,
            'location' => $this->location,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'agent' => RegionCityResource::make($this->whenLoaded('agent')),
            'city' => RegionCityResource::make($this->whenLoaded('city')),
            'company' => ShopCompanyResource::make($this->whenLoaded('company')),
            'suppliers' => ShopSupplierResource::collection($this->whenLoaded('suppliers')),
            'contacts' => ShopContactResource::collection($this->whenLoaded('contacts')),
            'brands' => ProductBrandResource::collection($this->whenLoaded('brands')),
        ];
    }
}
