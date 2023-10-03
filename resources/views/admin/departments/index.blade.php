@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Department List
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('admin.departments.create') }}">Add Department</a>
        <table class="table" id="datatable" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Faculty</th>
                    <th>Title</th>
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
            ajax: "{{ route('admin.departments.index') }}", // Replace with your route for fetching data
            columns: [
                { data: 'id', name: 'id' },
                { data: 'faculty', name: 'faculty' },
                { data: 'title', name: 'title' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection