<?php

namespace App\Traits\Product;

use App\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Imageable
{
    /**
     * The product's images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the product's main image.
     */
    public function mainImage(): string
    {
        if($main = $this->isMainImage()) {
            $image = App::make('image-manager')->getUrl($main);
        } else {
            $image = ($first = $this->images->first())
                ? App::make('image-manager')->getUrl($first)
                : asset($this->demoImagePath());
        }

        return $image;
    }

    /**
     * Get the product's thumbnail image.
     */
    public function thumbnailImage($image): string
    {
        return App::make('image-manager')->getUrl($image) ?? null;
    }

    /**
     * Determine if the product has the main image.
     */
    public function isMainImage(): ?Image
    {
        return $this->images->firstWhere('is_main', true);
    }

    /**
     * The image path in the pdf format.
     */
    public function pdfImage(): string
    {
        $product_image = $this->isMainImage();

        return $product_image
            ? public_path('/storage/'.$product_image->path)
            : public_path('/'.$this->demoImagePath());
    }

    /**
     * The demo image path.
     */
    private function demoImagePath(): string
    {
        // return 'images/demo_product.jpg';
        return 'images/strawberry-dessert.jpg';
    }
}
