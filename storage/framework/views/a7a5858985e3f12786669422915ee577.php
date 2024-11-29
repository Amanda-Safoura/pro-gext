<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <title><?php echo e(env('APP_NAME')); ?> | <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
</head>

<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 shadow-lg rounded overflow-hidden">
            <!-- Left Image Section -->
            <div class="col-md-6 p-0">
                <img src="https://placehold.co/600x800" alt="Image" class="img-fluid h-100 w-100">
            </div>
            <!-- Right Form Section -->
            <div class="col-md-6 bg-light p-5">
                <div class="mt-5">
                    <?php echo $__env->yieldContent('page_content'); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="<?php echo e(asset('assets/js/core/bootstrap.min.js')); ?>"></script>

</body>

</html>
<?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/site/layouts/auth.blade.php ENDPATH**/ ?>