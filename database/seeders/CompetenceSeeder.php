<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competence::create(["name" => "Développement Web"]);
        Competence::create(["name" => "Développement Mobile"]);
        Competence::create(["name" => "DevOps"]);
        Competence::create(["name" => "UI/UX Design"]);
        Competence::create(["name" => "Backend Development"]);
        Competence::create(["name" => "Frontend Development"]);
        Competence::create(["name" => "Full Stack Development"]);
        Competence::create(["name" => "API Development"]);
        Competence::create(["name" => "Testing & QA"]);
        Competence::create(["name" => "Database Design"]);
    }
}
