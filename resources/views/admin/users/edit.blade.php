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
        Edit Staff
    </div>
    <div class="card-body">
<<<<<<< Updated upstream
        <form method="POST" action="{{ route('admin.staffs.update', $staff->id) }}">
=======
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
>>>>>>> Stashed changes
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
<<<<<<< Updated upstream
                    <input type="text" id="name" name="name" class="form-control" placeholder="Full name" value="{{ $staff->name }}" required />
=======
                    <input type="text" id="name" name="name" class="form-control" placeholder="Full name" value="{{ old('name', $user->name) }}" required />
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                    <input type="email" id="email" name="email" value="{{ $staff->email }}" class="form-control" placeholder="Email" required />
=======
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Email" required />
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                    <input type="number" min="18" id="age" name="age" value="{{ $staff->age }}" class="form-control" placeholder="Age" />
=======
                    <input type="number" min="18" id="age" name="age" value="{{ old('age', $user->age) }}" class="form-control" placeholder="Age" />
>>>>>>> Stashed changes
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
                      <option value="Male" {{ $staff->gender == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ $staff->gender == 'Female' ? 'selected' : '' }}>Female</option>
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
                      <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->title }}</option>
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
                    <input class="form-control" type="file" name="image" id="image" />
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