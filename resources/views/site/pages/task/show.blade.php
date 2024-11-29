@extends('site.layouts.main')
@section('title')
    Détails Tâche
@endsection

@section('content')
    <div class="container mt-4">
        <h1>Détails de la tâche</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text"><strong>Description :</strong> {{ $task->description }}</p>
                <p><strong>Assignée à :</strong> {{ $task->user->name }}</p>
                <p><strong>Priorité :</strong>
                    @switch($task->priority)
                        @case('low')
                            <span class="text-info">Faible</span>
                        @break

                        @case('medium')
                            <span class="text-warning">Moyenne</span>
                        @break

                        @case('high')
                            <span class="text-danger">Forte</span>
                        @break

                        @default
                            <span class="text-muted">Non définie</span>
                    @endswitch
                </p>
                <p><strong>Statut :</strong>
                    @switch($task->status)
                        @case('not started')
                            Pas encore commencée
                        @break

                        @case('in running')
                            En cours
                        @break

                        @case('ended')
                            Terminée
                        @break

                        @default
                            Non défini
                    @endswitch
                </p>
                <p><strong>Date de création :</strong> {{ date_format($task->created_at, 'd F Y, H:i') }}</p>
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-warning">Modifier</a>
                <a href="{{ route('projects.show', ['project' => $task->project->id]) }}"
                    class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
