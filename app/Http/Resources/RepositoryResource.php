<?php

namespace App\Http\Resources;

use App\Enums\GithubEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepositoryResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->slug,
            'url'=>GithubEnum::BASE_URL.auth()->user()->name.'/'.$this->slug,
            'starts_Count'=>$this->number_of_stars
        ];
    }
}
