<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $guarded = [];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function coauthorbook(): BelongsTo
    {
        return $this->belongsTo(Coauthorbook::class);
    }
    
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

}
