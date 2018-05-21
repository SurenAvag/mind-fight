<?php

namespace App\Models;

use App\Models\Fragments\KeyWord\Relations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed parents
 * @property mixed children
 */
class KeyWord extends BaseModel
{
    use Relations;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'subject_id'
    ];
}
