<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coauthorbook extends Model
{
    use HasFactory;

    protected $table = 'coauthorbooks';

    protected $guarded = [];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coauthorbook_user', 'coauthorbook_id', 'author_id');
    }

    public function coauthorbooksAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coauthorbooks_author');
    }

    public function coauthors(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'coauthorbook_user', 'coauthorbook_id', 'author_id')
        ->withPivot('coauthorbooks_author');
}

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
