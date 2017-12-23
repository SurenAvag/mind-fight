<?php

namespace App\Http\DataProviders;

use App\Models\Question;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuestionsDataProvider
{
    public function getQuestions(): LengthAwarePaginator
    {
        return Question::paginate();
    }
}