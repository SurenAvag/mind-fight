<?php

namespace App\Http\DataProviders;

use App\Models\Topic;

class TopicDataProvider
{
    public function getTopics()
    {
        return Topic::paginate();
    }
}