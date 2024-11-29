<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="javascript:void(0);" id="alertsDropdown"
                    data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator"><?php echo e($notifsCount); ?></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        <?php echo e($notifsCount); ?> Nouvelles Notifications
                    </div>
                    <div class="list-group">
                        <?php $__currentLoopData = $notifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="javascript:void(0);" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <span class="text-<?php echo e($notif->color); ?>"><i
                                                class="<?php echo e($notif->icon); ?>"></i></span>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark"><?php echo $notif->content; ?>

                                        </div>
                                        <div class="text-muted small mt-1"><?php echo e($notif->created_at->diffForHumans()); ?>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="<?php echo e(route('notifs.index')); ?>" class="text-muted">Voir toutes les notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <span class="text-dark"><?php echo e(auth()->user()->name); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="align-middle me-1"
                            data-feather="user"></i> Profil</a>
                    <div class="dropdown-divider"></div>

                    <button class="dropdown-item">
                        <form action="<?php echo e(route('logout')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="all:unset; cursor: pointer;" class="ms-4">Déconnexion
                        </form>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/partials/navbar.blade.php ENDPATH**/ ?>