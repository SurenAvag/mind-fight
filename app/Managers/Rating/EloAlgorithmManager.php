<?php

namespace App\Managers\Rating;

use App\Models\Game;
use App\Models\User;

class EloAlgorithmManager
{
    //Հաղթած խաղացողի վաստակած միավորը
    public static function getRatingForWinner(User $winner, User $loser): float
    {
        return round((1 - $winner->getProbabilityOfVictory($loser))
            * $winner->getRatingGrowthCoefficient()
            * Game::getPointForGame(), 2);
    }

    //Պարտված խաղաողի կորցրած միավորը
    public static function getRatingForLoser(User $loser, User $winner): float
    {
        return round($loser->getProbabilityOfVictory($winner)
            * $loser->getRatingGrowthCoefficient()
            * Game::getPointForGame(), 2);
    }
}