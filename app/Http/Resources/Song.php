<?php

namespace App\Http\Resources;

use App\Services\SongService;
use Illuminate\Http\Resources\Json\JsonResource;

class Song extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'composer' => $this->composer->name,
            'views' => $this->views,
            'downloads' => $this->downloads,
            'lyrics' => str_replace('&nbsp;</p>', '</p>', $this->lyrics),
            'pdf' => downloadLink($this, 'pdf'),
            'midi' => $this->midi 
                ? downloadLink($this, 'midi') 
                : null,
        ];
    }
}
