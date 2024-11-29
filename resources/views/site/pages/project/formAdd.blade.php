<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateProject"
    aria-labelledby="offcanvasCreateProjectLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreateProjectLabel">Créer un projet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <!-- Formulaire de création de projet -->
        <form id="createProjectForm" action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="titleCreate" class="form-label">Titre du projet</label>
                <input type="text" class="form-control" id="titleCreate" name="title"
                    placeholder="Entrez le titre du projet" required>

                @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="descriptionCreate" class="form-label">Description</label>
                <textarea class="form-control" id="descriptionCreate" name="description" rows="4" placeholder="Décrivez le projet"
                    required></textarea>

                @error('description')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deadlineCreate" class="form-label">Date limite</label>
                <input type="date" class="form-control" id="deadlineCreate" name="deadline" required>

                @error('deadline')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="finishedCreate">Terminé</label>
                    <input class="form-check-input" type="checkbox" id="finishedCreate" value="1"
                        name="finished" />

                    @error('finished')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Créer</button>
        </form>
    </div>
</div>
