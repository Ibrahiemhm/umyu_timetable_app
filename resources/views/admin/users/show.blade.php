@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Add Staff
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">Name:</div>
          <div class="col-md-6 mb-4">{{ $staff->name ?? '' }}</div>
          <div class="col-md-6 mb-4">Email:</div>
          <div class="col-md-6 mb-4">{{ $staff->email ?? '' }}</div>
          <div class="col-md-6 mb-4">Age:</div>
          <div class="col-md-6 mb-4">{{ $staff->age ?? '' }}</div>
          <div class="col-md-6 mb-4">Gender:</div>
          <div class="col-md-6 mb-4">{{ $staff->gender ?? '' }}</div>
          <div class="col-md-6 mb-4">Status:</div>
          <div class="col-md-6 mb-4">{{ $staff->status === 1 ? 'Enabled' : 'Disabled' }}</div>
        </div>
    </div>
</div>
@endsection