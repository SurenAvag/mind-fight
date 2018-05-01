<?php

namespace App\Models;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed parents
 * @property mixed children
 */
class KeyWord extends BaseModel
{
    public $timestamps = false;

    public function children()
    {
        return $this->belongsToMany(KeyWord::class, 'key_word_dependence', 'parent_id', 'child_id');
    }

    public function parents()
    {
        return $this->belongsToMany(KeyWord::class, 'key_word_dependence', 'child_id', 'parent_id');
    }
}
