<?php

namespace App\Http\DataProviders;

use App\Models\Question;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuestionsDataProvider
{
    public function getQuestions(): LengthAwarePaginator
    {
        return Question::with('subject')->where('subject_id', request()->subject_id)->paginate(6000);
    }
}