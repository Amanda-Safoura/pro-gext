<?php

namespace Database\Seeders;

use App\Models\CustomNotif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomNotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomNotif::create([
            'content' => '<strong>Bienvenue !</strong> Ceci est une notification pour Admin User.',
            'user_id' => 1, // Admin User
            'read' => false,
        ]);

        CustomNotif::create([
            'content' => 'Vous avez une nouvelle tâche assignée.',
            'user_id' => 2, // Regular User
            'read' => true,
        ]);
    }
}
