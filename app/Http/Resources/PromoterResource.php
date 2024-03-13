<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoterResource extends JsonResource
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
            'NIF'   => $this->NIF,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'password' => $this->password,
            'created_at' => $this->created_at->toDateString()
        ];
    }
}
