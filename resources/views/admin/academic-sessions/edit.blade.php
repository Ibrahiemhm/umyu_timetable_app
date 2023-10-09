@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Course Category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.academic-sessions.update', $academicSession->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title" maxlength="255" class="form-control" placeholder="Title" value="{{ old('title', $academicSession->title) }}" required />
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Start Date</label>
                  <div class="col-sm-9">
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $academicSession->start_date) }}" required />
                    @if($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $academicSession->end_date) }}" required />
                    @if($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
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