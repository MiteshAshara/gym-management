<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <img src="{{ asset('admin/dist/img/au-logo.png') }}" class="img-circle elevation-2 bg-white" alt="User Image" style="width: 40px; height: 40px;">
      </div>
      <div class="info ml-2">
        <p class="d-block text-light mb-0 fw-bold">Hello , {{ Str::ucfirst(auth()->user()->name) }}</p>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2 fw-bold">
      @if(auth()->user()->role == 'admin')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard Link -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} fas fa-tachometer-alt"
               href="{{ route('admin.dashboard') }}">
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Fees Link -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('fees') ? 'active' : '' }} fas fa-money-bill"
               href="{{ route('fees') }}">
              <p>Fees</p>
            </a>
          </li>

          <!-- Members Dropdown -->
          <li class="nav-item {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <p>Members
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('member') }}" class="nav-link {{ request()->routeIs('member') ? 'active' : '' }}">
                  <p>All Members</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reneable') }}" class="nav-link {{ request()->routeIs('reneable') ? 'active' : '' }}">
                  <p>Upcoming Renewables</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Logout Button -->
          <li class="nav-item">
            <a class="nav-link fas fa-sign-out-alt" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
          </li>
          <!-- Logout Form -->
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </ul>
      @endif
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
