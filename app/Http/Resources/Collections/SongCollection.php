<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Song as SongResource;
use App\Models\Song;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SongCollection extends ResourceCollection
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
            'data' => [
                'songs' => $this->collection
                    ->map(function($song) {
                        return new SongResource($song);
                    }
                )
            ]
        ];
    }
}
