@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Academic Session List
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('admin.academic-sessions.create') }}">Add Academic Session</a>
        <table class="table" id="datatable" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        // DataTable initialization
        var dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.academic-sessions.index') }}", // Replace with your route for fetching data
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection