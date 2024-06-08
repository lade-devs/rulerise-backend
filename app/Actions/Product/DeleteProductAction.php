<?php

namespace App\Actions\Product;

use App\Models\Products\Product;

class DeleteProductAction
{
    public function execute(Product $product) : ? bool
    {
        return $product->delete();
    }
}
