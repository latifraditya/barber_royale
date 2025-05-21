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
        <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : " " }}" href="/dashboard">
          <i class="bi bi-calendar-check me-2"></i>
          User Bookings
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/transaction*') ? 'active' : '' }}" aria-current="page" href="/dashboard/transactions">
          <i class="bi bi-receipt-cutoff me-2"></i> Transaksi
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/sales*') ? 'active' : '' }}" aria-current="page" href="/dashboard/sales">
          <i class="bi bi-bar-chart-line me-2"></i>
          Sales & Revenue
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}" aria-current="page" href="/dashboard/settings">
          <i class="bi bi-gear me-2"></i> 
          Settings
        </a>
      </li>
    </ul>
  </div>
</nav>