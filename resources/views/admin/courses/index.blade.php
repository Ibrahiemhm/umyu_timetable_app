@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Courses List
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('admin.courses.create') }}">Add Course</a>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Course Category</th>
                    <th>Semester</th>
                    <th>Title</th>
                    <th>Course Code</th>
                    <th>Number of Students</th>
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
            ajax: "{{ route('admin.courses.index') }}", // Replace with your route for fetching data
            columns: [
                { data: 'id', name: 'id' },
                { data: 'department', name: 'department' },
                { data: 'course_category', name: 'course_category' },
                { data: 'semester', name: 'semester' },
                { data: 'title', name: 'title' },
                { data: 'course_code', name: 'course_code' },
                { data: 'number_of_students', name: 'number_of_students' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            "scrollX": true,
            pageLength: 100,
        });
    });
</script>
@endsection