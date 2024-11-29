<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="createTaskOffcanvas" aria-labelledby="createTaskOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="createTaskOffcanvasLabel">Créer une Tâche</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <!-- Champ pour le titre -->
            <div class="mb-3">
                <label for="taskTitle" class="form-label">Titre de la tâche</label>
                <input type="text" class="form-control" id="taskTitle" name="title" placeholder="Titre de la tâche"
                    required>
            </div>

            <!-- Champ pour la description -->
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Description</label>
                <textarea class="form-control" id="taskDescription" name="description" rows="4" placeholder="Décrivez la tâche"
                    required></textarea>
            </div>

            <!-- Sélecteur pour la priorité -->
            <div class="mb-3">
                <label for="taskPriority" class="form-label">Priorité</label>
                <select class="form-select" id="taskPriority" name="priority" required>
                    @foreach ($taskPriorities as $priority)
                        <option value="{{ $priority->value }}">{{ $priority->label() }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélecteur pour le statut -->
            <div class="mb-3">
                <label for="taskStatus" class="form-label">Statut</label>
                <select class="form-select" id="taskStatus" name="status" required>
                    @foreach ($taskStatuses as $status)
                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélecteur pour l'utilisateur assigné -->
            <div class="mb-3">
                <label for="assignedTo" class="form-label">Assigné à</label>
                <select class="form-select" id="assignedTo" name="assigned_to" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Créer la Tâche</button>
            </div>
        </form>
    </div>
</div>
