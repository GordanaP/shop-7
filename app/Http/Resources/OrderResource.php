<?php

namespace App\Http\Resources;

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
            'date' => $this->date(),
            'total' => number_format($this->total_in_cents / 100, 2),
            'ship_to' => $this->shipping ?? $this->user->customer,
            'links' => [
                'show_order' => route('users.orders.show', [$this->user, $this]),
            ]
        ];
    }
}
