<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Http\Requests\ValidateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->back()->with('success', 'Nouvelle tâche créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('site.pages.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('site.pages.task.edit', [
            'task' => $task,
            'taskPriorities' => TaskPriority::cases(),
            'taskStatuses' => TaskStatus::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.show', $task->id)->with('success', 'Tâche mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Tâche supprimée avec succès');
    }
}
