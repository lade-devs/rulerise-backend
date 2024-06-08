<?php

namespace App\Http\Resources;

use App\Support\HelperSupport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $response = collect(parent::toArray($request))->except([
            'id',
            'created_at',
            'deleted_at',
            'updated_at'
        ])->toArray();

        return HelperSupport::snake_to_camel($response);
    }
}
