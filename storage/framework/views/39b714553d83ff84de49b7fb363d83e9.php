<?php $__env->startSection('title', 'Se connecter'); ?>

<?php $__env->startSection('page_content'); ?>

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Connexion</h2>
    <form action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Saisissez votre email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Saisissez votre password" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember"><i class="fas fa-check"></i> Se rappeler de moi</label>

        </div>

        <div class="col-12">
            <?php $__errorArgs = ['general'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-underline text-secondary">Mot de passe
                oublié?</a>
            <a href="<?php echo e(route('register')); ?>" class="text-secondary text-decoration-underline">Inscription</a>
        </div>

        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/auth/login_page.blade.php ENDPATH**/ ?>