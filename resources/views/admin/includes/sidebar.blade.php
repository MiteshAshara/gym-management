<aside class="main-sidebar sidebar-dark-primary" style="background: linear-gradient(135deg, #2c3e50, #1a2538); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
      <div class="image">
        <img
          src="https://static.vecteezy.com/system/resources/thumbnails/017/504/043/small_2x/bodybuilding-emblem-and-gym-logo-design-template-vector.jpg"
          class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; border: 2px solid rgba(255,255,255,0.2);">
      </div>
      <div class="info ml-2">
        <p class="d-block text-light mb-0 fw-bold" style="font-size: 1.1rem;">{{ Str::ucfirst(auth()->user()->name) }}</p>
        <span class="badge badge-success">Administrator</span>
      </div>
    </div>
    <nav class="mt-2">
      @if(auth()->user()->role == 'admin')
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}" style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-tachometer-alt mr-2" style="width: 20px; text-align: center;"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header" style="padding: 10px 15px; color: #6c757d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">MEMBERSHIP</li>

        <li class="nav-item {{ 
                      request()->routeIs('fees.structure') ||
                  request()->routeIs('fees') ||
                  request()->routeIs('fees.staff') ||
                  request()->routeIs('fees.non-atmiya') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ 
                      request()->routeIs('fees.structure') ||
                  request()->routeIs('fees') ||
                  request()->routeIs('fees.staff') ||
                  request()->routeIs('fees.non-atmiya') ? 'active' : '' }}"
             style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-money-bill-wave mr-2" style="width: 20px; text-align: center;"></i>
            <p>
              Fees Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="padding-left: 15px; margin-top: 5px;">
            <li class="nav-item">
              <a href="{{ route('fees.structure') }}"
                class="nav-link {{ request()->routeIs('fees.structure') ? 'active' : '' }}" 
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-file-invoice-dollar mr-2" style="width: 20px; text-align: center;"></i>
                <p>Fees Structure</p>
              </a>
            </li>
            
            @if(auth()->user()->email == 'admin@gmail.com')
            <li class="nav-item">
              <a href="{{ route('fees') }}" 
                class="nav-link {{ request()->routeIs('fees') ? 'active' : '' }}"
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-user-graduate mr-2" style="width: 20px; text-align: center;"></i>
                <p>General Membership</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('fees.staff') }}"
                class="nav-link {{ request()->routeIs('fees.staff') ? 'active' : '' }}"
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-users-cog mr-2" style="width: 20px; text-align: center;"></i>
                <p>General Membership + Aerobic / Zumba</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('fees.non-atmiya') }}"
                class="nav-link {{ request()->routeIs('fees.non-atmiya') ? 'active' : '' }}"
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-user-tie mr-2" style="width: 20px; text-align: center;"></i>
                <p>Personal Traning</p>
              </a>
            </li>
            @endif
          </ul>
        </li>

        <li class="nav-header" style="padding: 10px 15px; color: #6c757d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">MEMBER MANAGEMENT</li>

        <li class="nav-item {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ request()->routeIs('member') || request()->routeIs('reneable') ? 'active' : '' }}"
            style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-users mr-2" style="width: 20px; text-align: center;"></i>
            <p>
              Members
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="padding-left: 15px; margin-top: 5px;">
            <li class="nav-item">
              <a href="{{ route('member') }}" 
                class="nav-link {{ request()->routeIs('member') ? 'active' : '' }}"
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-user-plus mr-2" style="width: 20px; text-align: center;"></i>
                <p>Add Members</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('reneable') }}" 
                class="nav-link {{ request()->routeIs('reneable') ? 'active' : '' }}"
                style="padding: 8px 15px; border-radius: 5px; margin-bottom: 5px;">
                <i class="fas fa-calendar-alt mr-2" style="width: 20px; text-align: center;"></i>
                <p>Upcoming Renewables</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header" style="padding: 10px 15px; color: #6c757d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">OTHER MANAGEMENT</li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('inquiries') ? 'active' : '' }}"
            href="{{ route('inquiries') }}"
            style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-question-circle mr-2" style="width: 20px; text-align: center;"></i>
            <p>Inquiries</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('recovery.member') ? 'active' : '' }}"
            href="{{ route('recovery.member') }}"
            style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-undo-alt mr-2" style="width: 20px; text-align: center;"></i>
            <p>Recovery Member</p>
          </a>
        </li>

        <li class="nav-header" style="padding: 10px 15px; color: #6c757d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">ACCOUNT</li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); 
              if(confirm('Are you sure you want to logout?')) { 
                document.getElementById('logout-form').submit(); 
              }"
            style="padding: 12px 15px; border-radius: 5px; margin-bottom: 5px;">
            <i class="fas fa-sign-out-alt mr-2" style="width: 20px; text-align: center;"></i>
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