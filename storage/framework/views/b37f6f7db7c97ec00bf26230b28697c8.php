<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="createTaskOffcanvas" aria-labelledby="createTaskOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="createTaskOffcanvasLabel">Créer une Tâche</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="<?php echo e(route('tasks.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
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
                    <?php $__currentLoopData = $taskPriorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($priority->value); ?>"><?php echo e($priority->label()); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Sélecteur pour le statut -->
            <div class="mb-3">
                <label for="taskStatus" class="form-label">Statut</label>
                <select class="form-select" id="taskStatus" name="status" required>
                    <?php $__currentLoopData = $taskStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status->value); ?>"><?php echo e($status->label()); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Sélecteur pour l'utilisateur assigné -->
            <div class="mb-3">
                <label for="assignedTo" class="form-label">Assigné à</label>
                <select class="form-select" id="assignedTo" name="assigned_to" required>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Créer la Tâche</button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/task/formAdd.blade.php ENDPATH**/ ?>