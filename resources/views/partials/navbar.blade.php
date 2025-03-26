<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
      {{-- <a class="navbar-brand" href="/">NebulaCode</a> --}}
      <a class="navbar-brand" href="/" style="font-family: 'Roboto', sans-serif; font-weight: 700; letter-spacing: 1px;">
        Barber Royale
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('home') ? 'active' : "" }}" href="/">Home</a>
          </li>
      
          <!-- Conditional link for Admin -->
          @auth
            @if(auth()->user()->is_admin)
            <li class="nav-item">
              <a class="nav-link {{ Request::is('bookings') ? 'active' : "" }}" href="/bookings">Bookings</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/barbers') ? 'active' : "" }}" href="/admin/barbers">Barbers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/services') ? 'active' : "" }}" href="/admin/services">Services</a>
              </li>
              
            @else
              <!-- Conditional link for User (Non-Admin) -->
              <li class="nav-item">
                <a class="nav-link {{ Request::is('bookings') ? 'active' : "" }}" href="/bookings">Bookings</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('barbers') ? 'active' : "" }}" href="/barbers">Barbers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('services') ? 'active' : "" }}" href="/services">Services</a>
              </li>
            @endif
          @endauth
      
          {{-- Other possible links for users or guests --}}
          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('categories') ? 'active' : "" }}" href="/categories">Categories</a>
          </li> --}}
        </ul>
      
        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome, {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/"><i class="bi bi-layout-text-window-reverse"></i> My Bookings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link {{ Request::is('login') ? 'active' : "" }}" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            </li>
          @endauth
        </ul>
      </div>
      
</nav>
