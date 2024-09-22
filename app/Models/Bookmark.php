<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {related:
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {related:
        return $this->belongsTo(Book::class);
    }
}
