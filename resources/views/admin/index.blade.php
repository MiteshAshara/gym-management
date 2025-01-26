@extends('admin.includes.master')

@section('admin.content')
<main class="main">
  <title>Atmiya Wellness | {{$title}}</title>
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- Optional Title -->
          <!-- <h2 class="fw-bold">Welcome To Users - Dashboard</h2> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class="row mb-2">
      <div class="col-sm-6">
        <span class="m-0 text-secondary">Dashboard</span>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a></li>
          <li class="breadcrumb-item active">dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </div><!-- /.content-header -->

  <!-- Main Content -->
  <div class="container-fluid mt-4">
    <!-- Flexbox container for the two cards -->
    <div class="row">
      <!-- Total Members Card -->
      <div class="col-lg-5 col-md-6">
        <a href="{{ route('member') }}" class="nav-link {{ request()->routeIs('member') ? 'active' : '' }}">
          <div class="card rounded-3 bg-white">
            <div class="card-body text-center p-4">
              <div class="counter bg-primary text-white p-4 rounded-circle d-inline-block mb-3">
                <i class="fas fa-users fa-3x"></i>
              </div>
              <h4 class="mt-3 font-weight-bold text-dark">Total Members: {{ $totalMembers }}</h4>
              <p class="text-muted">Track Total Members</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Upcoming Renewable Card -->
      <div class="col-lg-5 col-md-6">
        <a href="{{ route('reneable') }}" class="nav-link {{ request()->routeIs('reneable') ? 'active' : '' }}">
          <div class="card rounded-3 bg-white">
            <div class="card-body text-center p-4">
              <div class="counter bg-success text-white p-4 rounded-circle d-inline-block mb-3">
                <i class="fas fa-undo-alt fa-3x"></i>
              </div>
              <h4 class="mt-3 font-weight-bold text-dark">Upcoming Renewables: {{ $upcomingReneableCount }}</h4>
              <p class="text-muted">Members Upcoming Renewals</p>
            </div>
          </div>
        </a>
      </div>

    </div>

  </div><!-- /.container-fluid -->
</main>
@endsection