<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'genre' => $this->genre,
            'NIF' => $this->NIF,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'role_id' => $this->roles,
            'roles' => $this->roles,
            'created_at' => $this->created_at->toDateString()
        ];
    }
}
