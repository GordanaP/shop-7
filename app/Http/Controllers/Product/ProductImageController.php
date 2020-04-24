<?php

namespace App\Http\Controllers\Product;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Utilities\Images\ImageManager;

class ProductImageController extends Controller
{
    /**
     * The image manager.
     *
     * @var \App\Utilities\Images\ImageManager
     */
    protected $imageManager;

    /**
     * Create a new class instance.
     *
     * @param \App\Utilities\Images\ImageManager $imageManager
     */
    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, Product $product)
    {
        $this->imageManager->addManyToProduct($request->images, $product);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     */
    public function update(Request $request, Product $product, Image $image)
    {
        $this->imageManager->update($image, $product, $request->image);
        // if($request->manage_update == 'setMain')
        // {
        //     $this->imageManager->switchMain($image, $product);
        // } else {
        //     $this->imageManager->replace($image, $request->image);
        // }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product, Image $image): RedirectResponse
    {
        $this->imageManager->remove($image);

        // collect($request->delete_images)->map(function($image_id) use ($productImage){
        //     $image = Image::find($image_id);
        //     $productImage->removeStoragePath($image);
        //     $image->delete();
        // });

        return back();
    }
}
