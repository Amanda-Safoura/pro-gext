<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?php echo e(route('overview')); ?>">
            <span class="align-middle"><?php echo e(env('APP_NAME')); ?></span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-header">
                Tableau de Bord
            </li>

            <li class="<?php echo \Illuminate\Support\Arr::toCssClasses(['sidebar-item', 'active' => request()->routeIs('overview')]); ?>">
                <a class="sidebar-link" href="<?php echo e(route('overview')); ?>">
                    <i class="fas fa-chart-pie align-middle"></i> <span class="align-middle">Vue d’ensemble</span>
                </a>
            </li>

            <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'sidebar-item',
                'active' => request()->routeIs('notifs.index'),
            ]); ?>">
                <a class="sidebar-link" href="<?php echo e(route('notifs.index')); ?>">
                    <i class="fas fa-history align-middle"></i> <span class="align-middle">Activités récentes</span>
                </a>
            </li>


            <li class="sidebar-header">
                Projets
            </li>

            <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'sidebar-item',
                'active' => request()->routeIs('projects.index'),
            ]); ?>">
                <a class="sidebar-link" href="<?php echo e(route('projects.index')); ?>">
                    <i class="fas fa-book align-middle"></i> <span class="align-middle">Liste des projets</span>
                </a>
            </li>

            <?php if(auth()->user()->is_admin): ?>
                <li class="sidebar-header">
                    Utilisateurs
                </li>

                <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'sidebar-item',
                    'active' => request()->routeIs('admin.user_accounts.index'),
                ]); ?>">
                    <a class="sidebar-link" href="<?php echo e(route('admin.user_accounts.index')); ?>">
                        <i class="fas fa-book align-middle"></i> <span class="align-middle">Liste des
                            utilisateurs</span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>
<?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/partials/sidebar.blade.php ENDPATH**/ ?>