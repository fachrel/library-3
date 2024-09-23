<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Review;
use App\Models\Bookmark;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'level',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function userCurrentlyBorrowedBooks()
    {
        return LoanDetail::where('invoice', 'like', '%-'.Auth::user()->id.'-%')
            ->where('status', '1')
            ->get();
    }
    public function userReturnedBooks()
    {
        return LoanDetail::join('loans', 'loans.id', '=', 'loan_details.loan_id')
            ->where('loans.user_id', Auth::user()->id)
            ->where('status', '2')
            ->orderBy('loans.borrowed_at', 'desc')
            ->with('loan')
            ->get()
            ->groupBy(function ($loanDetail) {
                return Carbon::parse($loanDetail->borrowed_at)->format('Y-m-d'); // Group by formatted date
            });    }




}
