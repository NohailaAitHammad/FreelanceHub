<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technology::create(["name" => "PHP"]);
        Technology::create(["name" => "Laravel"]);
        Technology::create(["name" => "JavaScript"]);
        Technology::create(["name" => "React"]);
        Technology::create(["name" => "Vue.js"]);
        Technology::create(["name" => "Vue.js"]);
        Technology::create(["name" => "Python"]);
        Technology::create(["name" => "Django"]);
        Technology::create(["name" => "MySQL"]);
        Technology::create(["name" => "MongoDB"]);
        Technology::create(["name" => "Docker"]);
        Technology::create(["name" => "Git"]);
        Technology::create(["name" => "Bootstrap"]);
        Technology::create(["name" => "Tailwind CSS"]);
        Technology::create(["name" => "Flutter"]);
        Technology::create(["name" => "Java"]);
        Technology::create(["name" => "C++"]);
    }
}
