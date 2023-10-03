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
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
            <i class="mdi mdi-download text-muted"></i>
          </button>
          <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
            <i class="mdi mdi-clock-outline text-muted"></i>
          </button>
          <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
            <i class="mdi mdi-plus text-muted"></i>
          </button>
          <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
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
                  <h5 class="me-2 mb-0">12,222</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-hospital-building me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Faculties</small>
                  <h5 class="me-2 mb-0">2121</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-briefcase me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Departments</small>
                  <h5 class="me-2 mb-0">9833550</h5>
                </div>
              </div>
              <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-switch me-3 icon-lg text-warning"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Students</small>
                  <h5 class="me-2 mb-0">2233783</h5>
                </div>
              </div>
              <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-pin me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                  <small class="mb-1 text-muted">Venues</small>
                  <h5 class="me-2 mb-0">349</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Heading</p>
          <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
          <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
          <canvas id="cash-deposits-chart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Heading 2</p>
          <h1>28835</h1>
          <h4>To start a blog, think of a topic</h4>
          <p class="text-muted">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
          <div id="total-sales-chart-legend"></div>                  
        </div>
        <canvas id="total-sales-chart"></canvas>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Recent tasks</p>
          <div class="table-responsive">
            <table id="recent-purchases-listing" class="table">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Status report</th>
                    <th>Department</th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Number</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>Jeremy Ortega</td>
                    <td>Levelled up</td>
                    <td>Catalinaborough</td>
                    <td>790</td>
                    <td>06 Jan 2018</td>
                    <td>2274253</td>
                </tr>
                <tr>
                    <td>Alvin Fisher</td>
                    <td>Ui design completed</td>
                    <td>East Mayra</td>
                    <td>23230</td>
                    <td>18 Jul 2018</td>
                    <td>83127</td>
                </tr>
                <tr>
                    <td>Emily Cunningham</td>
                    <td>support</td>
                    <td>Makennaton</td>
                    <td>939</td>
                    <td>16 Jul 2018</td>
                    <td>29177</td>
                </tr>
                <tr>
                    <td>Minnie Farmer</td>
                    <td>support</td>
                    <td>Agustinaborough</td>
                    <td>30</td>
                    <td>30 Apr 2018</td>
                    <td>44617</td>
                </tr>
                <tr>
                    <td>Betty Hunt</td>
                    <td>Ui design not completed</td>
                    <td>Lake Sandrafort</td>
                    <td>571</td>
                    <td>25 Jun 2018</td>
                    <td>78952</td>
                </tr>
                <tr>
                    <td>Myrtie Lambert</td>
                    <td>Ui design completed</td>
                    <td>Cassinbury</td>
                    <td>36</td>
                    <td>05 Nov 2018</td>
                    <td>36422</td>
                </tr>
                <tr>
                    <td>Jacob Kennedy</td>
                    <td>New project</td>
                    <td>Cletaborough</td>
                    <td>314</td>
                    <td>12 Jul 2018</td>
                    <td>34167</td>
                </tr>
                <tr>
                    <td>Ernest Wade</td>
                    <td>Levelled up</td>
                    <td>West Fidelmouth</td>
                    <td>484</td>
                    <td>08 Sep 2018</td>
                    <td>50862</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection