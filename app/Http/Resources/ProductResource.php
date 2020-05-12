<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'slug' => $this->slug,
            'main_img' => $this->mainImage(),
            'name' => $this->title,
            'subtitle' => $this->subtitle,
            'rating' => $this->userRating(Auth::user()),
            'avg_rating' => $this->avgRating(),
            'links' => [
                'show_product' => route('products.show', $this),
            ]
        ];
    }
}
