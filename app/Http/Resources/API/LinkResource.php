<?php

namespace App\Http\Resources\API;

use App\Models\Alias;
use App\Models\Group;
use Illuminate\Http\Resources\Json\JsonResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $qrGenerator = new Generator();

        $url = Alias::query()
            ->where("subject_id",$this->id)
            ->where("type","url")
            ->withCount("visits")
            ->first();

        $svg = $qrGenerator->size(300)->generate(route("url",$url->alias))->toHtml();
        $group = Group::query()
            ->where("id",$this->group_id)
            ->first();
        return [
            "long_url" => $url->url,
            "short" => $url->alias,
            "hits" => $url->visits_count,
            "group" => GroupResource::make($group),
            "short_url" => route("url",$url->alias),
            "qr" => [
                "svg" => $svg
            ],
        ];
    }

}
