<?php

namespace App\Http\Resources;

use App\Http\Resources\ApiResource;
use App\Custom\Hasher;

class UserResource extends ApiResource
{
    /**
     * Transform the resource into an json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
