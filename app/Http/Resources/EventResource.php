<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        $resized_image="";
        try {
            $resized_image = $this->getMedia('*');//[0]->getUrl('resized-image');
           // return resized_image;
            if(count($resized_image) != 0){
               // $resized_image = $resized_image[0]->getUrl('resized-image');
            }
        } catch (Exception $e) {
            $resized_image="";
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'original_image' => count($this->getMedia('*')) > 0 ? $this->getMedia('*')[0]->getUrl() : null,
            'resized_image' => $resized_image,
            'created_at' => $this->created_at?->toDateString()
        ];
    }
}
