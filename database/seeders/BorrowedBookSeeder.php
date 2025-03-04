<?php

namespace Database\Seeders;

use App\Models\BorrowedBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowedBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BorrowedBook::factory(10)->create();
    }
}
