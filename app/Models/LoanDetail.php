<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'book_id',
        'invoice',
        'status',
        'returned_at',
    ];

    public function book(): BelongsTo
    {related:
        return $this->belongsTo(Book::class);
    }
    public function loan(): BelongsTo
    {related:
        return $this->belongsTo(Loan::class);
    }
}
