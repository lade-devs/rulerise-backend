<?php

namespace App\Actions\Product;

use App\Models\Products\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateProductAction
{
    public function execute(Product $product, array $attributes) : ? Product
    {
        $imageFile = $attributes['imageFile'];

        $attributes = collect($attributes)->except(['imageFile'])->toArray();

        $attributes['slug'] = Str::slug($attributes['name'])."-{$product->code}";

        DB::beginTransaction();
        try{
            $product->update($attributes);

            (new SetProductImageAction)->execute($product, $imageFile);

            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            Log::error("Error @ UpdateProductAction - {$ex->getMessage()}");
            return null;
        }

        return $product;
    }
}
