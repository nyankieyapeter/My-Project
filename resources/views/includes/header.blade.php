  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('home', ['store' => session('selected_store')]) }}" class="logo d-flex align-items-center">
        <img src="{{ asset('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">POS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <span class="fw-bold alert alert-warning" style='padding: 4px 274px 4px 4px;'>
        @hasanyrole('admin|Super Admin') POS (Point of Sale) v1.0 @endhasanyrole

        @unlessrole('admin|Super Admin')
          @if(session('selected_store') == 'cafa')
              &copy; Counter cashier
          @endif
        @endunlessrole

      </span>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('img/avatar.png') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth()->user()->name }}</span>
          </a><!-- End Profile Image Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <img width='40px' src="{{ asset('img/avatar.png') }}" alt="Profile" class="rounded-circle">
              <h6>{{ Auth()->user()->name }}</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index', ['store' => session('selected_store')]) }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
      </ul>

    </nav>

  </header><!-- End Header -->

  <script>
  // JavaScript
  const toggleBtn = document.querySelector('.toggle-sidebar-btn');
  const bod = document.body;

  toggleBtn.addEventListener('click', function () {
    bod.classList.toggle('toggle-sidebar');
  });
  </script>
