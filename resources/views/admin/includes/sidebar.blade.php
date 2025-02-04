<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <img src="{{ asset('admin/dist/img/au-logo.png') }}" class="img-circle elevation-2 bg-white" alt="User Image"
          style="width: 40px; height: 40px;">
      </div>
      <div class="info ml-2">
        <p class="d-block text-light mb-0 fw-bold">Hello , {{ Str::ucfirst(auth()->user()->name) }}</p>
      </div>
    </div>
    <nav class="mt-2 fw-bold">
      @if(auth()->user()->role == 'admin')
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} fas fa-tachometer-alt"
        href="{{ route('admin.dashboard') }}">
        <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-item {{ 
      request()->routeIs('fees.structure') ||
    request()->routeIs('fees') ||
    request()->routeIs('fees.staff') ||
    request()->routeIs('fees.non-atmiya') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ 
      request()->routeIs('fees.structure') ||
    request()->routeIs('fees') ||
    request()->routeIs('fees.staff') ||
    request()->routeIs('fees.non-atmiya') ? 'active' : '' }}">
        <i class="fas fa-money-bill-wave"></i>
        <p>Fees
          <i class="fas fa-angle-left right"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('fees.structure') }}"
          class="nav-link {{ request()->routeIs('fees.structure') ? 'active' : '' }}">
          <i class="fas fa-file-invoice-dollar"></i>
          <p>Fees Structure</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('fees') }}" class="nav-link {{ request()->routeIs('fees') ? 'active' : '' }}">
          <i class="fas fa-user-graduate"></i>
          <p>Atmiya Student</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('fees.staff') }}"
          class="nav-link {{ request()->routeIs('fees.staff') ? 'active' : '' }}">
          <i class="fas fa-users-cog"></i>
          <p>Atmiya Staff</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('fees.non-atmiya') }}"
          class="nav-link {{ request()->routeIs('fees.non-atmiya') ? 'active' : '' }}">
          <i class="fas fa-user-tie"></i>
          <p>Non Atmiya</p>
          </a>
        </li>
        </ul>
      </li>

      <li class="nav-item {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'menu-open' : '' }}">
        <a href="#"
        class="nav-link {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <p>Members
          <i class="fas fa-angle-left right"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('member') }}" class="nav-link {{ request()->routeIs('member') ? 'active' : '' }}">
          <i class="fas fa-user-plus"></i>
          <p>Add Members</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('reneable') }}" class="nav-link {{ request()->routeIs('reneable') ? 'active' : '' }}">
          <i class="fas fa-calendar-alt"></i>
          <p>Upcoming Renewables</p>
          </a>
        </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link fas fa-sign-out-alt" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <p>Logout</p>
        </a>
      </li>

      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
      </form>
      </ul>
    @endif
    </nav>
  </div>
</aside>