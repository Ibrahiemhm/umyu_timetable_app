@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Exam Timetable
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('admin.exam-timetable.create') }}">Add Exam Timetable</a> 
        <a class="btn btn-primary mb-3" href="{{ route('admin.exam-timetable.view') }}">View Timetable</a>
        <table class="table" id="datatable" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Venue</th>
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
            ajax: "{{ route('admin.exam-timetable.index') }}", // Replace with your route for fetching data
            columns: [
                { data: 'id', name: 'id' },
                { data: 'course', name: 'course' },
                { data: 'date', name: 'date' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'venue', name: 'venue' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection