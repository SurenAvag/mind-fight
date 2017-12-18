<?php

namespace App\Models;

use App\Models\Fragments\Game\Relations;

class Game extends BaseModel
{
    use Relations;

    public $timestamps = false;
}
