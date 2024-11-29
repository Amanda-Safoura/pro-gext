<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ env('APP_NAME') }} &amp; Dashboard">
    <meta name="author" content="Amanda Safoura">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <style>
        /* Styles pour le dropdown personnalisé */
        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown-toggle {
            background-color: #0d6efd;
            color: #fff;
            padding: 6px 12px;
            /* Réduit le padding */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            /* Réduit la taille de la police */
        }

        .custom-dropdown-toggle:hover {
            background-color: #0b5ed7;
        }

        .custom-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            min-width: 150px;
            /* Ajuste la largeur minimale */
            padding: 4px 0;
            /* Réduit le padding */
            margin: 4px 0 0;
            font-size: 14px;
            /* Réduit la taille de la police */
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            overflow: auto;
            /* Ajoute le défilement si nécessaire */
        }

        .custom-dropdown-menu.show {
            display: block;
        }

        .custom-dropdown-item {
            display: block;
            width: 100%;
            padding: 6px 12px;
            /* Réduit le padding */
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .custom-dropdown-item:hover {
            background-color: #e9ecef;
            color: #212529;
        }
    </style>

    @yield('additionnal_css')
</head>

<body>
    <div class="wrapper">
        @include('site.partials.sidebar')

        <div class="main">
            @include('site.partials.navbar')

            <main class="content">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
        // fonction générique pour gérer les notifications
        function showNotif(type = 'success', title = '<strong>Success!</strong>', icon = 'fa fa-bell', message =
            'Your password has been successfully changed.') {

            $.notify({
                title,
                icon,
                message
            }, {
                type,
                allow_dismiss: true,
                delay: 3000,
                placement: {
                    from: "top",
                    align: "left"
                },
                animate: {
                    enter: 'animated fadeInLeft',
                    exit: 'animated fadeOutLeft'
                }
            })

        }

        @if (session('success'))
            showNotif('success', '<strong>Success!</strong>', 'fa fa-bell', "{{ session('success') }}")
        @endif


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-dropdown').forEach(function(dropdown) {
                const toggleButton = dropdown.querySelector('.custom-dropdown-toggle');
                const menu = dropdown.querySelector('.custom-dropdown-menu');

                toggleButton.addEventListener('click', function(event) {
                    event.stopPropagation();

                    // Ferme tous les autres dropdowns
                    document.querySelectorAll('.custom-dropdown-menu').forEach(function(otherMenu) {
                        if (otherMenu !== menu) {
                            otherMenu.classList.remove('show');
                        }
                    });

                    menu.classList.toggle('show');

                    // Vérifie la position du bouton et ajuste le menu
                    const rect = toggleButton.getBoundingClientRect();
                    const menuHeight = menu.offsetHeight;
                    const menuWidth = menu.scrollWidth; // La largeur du menu
                    const windowWidth = window.innerWidth;
                    const windowHeight = window.innerHeight;

                    // Ajuste la position verticale
                    if (rect.bottom + menuHeight > windowHeight) {
                        menu.style.top = 'auto';
                        menu.style.bottom = '100%'; // Affiche au-dessus du bouton
                    } else {
                        menu.style.top = '100%'; // Affiche en dessous du bouton
                        menu.style.bottom = 'auto';
                    }

                    // Ajuste la position horizontale
                    if (rect.left + menuWidth > windowWidth) {
                        menu.style.left = 'auto';
                        menu.style.right = '0'; // Aligne le menu à droite du bouton
                    } else {
                        menu.style.left = '0'; // Aligne le menu à gauche du bouton
                        menu.style.right = 'auto';
                    }
                });

                menu.querySelectorAll('.custom-dropdown-item').forEach(function(item) {
                    item.addEventListener('click', function(event) {
                        event.preventDefault();
                        toggleButton.innerText = item
                            .innerText; // Met à jour le texte du bouton
                        menu.classList.remove('show'); // Masque le menu
                    });
                });
            });

            // Masque tous les menus si on clique ailleurs sur la page
            document.addEventListener('click', function() {
                document.querySelectorAll('.custom-dropdown-menu').forEach(function(menu) {
                    menu.classList.remove('show');
                });
            });
        });
    </script>


    @yield('additionnal_js')

</body>

</html>
