@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        View Course Category
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">Title:</div>
          <div class="col-md-6 mb-4">{{ $academicSession->title ?? '' }}</div>
          <div class="col-md-6 mb-4">Start Date:</div>
          <div class="col-md-6 mb-4">{{ $academicSession->start_date ?? '' }}</div>
          <div class="col-md-6 mb-4">End Date:</div>
          <div class="col-md-6 mb-4">{{ $academicSession->end_date ?? '' }}</div>
          <div class="col-md-6 mb-4">Status:</div>
          <div class="col-md-6 mb-4">{{ $academicSession->status === 1 ? 'Enabled' : 'Disabled' }}</div>
        </div>
    </div>
</div>
@endsection