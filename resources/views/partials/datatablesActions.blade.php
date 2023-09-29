


    <a class="btn btn-sm btn-success" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="mdi mdi-eye" aria-hidden="true"></i>
    </a>


    <a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="mdi mdi-border-color" aria-hidden="true"></i>
    </a>


    <form id="datatableDeleteForm" action="" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    
    <button type="button" class="btn btn-sm delete-button {{ $row->status == 1 ? 'btn-danger' : 'btn-primary' }}" id="deleteButton" data-id="{{ $row->id }}">
        @if($row->status == 1)
        <i class="mdi mdi-account-off" aria-hidden="true"></i>
        @else
        <i class="mdi mdi-account-check" aria-hidden="true"></i>
        @endif
    </button>
</form>
<script>
    $(document).ready(function() {
        var dataTable = $('#datatable').DataTable();

        $('.delete-button').on('click', function(event) {
            event.preventDefault();
            
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                background: '#fff',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-primary'
                },
                buttonsStyling: false,
            }).then(result => {
                if (result.isConfirmed) {
                    // Use AJAX to perform the delete operation
                    $.ajax({
                        url: '{{ route('admin.' . $crudRoutePart . '.destroy', '__ID__') }}'.replace('__ID__', id),
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function () {
                            $('.pageLoader').show();
                        },
                        success: function(response) {
                            $('.pageLoader').hide();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The item has been deleted.',
                                icon: 'success',
                                background: '#fff',
                                customClass: {
                                    confirmButton: 'btn btn-label-primary'
                                },
                                buttonsStyling: false
                            }).then(() => {
                                // Optionally, you can refresh the page or update the list of items here
                                // location.reload();
                                dataTable.ajax.reload();
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the item.',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-label-primary'
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                }
            });
        });
    });
</script>