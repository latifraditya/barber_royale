<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : " " }}" aria-current="page" href="/dashboard">
          <i class="bi bi-speedometer2 me-2"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : " " }}" href="/dashboard/posts">
          <i class="bi bi-calendar-check me-2"></i>
          User Bookings
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/sales*') ? 'active' : '' }}" aria-current="page" href="/dashboard/sales">
          <i class="bi bi-clock-history me-2"></i>
          History
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/supermarkets*') ? 'active' : '' }}" aria-current="page" href="/dashboard/supermarkets">
          <i class="bi bi-receipt-cutoff me-2"></i>   Transaksi
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/supermarkets*') ? 'active' : '' }}" aria-current="page" href="/dashboard/supermarkets">
          <i class="bi bi-bar-chart-line me-2"></i>
          Sales & Revenue
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/supermarkets*') ? 'active' : '' }}" aria-current="page" href="/dashboard/supermarkets">
          <i class="bi bi-gear me-2"></i> 
          Settings
        </a>
      </li>
    </ul>

    @can('admin')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Administrator</span>
    </h6>
    
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}"href="/dashboard/categories">
          <span data-feather="grid"></span>
          Post Categories
        </a>
      </li>
    </ul>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}"href="/dashboard/users">
          <span data-feather="users"></span>
          Manage User
        </a>
      </li>
    </ul>
    @endcan

  </div>
</nav>