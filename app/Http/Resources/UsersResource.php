<?php

namespace App\Http\Resources;

use App\Http\Controllers\helpers\HelperController;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'last_login' => HelperController::format_date($this->last_login),
            'created_at' => HelperController::pretty_date($this->created_at),
        ];
    }
}