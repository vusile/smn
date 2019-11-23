<?php

namespace App\Http\Resources;

use App\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Song extends JsonResource
{
    /*
     * @var bool
     */
    protected $showAll; 
    
    public function __construct($resource, $showAll = false) {
        parent::__construct($resource);
        $this->showAll = $showAll;
    }
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
            'views' => number_format($this->views),
            'downloads' => number_format($this->downloads),
            'midi' => $this->midi 
                ? Storage::url(config('song.files.paths.midi') . $this->midi) 
                : "",
            'ithibati_number' => $this->ithibati_number ?? null,
            $this->mergeWhen($this->showAll, [
                'pdf' => Storage::url(config('song.files.paths.midi') . $this->pdf),
                'categories' => $this->categories->pluck('title')->implode(' | '),
                'lyrics' => str_replace('&nbsp;</p>', '</p>', $this->lyrics),
                'comments' => Comment::collection($this->comments($this->comments)),
                'fit_for_liturgy' => $this->fit_for_liturgy ?? null,
                'uploader' => $this->user->name,
            ]),
        ];
    }
    
    private function comments($comments)
    {
        return $comments
                ->reverse()
                ->filter(function ($comment) {
                    return $comment->comment == strip_tags($comment->comment);
                });
    }
}
