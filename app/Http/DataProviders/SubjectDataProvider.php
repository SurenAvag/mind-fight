<?php

namespace App\Http\DataProviders;

use App\Models\Subject;

class SubjectDataProvider
{
    public function getQuestions()
    {
        return Subject::paginate(6000);
    }
}