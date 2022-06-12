<?php

namespace App\Http\Resources;

use App\Http\Controllers\helpers\HelperController;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'photo' => $this->model->product_photo,
            'name' => $this->model->product_name,
            'price' => $this->model->product_price,
            'quantity' => $this->quantity,
            'total' => HelperController::calculate_total($this->model->product_price, $this->quantity)
        ];
    }
}