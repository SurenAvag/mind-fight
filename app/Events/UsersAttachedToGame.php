<?php

namespace App\Events;

use App\Models\Game;
use App\Models\User;
use App\Transformers\GameTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsersAttachedToGame implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $authUser;
    private $invitedUser;
    private $game;

    /**
     * Create a new event instance.
     *
     * @param User $authUser
     * @param User $invitedUser
     * @param Game $game
     */
    public function __construct(User $authUser, User $invitedUser, Game $game)
    {
        $this->authUser = $authUser;
        $this->invitedUser = $invitedUser;
        $this->game = $game;
    }

    public function broadcastOn()
    {
        return ['users-attached-to-game'];
    }

    public function broadcastWith()
    {
        return [
            'game'  => GameTransformer::forBroadcast($this->game),
            'user'  => UserTransformer::forBroadcast($this->authUser),
            'invitedUser'  => UserTransformer::forBroadcast($this->invitedUser),
        ];
    }
}
