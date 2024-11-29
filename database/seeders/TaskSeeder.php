<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Première tâche',
            'description' => 'Description de la première tâche.',
            'status' => 'not started',
            'priority' => 'high',
            'assigned_to' => 1, // Admin User
            'project_id' => 1, // Premier projet
        ]);

        Task::create([
            'title' => 'Deuxième tâche',
            'description' => 'Description de la deuxième tâche.',
            'status' => 'in running',
            'priority' => 'medium',
            'assigned_to' => 2, // Regular User
            'project_id' => 2, // Deuxième projet
        ]);
    }
}
