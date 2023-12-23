@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection



@section('content')
<div class="card">
    <div class="card-header">
        Add Exam Timetable
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.exam-timetable.store') }}" id="timetableForm">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Course</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="course_id" id="course_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('course_id'))
                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Venue</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="venue_id" id="venue_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($venues as $venue)
                      <option value="{{ $venue->id }}">{{ $venue->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('venue_id'))
                        <span class="text-danger">{{ $errors->first('venue_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Date</label>
                  <div class="col-sm-9">
                    <input type="date" id="date" name="date" maxlength="255" class="form-control" placeholder="Date" required />
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Start Time</label>
                  <div class="col-sm-9">
                    <input type="time" id="start_time" name="start_time" maxlength="255" class="form-control" required />
                    @if($errors->has('start_time'))
                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">End Time</label>
                  <div class="col-sm-9">
                    <input type="time" id="end_time" name="end_time" maxlength="255" class="form-control" required />
                    @if($errors->has('end_time'))
                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary mb-3" type="submit">Save</button>
        </form>
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });

  $('#timetableForm').submit(function(e) {
    e.preventDefault();

    // Collect form data
    var formData = {
        course_id: $('#course_id').val(),
        date: $('#date').val(),
        venue_id: $('#venue_id').val(),
        start_time: $('#start_time').val(),
        end_time: $('#end_time').val(),
    };

    // AJAX call to check for duplicates
    $.ajax({
        url: '{{ route("admin.exam-timetable.checkDuplicates") }}',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.exists) {
              Swal.fire({
                title: 'Duplicate entry found',
                text: "Duplicate entry found! Choose another date, venue or timeslot",
                icon: 'warning',
                background: '#fff',
                // showCancelButton: true,
                confirmButtonText: 'ok!',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    // cancelButton: 'btn btn-label-primary'
                },
                buttonsStyling: false,
            });
                // alert('Duplicate entry found! Choose another date, venue or timeslot');
            } else {
                // Proceed with form submission if no duplicate
                $('#timetableForm').unbind('submit').submit();
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>

@endsection