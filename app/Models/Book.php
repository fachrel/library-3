<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'author',
        'photo',
        'publisher',
        'year',
        'quantity',
    ];

    public function bookmarks(): HasMany
    {related:
        return $this->hasMany(Bookmark::class);
    }

    public function loanDetails(): HasMany
    {related:
        return $this->hasMany(LoanDetail::class);
    }

    public function reviews(): HasMany
    {related:
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating'); // Calculate the average rating
    }

    public function totalReviews()
    {
        return $this->reviews()->count(); // Count the total number of reviews
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeCountBorrowedBook(){
        return $this->loanDetails()
            ->whereNull('returned_at')
            ->where('status', '1')
            ->count();
    }

    public function isBookBorrowed($userId){
        return LoanDetail::where('book_id', $this->id)
            ->whereNull('returned_at')
            ->where('invoice', 'like', "%-$userId-%")
            ->where('status', '1')
            ->exists();
    }

    public function isBookBookmarked(){
        return Bookmark::where('user_id', Auth::user()->id)
            ->where('book_id', $this->id)
            ->exists();
    }
    public function isBookReturned($userId){
        return LoanDetail::where('book_id', $this->id)
            ->whereNotNull('returned_at')
            ->where('invoice', 'like', "%-$userId-%")
            ->where('status', '2')
            ->exists();
    }

    public function isBookReviewed($userId){
        return Review::where('book_id', $this->id)
            ->where('user_id', $userId)
            ->exists();
    }

    public function userReview(){
        return Review::where('user_id', Auth::user()->id)
                    ->where('book_id', $this->id)
                    ->first();
    }
}
