<?php

namespace App\Events;

use App\Models\Game;
use App\Transformers\GameTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class GameDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function broadcastOn()
    {
        return ['game-deleted'];
    }

    public function broadcastWith()
    {
        return [
            'game'          => GameTransformer::simple($this->game),
            'deletedByUser' => UserTransformer::forBroadcast(Auth::user())
        ];
    }
}
