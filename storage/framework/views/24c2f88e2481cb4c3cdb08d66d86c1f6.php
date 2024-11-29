<?php $__env->startSection('title', 'S\'inscrire'); ?>

<?php $__env->startSection('page_content'); ?>

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Inscription</h2>
    <form action="<?php echo e(route('register')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label"><i class="fas fa-user"></i>Username</label>
            <input type="text" name="name" id="name" class="form-control" data-error="Saisissez votre nom">
            <?php $__errorArgs = ['name'];
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
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i>Email</label>
            <input type="text" name="email" id="email" class="form-control" required
                data-error="Saisissez votre adresse mail">
            <?php $__errorArgs = ['email'];
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
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i>Mot de passe</label>
            <input class="form-control" type="password" name="password">
            <?php $__errorArgs = ['password'];
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
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i>Confirmer votre mot de
                passe</label>
            <input class="form-control" type="password" name="password_confirmation">
            <?php $__errorArgs = ['password_confirmation'];
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
            <p>
                Vous avez déjà un compte ?
                <a href="<?php echo e(route('login_page')); ?>" class="text-secondary text-decoration-underline">Connectez-vous</a>
            </p>

        </div>
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i>
            S'inscrire
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/pages/auth/register_page.blade.php ENDPATH**/ ?>