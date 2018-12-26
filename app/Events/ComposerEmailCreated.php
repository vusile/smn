<?php

namespace App\Events;

use App\Models\ComposerEmail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ComposerEmailCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $composerEmail;
    public $request;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ComposerEmail $composerEmail, array $request)
    {
        $this->composerEmail = $composerEmail;
        $this->request = $request;
    }
}
