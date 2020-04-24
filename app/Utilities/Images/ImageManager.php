<?php

namespace App\Utilities\Images;

use Storage;

class ImageManager
{
    /**
     * The storage disk.
     *
     * @var string
     */
    private $disk = 'products';

    /**
     * The image path attribute.
     *
     * @var string
     */
    private $path_attr = 'path';

    /**
     * The image is_main attribute.
     *
     * @var string
     */
    private $is_main_attr = 'is_main';

    /**
     * The status value.
     *
     * @var string
     */
    private $status_value = 'main';

    /**
     * The status key.
     *
     * @var string
     */
    private $status_key;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->status_key = request('status_key');
    }

    /**
     * Get the image's url.
     *
     * @param  \App\Image $image|null
     */
    public function getUrl($image = null): string
    {
        $path_attr = $this->path_attr;

        return Storage::url(optional($image)->$path_attr);
    }

    /**
     * Remove both the image path and the storage path.
     *
     * @param  \App\Image $image
     */
    public function remove($image)
    {
        $this->removeStoragePath($image);

        $image->delete();
    }

    /**
     * Update the image.
     *
     * @param  \App\Image $image
     * @param  \App\Product $product
     * @param  array $request_data
     */
    public function update($image, $product, $request_data)
    {
        $this->status_key == $this->status_value
            ? $this->switchMain($image, $product)
            : $this->replace($image, $request_data);
    }

    /**
     * Replace the image with the other one.
     *
     * @param  \App\Image $image
     * @param  array $request_data
     */
    public function replace($image, $request_data)
    {
        $this->removeStoragePath($image);

        $image->update($this->setImagePath($request_data));
    }

    /**
     * Switch the main image.
     *
     * @param  \App\Image $image
     * @param  \App\Product $product
     */
    public function switchMain($image, $product)
    {
        optional($product->isMainImage())
            ->update($this->setAsThumbnail());

        $image->update($this->setAsMain());
    }

    /**
     * Add many images to the product.
     *
     * @param array  $request_data
     * @param \App\Product $product
     */
    public function addManyToProduct($request_data, $product)
    {
        $images = collect($request_data)->map(function($image) {
            return $this->setImagePath($image);
        });

        $product->images()->createMany($images);
    }

    /**
     * Add one image to the product.
     *
     * @param array  $request_data
     * @param \App\Product $product
     */
    public function addOne($request_data, $product)
    {
        $product->images()->create($this->setImagePath($request_data));
    }

    /**
     * Set the image as main.
     */
    private function setAsMain(): array
    {
        return [
            $this->is_main_attr => true
        ];
    }

    /**
     * Set the image as thumbnail.
     */
    private function setAsThumbnail(): array
    {
        return [
            $this->is_main_attr => false
        ];
    }

    /**
     * Set the image path.
     *
     * @param  array $request_data
     */
    private function setImagePath($request_data): array
    {
        return [
            $this->path_attr => $this->storagePath($request_data)
        ];
    }

    /**
     * Remove the storage path.
     *
     * @param  \App\Image  $image
     */
    private function removeStoragePath($image)
    {
        $path_attr = $this->path_attr;

        Storage::delete($image->$path_attr);
    }

    /**
     * The storage path.
     *
     * @param  array $request_data|null
     */
    private function storagePath($request_data = null): ?string
    {
        return optional($request_data)->store($this->disk);
    }
}
