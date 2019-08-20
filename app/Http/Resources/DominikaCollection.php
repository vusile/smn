<?php

namespace App\Http\Resources;

use App\Http\Resources\Dominika as DominikaResource;
use App\Models\Dominika;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DominikaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => $this->collection->toArray()];
    }
}
