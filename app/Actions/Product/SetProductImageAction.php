<?php

namespace App\Actions\Product;

use App\Models\Products\Product;
use App\Support\HelperSupport;
use Exception;
use Illuminate\Support\Facades\File;
//use File;
use Illuminate\Support\Facades\Storage;

class SetProductImageAction
{
    public function execute(Product $product, $image)
    {
        try{
            ! Storage::exists('public/images') ? Storage::createDirectory('public/images') : null;

            $mimeType = HelperSupport::getMimeTypeFromBase64($image);

            $extension = HelperSupport::getFileExtensionFromMimeType($mimeType);

            $filename = "{$product->slug}.{$extension}";

            //path to old image
            $oldImage = "public/images/{$product->image_name}";

            // this deletes the product image file if exists.
            Storage::exists($oldImage) ? Storage::delete($oldImage) : null;

            //path to store
            $path = "public/images/{$filename}";

            File::put(Storage::path($path), base64_decode($image));

            $url = asset(str_replace('public', 'storage', $path));

            $product->update([
                'image_url' => $url,
                'image_name' => $filename,
            ]);
        }catch(Exception $ex){
            throw new Exception("Could not set product image - {$ex->getMessage()}");
        }
    }
}
