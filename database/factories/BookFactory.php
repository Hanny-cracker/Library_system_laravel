<?php

namespace Database\Factories;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Book::class;
    public function definition(): array
    {
        $tittle=$this->faker->sentence(3);
        $qnt = $this->faker->numberBetween(1, 10);
        do {
            $avl = $this->faker->numberBetween(0, 10);
        } while ($avl >= $qnt);
        if ($avl == 0) {
            $status = BookStatus::OUT_OF_STOCK;
        } else {
            $status = BookStatus::AVAILABLE;
        }
        return [
            'tittle' => $tittle,
            'author' => $this->faker->name(),
            'isbn' => $this->faker->isbn13(),
            'description' => $this->faker->paragraph(),
            'slug' => Str::slug($tittle, '-'),
            'quantity' => $qnt,
            'available' => $avl,
            'pages' => $this->faker->numberBetween(100, 1000),
            'language' => $this->faker->languageCode(),
            'publisher' => $this->faker->company(),
            'published_at' => $this->faker->date(),
            'category' => $this->faker->word(),
            'status' => $status,
        ];
    }
}
