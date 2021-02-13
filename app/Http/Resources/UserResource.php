<?php

namespace App\Http\Resources;

use App\Enums\GithubEnum;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @author Ahmed Helal Ahmed
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'github'=> GithubEnum::BASE_URL.$this->name,
            'gists' => GithubEnum::GIST_URL.$this->name
        ];
    }
}
