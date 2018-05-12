<?php

namespace App\Models\Fragments\User;

use App\Models\Game;
use App\Models\User;

trait Getters
{
    //Երկու խաղացողների վարկանիշային միավորների տարբերությունը
    public function getRatingDifferenceBetweenTwoUsers(User $secondPlayer): float
    {
        return $this->rating - $secondPlayer->rating;
    }

    public function getPointCoefficientAttribute()
    {
        return self::NORM_POINT / $this->point;
    }

    //Խաղացողի անցկացրած խաղերի քանակը
    public function getPlayedGamesCount(): int
    {
        return $this->games()->count();
    }

    //Խաղացողի փորձը
    public function getExperience(): float
    {
        return $this->getPlayedGamesCount();
    }

    //Խաղացողի հաղթելու հավանականությունը
    public function getProbabilityOfVictory(User $secondPlayer): float
    {
        return 1 / (1 + pow(10,
            $this->getRatingDifferenceBetweenTwoUsers($secondPlayer)
            * sqrt(Game::GAMES_COUNT_FOR_WIN) / 2000
        ));
    }

    //Խաղացողի վարկանիշային միավորի աճման գործակիցը
    public function getRatingGrowthCoefficient(): float
    {
        if ($this->getExperience() < self::NORMAL_EXPERIENCE) {
            return (500 - $this->getExperience()) / 100;
        }

        return 1;
    }
}