<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Premier projet',
            'description' => 'Description du premier projet.',
            'deadline' => now()->addDays(10),
            'user_id' => 1, // Associer au premier utilisateur (Admin User)
            'finished' => false,
        ]);

        Project::create([
            'title' => 'Deuxième projet',
            'description' => 'Description du deuxième projet.',
            'deadline' => now()->addDays(15),
            'user_id' => 2, // Associer au second utilisateur (Regular User)
            'finished' => true,
        ]);
    }
}
