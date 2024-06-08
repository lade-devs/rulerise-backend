<?php

namespace App\Actions\Product;

use App\Models\Products\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use KodeDict\PHPUtil\PhpUtil;

class CreateProductAction
{
    public function execute(array $attributes) : ? Product
    {
        $imageFile = $attributes['imageFile'];

        $attributes = collect($attributes)->except(['imageFile'])->toArray();

        $code = PhpUtil::randomNumber(0,9,6);

        $attributes['code'] = $code;

        $attributes['slug'] = Str::slug($attributes['name'])."-{$code}";

        $attributes['uuid'] = Str::uuid();

        DB::beginTransaction();
        try{
            $product = Product::query()->create($attributes);

            (new SetProductImageAction)->execute($product, $imageFile);

            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            Log::error("Error @ CreateProductAction - {$ex->getMessage()}");
            return null;
        }

        return $product;
    }
}
