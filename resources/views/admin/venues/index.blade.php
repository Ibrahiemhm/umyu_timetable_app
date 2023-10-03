@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Venue List
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('admin.venues.create') }}">Add Venue</a>
        <table class="table" id="datatable" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Capacity</th>
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
            ajax: "{{ route('admin.venues.index') }}", // Replace with your route for fetching data
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'capacity', name: 'capacity' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection