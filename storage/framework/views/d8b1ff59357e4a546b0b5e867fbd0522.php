<?php $__env->startSection('title'); ?>
    Liste des Tâches
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additionnal_css'); ?>
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dataTables.bootstrap5.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <div class="container mt-4">

                <div class="d-flex justify-content-end">

                    <div class="custom-dropdown mx-3">
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-priority">
                            Filtrer par priorité
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Faible')">Faible</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Moyenne')">Moyenne</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Forte')">Forte</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>

                    <div class="custom-dropdown me-3">
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-status">
                            Filtrer par status
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li>
                                <a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Pas encore commencée')">Pas encore
                                    commencée</a>
                            </li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'En cours')">En cours</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Terminée')">Terminée</a>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Bouton pour ouvrir l'offcanvas -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#createTaskOffcanvas" aria-controls="createTaskOffcanvas">
                    Nouvelle Tâche
                </button>

                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dénomination</th>
                                <th>Description</th>
                                <th>Assigné à</th>
                                <th>Priorité</th>
                                <th>Status</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($task->id); ?></td>
                                    <td><?php echo e($task->title); ?></td>
                                    <td><?php echo e(substr($task->description, 0, 40)); ?></td>
                                    <td><?php echo e($task->user->name); ?> </td>
                                    <td class="text-center">
                                        <?php switch($task->priority):
                                            case ('low'): ?>
                                                <span class="bg-info text-white p-1" title="Faible">
                                                    <span class="d-none">Faible</span>
                                                    <i class="fas fa-arrow-down"></i>
                                                </span>
                                            <?php break; ?>

                                            <?php case ('medium'): ?>
                                                <span class="bg-warning text-white px-2 py-1" title="Moyenne">
                                                    <span class="d-none">Moyenne</span>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>
                                            <?php break; ?>

                                            <?php case ('high'): ?>
                                                <span class="bg-danger text-white px-2 py-1" title="Forte">
                                                    <span class="d-none">Forte</span>
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                            <?php break; ?>

                                            <?php default: ?>
                                                <span class="bg-secondary text-white px-2 py-1" title="Non défini">
                                                    <span class="d-none">Non défini</span>
                                                    <i class="fas fa-question-circle"></i>
                                                </span>
                                        <?php endswitch; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php switch($task->status):
                                            case ('not started'): ?>
                                                <span class="bg-info text-white p-1" title="Pas encore commencée">
                                                    <span class="d-none">Pas encore commencée</span>
                                                    <i class="fas fa-clock"></i></span>
                                            <?php break; ?>

                                            <?php case ('in running'): ?>
                                                <span class="bg-info text-white p-1" title="En cours"><span class="d-none">En cours</span><i
                                                        class="fas fa-check-circle"></i></span>
                                            <?php break; ?>

                                            <?php case ('ended'): ?>
                                                <span class="bg-success text-white p-1" title="Terminée"><span class="d-none">Terminée</span><i
                                                        class="fas fa-truck"></i></span>
                                            <?php break; ?>

                                            <?php default: ?>
                                        <?php endswitch; ?>
                                    </td>
                                    <td><?php echo e(date_format($task->created_at, 'd F Y, H:i')); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn btn-primary btn-sm"
                                                href="<?php echo e(route('tasks.show', ['task' => $task->id])); ?>" title="Voir plus">
                                                <i class="far fa-file-alt"></i>
                                            </a>
                                            <a class="btn btn-warning btn-sm" href="<?php echo e(route('tasks.edit', ['task' => $task->id])); ?>" title="Modifier">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('site.pages.task.formAdd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additionnal_js'); ?>
    <!-- DataTable -->
    <script src="<?php echo e(asset('assets/js/plugin/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugin/datatables/dataTables.bootstrap5.min.js')); ?>"></script>

    <script>
        let table = $('#editableTable').DataTable()

        function updateDropdown(buttonId, selection) {
            document.getElementById(buttonId).textContent = `Filtrer: ${selection}`;

            // Application du filtre selon le dropdown
            let col;
            let val = selection;

            // Identifie la colonne à filtrer selon le bouton
            if (buttonId === 'filter-priority') {
                col = 4; // Colonne de priorité
            } else if (buttonId === 'filter-status') {
                col = 5; // Colonne de status
            }


            // Application du filtre avec DataTable
            if (val === "Tous") {
                table.column(col).search('').draw(); // Affiche toutes les valeurs
            } else {
                // Met en place le filtre correspondant
                table.column(col).search(val, true, false).draw();
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/task/index.blade.php ENDPATH**/ ?>