<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'date' => Carbon::parse($this->payment_created_at)->format('Y-m-d'),
            'total' => number_format($this->total_in_cents / 100, 2),
            'ship_to' => $this->shipping ?? $this->user->customer
        ];
    }
}
