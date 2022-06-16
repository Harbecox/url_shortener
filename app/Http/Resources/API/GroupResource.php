<?php

namespace App\Http\Resources\API;

use App\Models\Alias;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $alias = Alias::query()
            ->where("subject_id",$this->id)
            ->where("type","group")
            ->first();
        return [
            "id" => $this->id,
            "name" => $this->title,
            "short" => $alias->alias,
            "description" => $this->description,
            "url" => route("url",$alias->alias),
        ];
    }
}
