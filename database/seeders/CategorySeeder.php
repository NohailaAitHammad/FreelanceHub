<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Développement Web"
        ]);

         Category::create([
             "name" => "Développement Mobile"
         ]);
          Category::create([
              "name" => "Développement Desktop"
          ]);
          Category::create([
              "name" => "Full-Stack"
          ]);
          Category::create([
              "name" => "DevOps"
          ]);
          Category::create([
              "name" => "UI/UX"
          ]);
    }
}
