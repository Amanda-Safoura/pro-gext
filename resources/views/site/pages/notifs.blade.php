@extends('site.layouts.main')

@section('title', 'Notifications récentes')

@section('additionnal_css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Historique des notifications</h5>

            <form id="bulk-update-form">
                @csrf
                <div class="mb-3">
                    <button type="button" id="mark-as-read" class="btn btn-success">Marquer comme lu</button>
                    <button type="button" id="mark-as-unread" class="btn btn-warning">Marquer comme non lu</button>
                </div>
                <div class="table-responsive">
                    <table id="notifs-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>#</th>
                                <th>Notification</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
            <!-- Bootstrap Modal -->
            <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="feedbackModalLabel">Modifier le status de lecture</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Le message sera injecté ici dynamiquement -->
                            <p id="modal-message"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('additionnal_js')
    <!-- DataTables JS -->
    <script src="{{ asset('assets/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $(document).ready(function() {
                let table = $('#notifs-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('notifs.datas') }}",
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `<input type="checkbox" class="notif-checkbox" value="${row.id}">`;
                            }
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'content',
                            name: 'content'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'read',
                            name: 'read',
                            render: function(data, type, row) {
                                let badgeClass = data ? 'success' : 'secondary';
                                let text = data ? 'Lu' : 'Non lu';
                                return `<span class="badge bg-${badgeClass}">${text}</span>`;
                            }
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                        <button type="button" class="btn btn-sm btn-outline-success update-status" data-id="${row.id}" data-read="true">Marquer comme lu</button>
                        <button type="button" class="btn btn-sm btn-outline-warning update-status" data-id="${row.id}" data-read="false">Marquer comme non lu</button>
                    `;
                            }
                        }
                    ]
                });
            });

            // Handle select-all checkbox
            $('#select-all').on('click', function() {
                $('.notif-checkbox').prop('checked', $(this).is(':checked'));
            });

            // Fonction pour afficher le modal
            function showModal(title, message) {
                $('#feedbackModalLabel').text(title); // Met à jour le titre
                $('#modal-message').text(message); // Met à jour le message
                let feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'), {});
                feedbackModal.show(); // Affiche le modal
            }

            // AJAX function for updating read status
            function updateReadStatus(isRead, ids = null) {
                if (!ids) {
                    ids = $('.notif-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                }

                if (ids.length === 0) {
                    showModal('Erreur', 'Veuillez sélectionner au moins une notification.');
                    return;
                }

                $.ajax({
                    url: "{{ route('notifs.change-read-status') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: ids,
                        read: isRead
                    },
                    success: function(response) {
                        ids.forEach(function(id) {
                            let row = $(`input[value="${id}"]`).closest('tr');
                            // Update the badge
                            let badge = row.find('span.badge');
                            badge.removeClass('bg-success bg-secondary');
                            badge.addClass(isRead ? 'bg-success' : 'bg-secondary');
                            badge.text(isRead ? 'Lu' : 'Non lu');

                            // Uncheck the checkbox
                            row.find('.notif-checkbox').prop('checked', false);
                        });

                        // Deselect "select all" checkbox if active
                        $('#select-all').prop('checked', false);

                        showModal('Succès', response.message);
                    },
                    error: function() {
                        showModal('Erreur', 'Une erreur est survenue.');
                    }
                });
            }

            // Bulk button handlers
            $('#mark-as-read').on('click', function() {
                updateReadStatus(true);
            });

            $('#mark-as-unread').on('click', function() {
                updateReadStatus(false);
            });

            // Individual update button handler
            $(document).on('click', '.update-status', function() {
                let id = $(this).data('id');
                let isRead = $(this).data('read');
                updateReadStatus(isRead, [id]);

                // Update the UI immediately for user feedback
                let row = $(this).closest('tr');
                let badge = row.find('span.badge');
                badge.removeClass('bg-success bg-secondary');
                badge.addClass(isRead ? 'bg-success' : 'bg-secondary');
                badge.text(isRead ? 'Lu' : 'Non lu');
            });
        });
    </script>
@endsection
