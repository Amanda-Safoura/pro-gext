@extends('site.layouts.main')

@section('title', 'Gestion des Comptes Utilisateurs')

@section('additionnal_css')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mt-4">
                <div class="table-responsive">
                    <table id="editableTable" class="display table table-striped table-bordered" cellspacing="0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Status du compte</th>
                                <th>Membre depuis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- Modale de confirmation -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenu dynamique rempli par JavaScript -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelAction"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="confirmAction">Confirmer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('additionnal_js')
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        const FETCHDATAURL = "{{ route('admin.user_accounts.fetch_all') }}"
        const CURRENTURL = "{{ route('admin.user_accounts.index') }}"
        let rowData = {}


        // Initialisation du DataTable
        let table = $('#editableTable').DataTable({
            ajax: FETCHDATAURL, // Endpoint pour récupérer les données
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'is_admin',
                    render: function(data, type, full, meta) {
                        return data == "1" ? '<span class="badge bg-success">Admin</span>' :
                            '<span class="badge bg-info">Standard</span>'
                    }
                },
                {
                    data: 'created_at',
                    render: function(data, type, full, meta) {
                        if (data) {
                            let creationDate = new Date(`${data}`)
                            return creationDate.toLocaleDateString('fr-FR', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            })
                        }
                        return 'N/A'
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return `
                            <button class="change-role-btn btn btn-sm ${full['is_admin'] ? 'btn-danger' : 'btn-success'}" 
                              title="${full['is_admin'] ? 'Retirer les accès Admin' : 'Donner les accès Admin'}">
                                <i class="fas ${full['is_admin'] ? 'fa-user-lock' : 'fa-user-shield'}"></i>
                            </button>

                    `
                    }
                }
            ],
            language: {
                "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/fr-FR.json" // Traduction en français
            }
        });

        $('#editableTable').on('click', '.change-role-btn', function() {
            const rowData = table.row($(this).parents('tr')).data();
            const newState = rowData.is_admin ? 'false' : 'true'; // Inverser l'état actuel

            // Ouvrir le modal de confirmation
            $('#confirmationModal').modal('show');

            // Personnaliser le contenu du modal
            $('#confirmationModal .modal-title').text(rowData.is_admin ? 'Downgrading' : 'Upgrading');
            $('#confirmationModal .modal-body').html(
                `<p>Voulez-vous vraiment <strong>${rowData.is_admin ? 'downgradé' : 'upgradé'}</strong> le compte de <strong>${rowData.name}</strong> ?</p>`
            );

            // Gérer l'action au clic sur le bouton "Confirmer"
            $('#confirmAction').off('click').on('click', function() {
                $.ajax({
                    url: "{{ route('admin.user_accounts.change_role') }}", // Route backend
                    type: 'POST',
                    data: {
                        id: rowData.id,
                        is_admin: newState,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Modifier le contenu du modal pour indiquer le succès
                        $('#confirmationModal .modal-title').text('Succès');
                        $('#confirmationModal .modal-body').html(response.message);

                        // Désactiver le bouton "Confirmer" après succès
                        $('#confirmAction').hide();
                        $('#cancelAction').text('Fermer');

                        // Recharger le DataTable après un délai pour laisser voir le message
                        setTimeout(() => {
                            $('#confirmationModal').modal('hide');
                            table.ajax.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Modifier le contenu du modal pour indiquer une erreur
                        $('#confirmationModal .modal-title').text('Erreur');
                        $('#confirmationModal .modal-body').html(
                            `Une erreur est survenue lors de la mise à jour. Veuillez réessayer.
                            <br><br><p class="text-danger">Erreur: <strong>${xhr.responseText}</strong></p>`
                        );

                        // Désactiver le bouton "Confirmer" après une erreur
                        $('#confirmAction').hide();
                        $('#cancelAction').text('Fermer');
                    }
                });
            });

            // Réinitialiser le modal lors de sa fermeture
            $('#confirmationModal').on('hidden.bs.modal', function() {
                $('#confirmAction').show(); // Réactiver le bouton "Confirmer"
                $('#cancelAction').text('Annuler'); // Remettre le texte par défaut
            });
        });
    </script>
@endsection
