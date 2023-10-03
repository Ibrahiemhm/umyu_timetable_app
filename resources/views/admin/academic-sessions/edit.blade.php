@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Course Category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.course-categories.update', $courseCategory->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title" maxlength="255" class="form-control" placeholder="Course Category Title" value="{{ $courseCategory->title }}" required />
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