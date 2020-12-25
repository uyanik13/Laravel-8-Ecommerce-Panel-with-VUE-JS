<?php

namespace App\Http\Resources;

use App\Invoice;
use App\Http\Resources\ApiResourceCollection;
use App\Http\Resources\invoiceResource;

class invoiceCollection extends ApiResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      // Transforms the collection to match format in TodoResource.
      $this->collection->transform(function (Invoice $invoice) {
        return (new invoiceResource($invoice));
      });

      return parent::toArray($request);
    }
}
