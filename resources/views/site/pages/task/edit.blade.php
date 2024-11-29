@extends('site.layouts.main')
@section('title')
    Editer une tâche
@endsection

@section('content')
    <div class="container mt-4">
        <h1>Modifier la tâche</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $task->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priorité</label>
                        <select class="form-select" id="priority" name="priority" required>
                            @foreach ($taskPriorities as $priority)
                                <option value="{{ $priority->value }}" @selected($task->priority == $priority->value)>{{ $priority->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            @foreach ($taskStatuses as $status)
                                <option value="{{ $status->value }}" @selected($task->status == $status->value)>{{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
