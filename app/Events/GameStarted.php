<?php

namespace App\Events;

use App\Models\Game;
use App\Transformers\GameTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class GameStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $game;

    /**
     * Create a new event instance.
     *
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function broadcastOn()
    {
        return ['game-started'];
    }

    public function broadcastWith()
    {
        return [
            'game'  => GameTransformer::simple($this->game),
            'user'  => UserTransformer::forBroadcast(Auth::user())
        ];
    }
}
