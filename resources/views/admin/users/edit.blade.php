@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Full name" value="{{ $user->name }}" required />
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
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email" required />
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
                    <input type="number" min="18" id="age" name="age" value="{{ $user->age }}" class="form-control" placeholder="Age" />
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
                      <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
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