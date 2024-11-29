<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Email</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <!-- Lien vers Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Ajout de styles personnalisés */
        .email-header,
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .email-footer {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .social-icons a {
            margin: 0 10px;
            color: #6c757d;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #495057;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="email-header">
        <h1>Amanda Software Tech</h1>
        <p>Concevoir des solutions innovantes pour voir demain autrement.</p>
    </div>

    <!-- Contenu principal -->
    <div class="container my-4">
        <?php echo $__env->yieldContent('mail_content'); ?>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        <p>Suivez-nous sur :</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 Amanda Software Tech. Tous droits réservés.</p>
    </div>
</body>

</html>
<?php /**PATH /home/amanda/Documents/workflow/laravel projects/Gestion de projets/resources/views/mails/layouts/main.blade.php ENDPATH**/ ?>