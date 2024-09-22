<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(attributes: [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'username' => 'user',
            'address' => 'home',
            'role' => '0',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'username' => 'admin',
            'address' => 'Office',
            'role' => '1',
        ]);

        User::create([
            'name' => 'operator',
            'email' => 'operator@example.com',
            'password' => Hash::make('operator'),
            'username' => 'operator',
            'address' => 'Office',
            'role' => '2',
        ]);

        $c1 = Category::create([
            'name' => 'Novel',
        ]);

        $c2 = Category::create([
            'name' => 'Romance',
        ]);

        $c3 = Category::create([
            'name' => 'Self Improvement',
        ]);

        $b1 = Book::create([
            'name' => 'Malioboro at Midnight',
            'author' => 'Skysphire',
            'publisher' => 'Bukune',
            'year' => '2023',
            'quantity' => '2',
            'photo' => 'books/default.jpg',
        ]);
        $b1->categories()->sync([$c1->id,$c2->id]);

        $b2 = Book::create([
            'name' => 'Midnight Diaries by Malioboro Hartigan',
            'author' => 'Skysphire',
            'publisher' => 'Bukune',
            'year' => '2023',
            'quantity' => '2',
            'photo' => 'books/default.jpg',
        ]);
        $b2->categories()->sync([$c1->id,$c2->id]);

        $b3 = Book::create([
            'name' => 'The Pshycology of Emotion',
            'author' => 'David J. Lieberman',
            'publisher' => 'Baca',
            'year' => '2024',
            'quantity' => '2',
            'photo' => 'books/default.jpg',
        ]);
        $b3->categories()->sync([$c3->id]);

    }
}
