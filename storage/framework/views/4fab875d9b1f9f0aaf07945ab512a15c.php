<?php $__env->startSection('title'); ?>
    Vue d'ensemble
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additionnal_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1>Tableau de bord</h1>

        <div class="card">
            <div class="card-body">
                <!-- Cartes des projets -->
                <div class="row mt-4">
                    <!-- Carte des projets terminés -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-check-circle fa-3x me-3"></i>
                                <div>
                                    <h5 class="card-title text-white">Projets terminés</h5>
                                    <p class="card-text fs-4"><?php echo e($completedProjects); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte des projets en cours -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-spinner fa-3x me-3"></i>
                                <div>
                                    <h5 class="card-title text-white">Projets en cours</h5>
                                    <p class="card-text fs-4"><?php echo e($ongoingProjects); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section des statistiques -->
                <div class="row">
                    <!-- Nombre de tâches par statut -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-white">Statut des tâches</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Non commencées :</strong> <?php echo e($status['not_started']); ?>

                                    </li>
                                    <li class="list-group-item">
                                        <strong>En cours :</strong> <?php echo e($status['in_running']); ?>

                                    </li>
                                    <li class="list-group-item">
                                        <strong>Terminées :</strong> <?php echo e($status['ended']); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Nombre de tâches par priorité -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-warning text-white">
                                <h5 class="text-dark">Priorité des tâches</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Faible :</strong> <?php echo e($priority['low']); ?>

                                    </li>
                                    <li class="list-group-item">
                                        <strong>Moyenne :</strong> <?php echo e($priority['medium']); ?>

                                    </li>
                                    <li class="list-group-item">
                                        <strong>Forte :</strong> <?php echo e($priority['high']); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Graphique des tâches par statut -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="text-white">Graphique des tâches par statut</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphique des tâches par priorité -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="text-white">Graphique des tâches par priorité</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="priorityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('additionnal_js'); ?>
    <!-- Ajouter les scripts nécessaires pour Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Graphique des tâches par statut
        let ctx1 = document.getElementById('statusChart').getContext('2d');
        let statusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Non commencées', 'En cours', 'Terminées'],
                datasets: [{
                    label: 'Statut des tâches',
                    data: [<?php echo e($status['not_started']); ?>, <?php echo e($status['in_running']); ?>,
                        <?php echo e($status['ended']); ?>

                    ],
                    backgroundColor: ['#17a2b8', '#ffc107', '#28a745'],
                    borderColor: ['#fff', '#fff', '#fff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Graphique des tâches par priorité
        let ctx2 = document.getElementById('priorityChart').getContext('2d');
        let priorityChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Faible', 'Moyenne', 'Forte'],
                datasets: [{
                    label: 'Priorité des tâches',
                    data: [<?php echo e($priority['low']); ?>, <?php echo e($priority['medium']); ?>, <?php echo e($priority['high']); ?>],
                    backgroundColor: ['#17a2b8', '#ffc107', '#dc3545'],
                    borderColor: ['#fff', '#fff', '#fff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/overview.blade.php ENDPATH**/ ?>