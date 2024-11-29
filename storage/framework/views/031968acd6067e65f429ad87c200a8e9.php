<?php $__env->startSection('title'); ?>
    Détails Tâche
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1>Détails de la tâche</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($task->title); ?></h5>
                <p class="card-text"><strong>Description :</strong> <?php echo e($task->description); ?></p>
                <p><strong>Assignée à :</strong> <?php echo e($task->user->name); ?></p>
                <p><strong>Priorité :</strong>
                    <?php switch($task->priority):
                        case ('low'): ?>
                            <span class="text-info">Faible</span>
                        <?php break; ?>

                        <?php case ('medium'): ?>
                            <span class="text-warning">Moyenne</span>
                        <?php break; ?>

                        <?php case ('high'): ?>
                            <span class="text-danger">Forte</span>
                        <?php break; ?>

                        <?php default: ?>
                            <span class="text-muted">Non définie</span>
                    <?php endswitch; ?>
                </p>
                <p><strong>Statut :</strong>
                    <?php switch($task->status):
                        case ('not started'): ?>
                            Pas encore commencée
                        <?php break; ?>

                        <?php case ('in running'): ?>
                            En cours
                        <?php break; ?>

                        <?php case ('ended'): ?>
                            Terminée
                        <?php break; ?>

                        <?php default: ?>
                            Non défini
                    <?php endswitch; ?>
                </p>
                <p><strong>Date de création :</strong> <?php echo e(date_format($task->created_at, 'd F Y, H:i')); ?></p>
                <a href="<?php echo e(route('tasks.edit', ['task' => $task->id])); ?>" class="btn btn-warning">Modifier</a>
                <a href="<?php echo e(route('projects.show', ['project' => $task->project->id])); ?>"
                    class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/task/show.blade.php ENDPATH**/ ?>