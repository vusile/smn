<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Category as CategoryResource;
use App\Models\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
            'data' => ['categories' => $this->collection->toArray()]
        ];
    }
}
