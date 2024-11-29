<?php $__env->startSection('mail_content'); ?>
    <div class="card mx-auto" style="max-width: 500px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="card-body text-center">
            <h1 class="card-title text-dark" style="font-size: 1.75rem; font-weight: 700;">Bienvenue !</h1>
            <p class="card-text" style="color: #6c757d; font-size: 1rem;">
                Merci de vous être inscrit(e) ! Veuillez vérifier votre adresse mail pour compléter
                votre inscription.
            </p>
            <a href="<?php echo e(route('verify-email', ['token' => $token])); ?>" class="btn btn-primary btn-lg"
                style="margin-top: 20px; background-color: #007bff; border-color: #007bff; padding: 10px 20px; border-radius: 5px; font-size: 1rem; text-transform: uppercase; font-weight: 600;">
                Vérifier mon adresse mail
            </a>
            <p style="margin-top: 20px; font-size: 0.9rem; color: #6c757d;">
                Si vous n'avez pas créé de compte, veuillez ignorer cet e-mail.
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('mails.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/mails/verify-email.blade.php ENDPATH**/ ?>