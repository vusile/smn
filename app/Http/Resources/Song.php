<?php

namespace App\Http\Resources;

use App\Services\SongService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'uploader' => $this->user->name,
            'categories' => $this->categories->pluck('title')->implode(' | '),
            'views' => number_format($this->views),
            'downloads' => number_format($this->downloads),
            'lyrics' => str_replace('&nbsp;</p>', '</p>', $this->lyrics),
            'pdf' => Storage::url(config('song.files.paths.midi') . $this->pdf),
            'midi' => $this->midi 
                ? Storage::url(config('song.files.paths.midi') . $this->midi) 
                : "",
            'fit_for_liturgy' => $this->fit_for_liturgy ?? null,
            'ithibati_number' => $this->ithibati_number ?? null,
        ];
    }
}
