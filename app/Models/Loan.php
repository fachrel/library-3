<?php

namespace App\Models;

use App\Models\User;
use App\Models\LoanDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice',
        'borrowed_at',
        'must_returned_at',
    ];

    public function user(): BelongsTo
    {related:
        return $this->belongsTo(User::class);
    }

    public function loanDetails(): HasMany
    {related:
        return $this->hasMany(LoanDetail::class);
    }

    public function scopeCountBorrowedBook(){
        return $this->loanDetails()
            ->count();
    }

    public function scopeCountReturnedBook(){
        return $this->loanDetails()
            ->whereNotNull('returned_at')
            ->where('status', '2')
            ->count();
    }
}
