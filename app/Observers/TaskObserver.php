<?php

namespace App\Observers;

use App\Enums\TaskPriority;
use App\Models\CustomNotif;
use App\Models\Task;

class TaskObserver
{

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task)
    {
        // Si le statut est défini dès la création
        if ($task->assigned_to) {
            $this->handleNotifyToUser($task);
        }
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task)
    {
        // Si le statut a changé lors de la mise à jour
        if ($task->isDirty('assigned_to')) {
            $this->handleNotifyToUser($task);
        }
    }

    /**
     * Gère le changement d'utilisateur à qui la tâche est assignée.
     */
    private function handleNotifyToUser(Task $task)
    {
        CustomNotif::create([
            'content' => 'L\'utilisateur ' . $task->project->user->name . ' vous a assigné une tâche.<br> Désignation: ' . $task->title . '(Priorité: ' . TaskPriority::from($task->priority)->label() . ')',
            'user_id' => $task->assigned_to
        ]);
    }
}
