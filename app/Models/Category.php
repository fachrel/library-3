<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
