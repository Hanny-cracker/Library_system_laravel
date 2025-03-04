<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BorrowedBook;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowedBook>
 */
class BorrowedBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BorrowedBook::class;

    
    public function definition(): array
    {
        $avl = Book::inRandomOrder()->first()->quantity;
        do {
            $qnt = $this->faker->numberBetween(0, 10);
        } while ($avl < $qnt);
        $id = Book::inRandomOrder()->first()->id;
        return [
            'book_id' => $id,
            'name' => $this->faker->name(),
            'contact' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'quantity' => $qnt,
            'slug' => Book::inRandomOrder()->firstWhere('id',$id)->slug,
            'borrowed_at' => $this->faker->dateTime(),
            'returned_at' => $this->faker->dateTime(),
            'notes' => $this->faker->sentence(),
        ];
    }

}
