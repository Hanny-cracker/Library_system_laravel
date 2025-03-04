<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class BorrowedBook extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowedBookFactory> */
    use HasFactory, Searchable;
    protected $fillable = [
        'book_id',
        'name',
        'contact',
        'address',
        'email',
        'slug',
        'quantity',
        'borrowed_at',
        'returned_at',
        'notes',
    ];
    //
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'contact' => $this->contact,
            'address' => $this->address,
            'email' => $this->email,
            'borrowed_at' => $this->borrowed_at,
            'returned_at' => $this->returned_at,
            'notes' => $this->notes,
        ];
    }

}
