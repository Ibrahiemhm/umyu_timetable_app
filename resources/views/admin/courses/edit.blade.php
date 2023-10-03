@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Edit Department
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Department</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="department_id" id="department_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($departments as $department)
                      <option value="{{ $department->id }}" {{ $course->department_id == $department->id ? 'selected' : '' }}>{{ $department->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('department_id'))
                        <span class="text-danger">{{ $errors->first('department_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Course Category</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="course_category_id" id="course_category_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($course_categories as $course_category)
                      <option value="{{ $course_category->id }}" {{ $course->course_category_id == $course_category->id ? 'selected' : '' }}>{{ $course_category->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('course_category_id'))
                        <span class="text-danger">{{ $errors->first('course_category_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Semester</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="semester_id" id="semester_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($semesters as $semester)
                      <option value="{{ $semester->id }}" {{ $course->semester_id == $semester->id ? 'selected' : '' }}>{{ $semester->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('semester_id'))
                        <span class="text-danger">{{ $errors->first('semester_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title" maxlength="255" class="form-control" placeholder="Course Title" value="{{ old('title', $course->title) }}" required />
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Course Code</label>
                  <div class="col-sm-9">
                    <input type="text" id="course_code" name="course_code" maxlength="255" class="form-control" placeholder="Course Code" value="{{ old('course_code', $course->course_code) }}" required />
                    @if($errors->has('course_code'))
                        <span class="text-danger">{{ $errors->first('course_code') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Number of Students</label>
                  <div class="col-sm-9">
                    <input type="text" id="number_of_students" name="number_of_students" maxlength="255" class="form-control" placeholder="Number of Students" value="{{ old('number_of_students', $course->number_of_students) }}" required />
                    @if($errors->has('number_of_students'))
                        <span class="text-danger">{{ $errors->first('number_of_students') }}</span>
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