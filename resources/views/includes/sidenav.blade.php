  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
         <a class="nav-link @if(request()->url() !== route('home', ['store' => session('selected_store')])) collapsed @endif"
                  href="{{ route('home', ['store' => session('selected_store')]) }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if(request()->url() !== route('pos.index', ['store' => session('selected_store')])) collapsed @endif"
           href="{{ route('pos.index', ['store' => session('selected_store')]) }}">
           <i class="bi bi-cart"></i>
            <span>POS</span>
        </a>
      </li><!-- End POS Nav -->

      <li class="nav-item">

        <!--Conditionally assign the class collapsed to the a href lin to highlight it in light blue -->
        <a
          class="nav-link {{ Str::contains(request()->url(), '/management/') ? '' : 'collapsed' }}"
          data-bs-target="#management-nav"
          data-bs-toggle="collapse" href="#">
          <i class="bi bi-shop"></i><span>Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <!-- Conditionally assign the class show to the ul element to toggle it into view -->
        <ul id="management-nav"
            class="nav-content collapse {{ Str::contains(request()->url(), '/management/') ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">

          <li>
            <!--Conditionally assign the class active depending on the url -->
            <a href="{{ route('product.index', ['store' => session('selected_store')]) }}"
               class="{{ request()->url() == route('product.index', ['store' => session('selected_store')]) ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>

            <a href="{{ route('order.index', ['store' => session('selected_store')]) }}"
               class="{{ request()->url() == route('order.index', ['store' => session('selected_store')]) ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Orders</span>
            </a>

            @hasanyrole('admin|manager|Super Admin')
            <a href="{{ route('user.index', ['store' => session('selected_store')]) }}"
               class="{{ request()->url() == route('user.index', ['store' => session('selected_store')]) ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
            @endhasanyrole
          </li>
        </ul>
      </li><!-- End Management Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
            <a href="{{ route('report.index', ['store' => session('selected_store')]) }}"
               class="nav-link {{ request()->url() == route('report.index', ['store' => session('selected_store')]) ? '' : 'collapsed' }}">
              <i class="bi bi-pie-chart-fill"></i>
              <span>Reports</span>
            </a>
      </li>

      <!-- @role('Super Admin') -->
      <!---->
      <!-- <li class="nav-item"> -->
      <!--   <a class="nav-link collapsed" href="pages-register.html"> -->
      <!--     <i class="bi bi-card-list"></i> -->
      <!--     <span>Credit Sales</span> -->
      <!--   </a> -->
      <!-- </li><!-- End Register Page Nav -->
      <!---->
      <!-- <li class="nav-item"> -->
      <!--   <a class="nav-link collapsed" href="pages-login.html"> -->
      <!--     <i class="bi bi-building-fill-x"></i> -->
      <!--     <span>Expired</span> -->
      <!--   </a> -->
      <!-- </li> -->
      <!-- @endrole -->

    </ul>

  </aside><!-- End Sidebar-->
