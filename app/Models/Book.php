<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Book extends Model
{
    use Searchable ,HasFactory;
    /** @use HasFactory<\Database\Factories\BookFactory> */
   protected $fillable = [
        'tittle',
        'author',
        'isbn',
        'description',
        'slug',
        'quantity',
        'available',
        'pages',
        'language',
        'publisher',
        'published_at',
        'category',
        'status',
    ];

    public function borrowedbooks()
    {
        return $this->hasMany(Borrowedbook::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'Available');
    }
    
    // public function scopeBorrowed($query)
    // {
    //     return $query->where('status', 'borrowed');
    // }
    
    #[SearchUsingPrefix(['tittle', 'author', 'isbn', 'description', 'category'])]
    public function toSearchableArray(): array
    {
        return [
            'tittle' => $this->tittle,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'category' => $this->category,
        ];
    }

}
