<?php

namespace App\Http\Resources;

use App\Http\Resources\ApiResource;
use App\Custom\Hasher;

class invoiceResource extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
