@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;</p>
          </div>
        </div>
        <div class="justify-content-between align-items-end">
          <a class="btn btn-primary mb-3 mr-3" href="{{ route('admin.lecture-timetable.view') }}">Lecture Timetable</a>
          
          <a class="btn btn-primary mb-3" href="{{ route('admin.exam-timetable.view') }}">Exam Timetable</a>
          
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          Dashboard Summary
        </div>
        <div class="card-body dashboard-tabs p-0">
          
          <div class="tab-content py-0 px-0">
            <div class="d-flex flex-wrap justify-content-xl-between">
              <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-multiple icon-lg me-3 text-primary"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Users</small>
                  <h5 class="me-2 mb-0">{{ \App\Models\User::count() }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-hospital-building me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Faculties</small>
                  <h5 class="me-2 mb-0">{{ \App\Models\Faculty::count() }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-briefcase me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Departments</small>
                  <h5 class="me-2 mb-0">{{ \App\Models\Department::count() }}</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-switch me-3 icon-lg text-warning"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Students</small>
                  <h5 class="me-2 mb-0">{{ \App\Models\Course::sum('number_of_students') }}</h5>
                </div>
              </div>
              <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-pin me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Venues</small>
                  <h5 class="me-2 mb-0">{{ \App\Models\Venue::count() }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
</div>
@endsection