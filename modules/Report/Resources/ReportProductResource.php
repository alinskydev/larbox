<?php

namespace Modules\Report\Resources;

use App\Resources\JsonResource;
use Modules\Product\Resources\ProductResource;
use Modules\Product\Resources\ProductVariationResource;
use Modules\Shop\Resources\ShopSupplierResource;

class ReportProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'variation_id' => $this->variation_id,
            'supplier_id' => $this->supplier_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),

            'product' => ProductResource::make($this->whenLoaded('product')),
            'variation' => ProductVariationResource::make($this->whenLoaded('variation')),
            'supplier' => ShopSupplierResource::make($this->whenLoaded('supplier')),
        ];
    }
}
