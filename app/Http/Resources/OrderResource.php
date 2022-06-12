<?php

namespace App\Http\Resources;

use App\Http\Controllers\helpers\HelperController;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_date' => HelperController::pretty_date($this->created_at),
            'payment_method' => $this->payment_method,
            'total_cost' => "Kes. " . $this->total_cost,
            'order_no' => "#" . $this->order_no,
            'customer' => $this->customers ? $this->customers->name : "N/A",
            'assigned_vehicle' => $this->vehicles ? $this->vehicles->reg_no . ' ~ ' . $this->vehicles->name : "Not Assigned",
            'vehicle_id' => $this->vehicles ? $this->vehicles->id : "",
            'status' => ucfirst($this->status),
            'details' => $this->details
        ];
    }
}