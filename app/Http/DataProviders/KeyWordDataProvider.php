<?php

namespace App\Http\DataProviders;

use App\Models\KeyWord;

class KeyWordDataProvider
{
    public function getKeyWords()
    {
        return KeyWord::where('subject_id', request()->subject_id)->paginate();
    }
}