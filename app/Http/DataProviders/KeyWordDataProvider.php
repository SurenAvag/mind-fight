<?php

namespace App\Http\DataProviders;

use App\Models\KeyWord;

class KeyWordDataProvider
{
    public function getKeyWords()
    {
        return KeyWord::paginate();
    }
}