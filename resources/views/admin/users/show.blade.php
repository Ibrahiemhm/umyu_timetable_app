@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        View User
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">Name:</div>
          <div class="col-md-6 mb-4">{{ $user->name ?? '' }}</div>
          <div class="col-md-6 mb-4">Email:</div>
          <div class="col-md-6 mb-4">{{ $user->email ?? '' }}</div>
          <div class="col-md-6 mb-4">Age:</div>
          <div class="col-md-6 mb-4">{{ $user->age ?? '' }}</div>
          <div class="col-md-6 mb-4">Gender:</div>
          <div class="col-md-6 mb-4">{{ $user->gender ?? '' }}</div>
          <div class="col-md-6 mb-4">Status:</div>
          <div class="col-md-6 mb-4">{{ $user->status === 1 ? 'Enabled' : 'Disabled' }}</div>
        </div>
    </div>
</div>
@endsection
