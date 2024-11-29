<?php $__env->startSection('title'); ?>
    Projets
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
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-status">
                            Filtrer par statut
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'En cours')">En cours</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Terminés')">Terminés</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- Bouton pour ouvrir l'offcanvas -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasCreateProject" aria-controls="offcanvasCreateProject">
                    Créer un projet
                </button>

                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Nb Tâches</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Créé par</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($project->id); ?></td>
                                    <td><?php echo e($project->title); ?></td>
                                    <td><?php echo e(substr($project->description, 0, 40)); ?></td>
                                    <td><?php echo e($project->tasks->count()); ?> </td>
                                    <td class="text-center">
                                        <?php if($project->finished): ?>
                                            <span class="bg-success text-white p-1"><span class="d-none">En cours</span><i
                                                    class="fas fa-check"></i></span>
                                        <?php else: ?>
                                            <span class="bg-danger text-white px-2 py-1"><span
                                                    class="d-none">Terminés</span><i class="fas fa-times"></i></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(date_format($project->deadline, 'd F Y')); ?></td>
                                    <td><?php echo e($project->user->name); ?></td>
                                    <td><?php echo e(date_format($project->created_at, 'd F Y')); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-primary btn-sm me-2"
                                                href="<?php echo e(route('projects.show', ['project' => $project->id])); ?>"
                                                title="Voir plus">
                                                <i class="far fa-file-alt"></i>
                                            </a>
                                            <form action="<?php echo e(route('projects.destroy', ['project' => $project->id])); ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-danger btn-sm" type="submit" title="Supprimer">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php echo $__env->make('site.pages.project.formAdd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
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
            if (buttonId === 'filter-status') {
                col = 4; // Colonne de status
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

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/project/index.blade.php ENDPATH**/ ?>