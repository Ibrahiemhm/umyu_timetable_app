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
        <form method="POST" action="{{ route('admin.departments.update', $department->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Faculty</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="faculty_id" id="faculty_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($faculties as $faculty)
                      <option value="{{ $faculty->id }}" {{ $department->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->title }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('faculty_id'))
                        <span class="text-danger">{{ $errors->first('faculty_id') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title" maxlength="255" class="form-control" placeholder="Department Title" value="{{ $department->title }}" required />
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
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