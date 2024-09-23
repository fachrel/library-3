<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Attributes\Auth;
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
    public function calculateFine()
    {
        $borrowedAt = $this->loan->borrowed_at;
        $returnedAt = $this->returned_at ? Carbon::parse($this->returned_at) : Carbon::now();

        $dueDate = $this->loan->must_returned_at;

        if($returnedAt->gt($dueDate)){
            $daysOverdue = $returnedAt->diffInDays($dueDate, false);
            return abs($daysOverdue) * 1000 + 5000;
        }

        if($this->returned_at == $dueDate){
            return 5000;
        }

        return 0;
    }


}
