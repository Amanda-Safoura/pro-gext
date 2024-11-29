@extends('site.layouts.main')
@section('title')
    Liste des Tâches
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mt-4">

                <div class="d-flex justify-content-end">

                    <div class="custom-dropdown mx-3">
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-priority">
                            Filtrer par priorité
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Faible')">Faible</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Moyenne')">Moyenne</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Forte')">Forte</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>

                    <div class="custom-dropdown me-3">
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-status">
                            Filtrer par status
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li>
                                <a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Pas encore commencée')">Pas encore
                                    commencée</a>
                            </li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'En cours')">En cours</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Terminée')">Terminée</a>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Bouton pour ouvrir l'offcanvas -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#createTaskOffcanvas" aria-controls="createTaskOffcanvas">
                    Nouvelle Tâche
                </button>

                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dénomination</th>
                                <th>Description</th>
                                <th>Assigné à</th>
                                <th>Priorité</th>
                                <th>Status</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ substr($task->description, 0, 40) }}</td>
                                    <td>{{ $task->user->name }} </td>
                                    <td class="text-center">
                                        @switch($task->priority)
                                            @case('low')
                                                <span class="bg-info text-white p-1" title="Faible">
                                                    <span class="d-none">Faible</span>
                                                    <i class="fas fa-arrow-down"></i>
                                                </span>
                                            @break

                                            @case('medium')
                                                <span class="bg-warning text-white px-2 py-1" title="Moyenne">
                                                    <span class="d-none">Moyenne</span>
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>
                                            @break

                                            @case('high')
                                                <span class="bg-danger text-white px-2 py-1" title="Forte">
                                                    <span class="d-none">Forte</span>
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                            @break

                                            @default
                                                <span class="bg-secondary text-white px-2 py-1" title="Non défini">
                                                    <span class="d-none">Non défini</span>
                                                    <i class="fas fa-question-circle"></i>
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="text-center">
                                        @switch($task->status)
                                            @case('not started')
                                                <span class="bg-info text-white p-1" title="Pas encore commencée">
                                                    <span class="d-none">Pas encore commencée</span>
                                                    <i class="fas fa-clock"></i></span>
                                            @break

                                            @case('in running')
                                                <span class="bg-info text-white p-1" title="En cours"><span class="d-none">En cours</span><i
                                                        class="fas fa-check-circle"></i></span>
                                            @break

                                            @case('ended')
                                                <span class="bg-success text-white p-1" title="Terminée"><span class="d-none">Terminée</span><i
                                                        class="fas fa-truck"></i></span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>{{ date_format($task->created_at, 'd F Y, H:i') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('tasks.show', ['task' => $task->id]) }}" title="Voir plus">
                                                <i class="far fa-file-alt"></i>
                                            </a>
                                            <a class="btn btn-warning btn-sm" href="{{ route('tasks.edit', ['task' => $task->id]) }}" title="Modifier">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('site.pages.task.formAdd')
@endsection

@section('additionnal_js')
    <!-- DataTable -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        let table = $('#editableTable').DataTable()

        function updateDropdown(buttonId, selection) {
            document.getElementById(buttonId).textContent = `Filtrer: ${selection}`;

            // Application du filtre selon le dropdown
            let col;
            let val = selection;

            // Identifie la colonne à filtrer selon le bouton
            if (buttonId === 'filter-priority') {
                col = 4; // Colonne de priorité
            } else if (buttonId === 'filter-status') {
                col = 5; // Colonne de status
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
@endsection
