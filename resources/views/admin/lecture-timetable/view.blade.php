@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        View Lecture Timetable ({{ \App\Models\AcademicSession::where('is_active', 1)->first()->title }} - {{ \App\Models\Semester::where('is_active', 1)->first()->title }})
    </div>
    <div class="card-body">
        <table class="table">
    <thead>
        <tr>
            <th>Date / Time</th>
            @foreach($timeSlots as $timeSlot)
                <th>{{ $timeSlot }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($timetableMatrix as $date => $times)
            <tr>
                <td>{{ \Carbon\Carbon::parse($date)->format('l') }}</td>
                @foreach($timeSlots as $timeSlot)
                    <td>
                        @if(isset($times[$timeSlot]) && count($times[$timeSlot]) > 0)
                            @foreach($times[$timeSlot] as $timetable)
                                <div>{{ $timetable->course->title }} ({{ $timetable->venue->title }})</div>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>
@endsection