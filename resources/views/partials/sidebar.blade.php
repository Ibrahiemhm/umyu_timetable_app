<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.courses.index') }}">
        <i class="mdi mdi-view-headline menu-icon"></i>
        <span class="menu-title">Courses</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.venues.index') }}">
        <i class="mdi mdi-chart-pie menu-icon"></i>
        <span class="menu-title">Venues</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.lectures-timetable.index') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Lectures Timetable</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.exam-timetable.index') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Exams Timetable</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Configurations</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.faculties.index') }}">Faculties</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.departments.index') }}">Departments</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.semesters.index') }}">Semesters</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.course-categories.index') }}">Course Categories</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.academic-sessions.index') }}">Academic Sessions</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="documentation">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>
