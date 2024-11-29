<?php $__env->startSection('title'); ?>
    Editer une tâche
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1>Modifier la tâche</h1>

        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('tasks.update', ['task' => $task->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?php echo e(old('title', $task->title)); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo e(old('description', $task->description)); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priorité</label>
                        <select class="form-select" id="priority" name="priority" required>
                            <option value="low" <?php if($task->priority == 'low'): echo 'selected'; endif; ?>>Faible</option>
                            <option value="medium" <?php if($task->priority == 'medium'): echo 'selected'; endif; ?>>Moyenne</option>
                            <option value="high" <?php if($task->priority == 'high'): echo 'selected'; endif; ?>>Forte</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="not started" <?php if($task->status == 'not started'): echo 'selected'; endif; ?>>Pas encore commencée
                            </option>
                            <option value="in running" <?php if($task->status == 'in running'): echo 'selected'; endif; ?>>En cours</option>
                            <option value="ended" <?php if($task->status == 'ended'): echo 'selected'; endif; ?>>Terminée</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="<?php echo e(route('tasks.show', ['task' => $task->id])); ?>" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/task/edit.blade.php ENDPATH**/ ?>