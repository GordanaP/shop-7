<?php

namespace App\Utilities\Images;

use Storage;
use App\Utilities\Images\CustomImage;

class ProductImage extends CustomImage
{
    /**
     * Manage the image store/remove.
     *
     * @param  \App\Product $product
     * @param  \Illuminate\Http\UploadedFile $file
     */
    public function manage($product, $file)
    {
        $this->setDisk('products')
            ->setRelationship($product->images())
            ->handle($product->image, $file);
    }
}