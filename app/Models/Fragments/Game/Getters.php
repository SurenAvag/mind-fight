<?php

namespace App\Models\Fragments\Game;

trait Getters
{
    public function getTimeAttribute()
    {
        return $this->questions->sum('time');
    }

    //Խաղի ժամանակ խաղարկվող միավորները
    public static function getPointForGame(): float
    {
        return 4 * sqrt(self::GAMES_COUNT_FOR_WIN);
    }
}