<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view('site.pages.project.index', [
            'datas' => $user->is_admin
                ? Project::all()
                : Project::where('user_id', $user->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_inputs = $request->validated();
        $validated_inputs['user_id'] = auth()->id();

        Project::create($validated_inputs);

        return redirect()->back()->with('success', 'Nouveau projet créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('site.pages.task.index', [
            'project' => $project,
            'tasks' => $project->tasks,
            'users' => User::all(),

            'taskPriorities' => TaskPriority::cases(),
            'taskStatuses' => TaskStatus::cases()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->tasks()->delete();
        $project->delete();

        return redirect()->back()->with('success', 'Projet supprimé avec succès');
    }
}
