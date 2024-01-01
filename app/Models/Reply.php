<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'replies';

    // Define the fillable attributes
    protected $fillable = [
        'content',
        'comment_id',
        'author_id',
    ];

    // Define the relationships
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
