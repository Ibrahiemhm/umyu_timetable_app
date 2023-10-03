@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        View Department
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">Title:</div>
          <div class="col-md-6 mb-4">{{ $department->title ?? '' }}</div>
          <div class="col-md-6 mb-4">Faculty:</div>
          <div class="col-md-6 mb-4">{{ $department->faculty?->title ?? '' }}</div>
          <div class="col-md-6 mb-4">Status:</div>
          <div class="col-md-6 mb-4">{{ $department->status === 1 ? 'Enabled' : 'Disabled' }}</div>
        </div>
    </div>
</div>
@endsection