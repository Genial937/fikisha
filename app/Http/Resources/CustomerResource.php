<?php

namespace App\Http\Resources;

use App\Http\Controllers\helpers\HelperController;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'created_at' => HelperController::pretty_date($this->created_at),
            'last_login' => $this->last_login ? HelperController::format_date($this->last_login) : 'Never logged in',
            'orders' => $this->orders ? $this->orders->count() : 0,
        ];
    }
}