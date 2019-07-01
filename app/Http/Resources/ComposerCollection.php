<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Composer as ComposerResource;
use App\Models\Composer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ComposerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->toArray()
        ];
    }
}
