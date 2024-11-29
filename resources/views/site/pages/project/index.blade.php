@extends('site.layouts.main')
@section('title')
    Projets
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
                        <button class="btn-primary custom-dropdown-toggle" type="button" id="filter-status">
                            Filtrer par statut
                        </button>
                        <ul class="custom-dropdown-menu">
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'En cours')">En cours</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-status', 'Terminés')">Terminés</a></li>
                            <li><a class="custom-dropdown-item" href="javascript:void(0);"
                                    onclick="updateDropdown('filter-priority', 'Tous')">Tous</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- Bouton pour ouvrir l'offcanvas -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasCreateProject" aria-controls="offcanvasCreateProject">
                    Créer un projet
                </button>

                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Nb Tâches</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                @if (auth()->user()->is_admin)
                                    <th>Créé par</th>
                                @endif
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ substr($project->description, 0, 40) }}</td>
                                    <td>{{ $project->tasks->count() }} </td>
                                    <td class="text-center">
                                        @if ($project->finished)
                                            <span class="bg-success text-white p-1"><span class="d-none">En cours</span><i
                                                    class="fas fa-check"></i></span>
                                        @else
                                            <span class="bg-danger text-white px-2 py-1"><span
                                                    class="d-none">Terminés</span><i class="fas fa-times"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ date_format($project->deadline, 'd F Y') }}</td>

                                    @if (auth()->user()->is_admin)
                                        <td>{{ $project->user->name }}</td>
                                    @endif

                                    <td>{{ date_format($project->created_at, 'd F Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-primary btn-sm me-2"
                                                href="{{ route('projects.show', ['project' => $project->id]) }}"
                                                title="Voir plus">
                                                <i class="far fa-file-alt"></i>
                                            </a>
                                            <form action="{{ route('projects.destroy', ['project' => $project->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" title="Supprimer">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('site.pages.project.formAdd')
            </div>
        </div>
    </div>
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
            if (buttonId === 'filter-status') {
                col = 4; // Colonne de status
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
