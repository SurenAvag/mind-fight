<?php

namespace App\Events;

use App\Models\Game;
use App\Transformers\GameTransformer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GameCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function broadcastOn()
    {
        return ['game-created'];
    }

    public function broadcastWith()
    {
        return [
            'game' => GameTransformer::simple($this->game->load('users')),
        ];
    }
}
