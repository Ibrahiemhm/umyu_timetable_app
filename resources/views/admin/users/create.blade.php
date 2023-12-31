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
        Add User
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Full name" required />
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required />
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Age</label>
                  <div class="col-sm-9">
                    <input type="number" min="18" id="age" name="age" class="form-control" placeholder="Age" />
                    @if($errors->has('age'))
                        <span class="text-danger">{{ $errors->first('age') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Gender</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="gender" id="gender" required>
                      <option selected disabled value="">Please Select</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Department</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="department_id" id="department_id" required>
                      <option selected disabled value="">Please Select</option>
                      @foreach($departments as $department)
                      <option value="{{ $department->id }}">{{ $department->title }}</option>
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
                  <label class="col-sm-3 col-form-label">Image</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" id="image" name="image">
                    @if($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
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