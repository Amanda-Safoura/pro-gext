<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function overview()
    {

        // Nombre de projets terminés
        $completedProjects = Project::where('finished', 1)->count();

        // Nombre de projets en cours
        $ongoingProjects = Project::where('finished', 0)->count();

        // Statistiques sur les tâches par statut
        $status = [
            'not_started' => Task::where('status', 'not started')->count(),
            'in_running' => Task::where('status', 'in running')->count(),
            'ended' => Task::where('status', 'ended')->count(),
        ];

        // Statistiques sur les tâches par priorité
        $priority = [
            'low' => Task::where('priority', 'low')->count(),
            'medium' => Task::where('priority', 'medium')->count(),
            'high' => Task::where('priority', 'high')->count(),
        ];

        // Retourner la vue avec les statistiques
        return view('site.pages.overview', compact('status', 'priority', 'completedProjects', 'ongoingProjects'));
    }
}
