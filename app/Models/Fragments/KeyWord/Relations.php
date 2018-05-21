<?php

namespace App\Models\Fragments\KeyWord;

use App\Models\KeyWord;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Relations
{
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(KeyWord::class, 'key_word_dependence', 'parent_id', 'child_id');
    }

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(KeyWord::class, 'key_word_dependence', 'child_id', 'parent_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}