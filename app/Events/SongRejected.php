<?php

namespace App\Events;

use App\Models\Song;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SongRejected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $song;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }
}
