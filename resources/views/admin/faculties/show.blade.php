@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        View Faculty
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">Title:</div>
          <div class="col-md-6 mb-4">{{ $faculty->title ?? '' }}</div>
          <div class="col-md-6 mb-4">Status:</div>
          <div class="col-md-6 mb-4">{{ $faculty->status === 1 ? 'Enabled' : 'Disabled' }}</div>
        </div>
    </div>
</div>
@endsection