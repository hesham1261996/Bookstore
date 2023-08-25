<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create(['name'=> 'اسامه محمد']);
        Author::create(['name'=> 'مصطفي محمحد']);
        Author::create(['name'=> 'محمود خالد']);
        Author::create(['name'=> 'خالد محمد']);
        Author::create(['name'=> 'يوسف محمد']);
    }
}
