<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="brand-link text-decoration-none text-center">
      <img src="{{ asset('img/yazaki-text.png') }}" width="150" alt="">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <span class="d-block text-bold text-center text-decoration-none">{{ Auth::user()->name }}</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/" class="nav-link {{ $title === 'Dashboard' ? "active" : '' }}">
              <i class="nav-icon fas fa-gauge"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Auth::user()->type === 'l/d')
          <li class="nav-item">
            <a href="/box" class="nav-link {{ $title === 'BOX' ? "active" : '' }}">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Box
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pt-56" class="nav-link {{ $title === 'PT.56' ? "active" : '' }}">
              <i class="nav-icon fas fa-boxes-stacked"></i>
              <p>
                PT.56
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pt-37" class="nav-link {{ $title === 'PT.37' ? "active" : '' }}">
              <i class="nav-icon fas fa-boxes-stacked"></i>
              <p>
                PT.37
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/oricon" class="nav-link {{ $title === 'ORICON' ? "active" : '' }}">
              <i class="nav-icon fas fa-boxes-stacked"></i>
              <p>
                ORICON
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/history" class="nav-link {{ $title === 'History' ? "active" : '' }}">
              <i class="nav-icon fas fa-clock-rotate-left"></i>
              <p>
                Histori
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->type === 'ppc')
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>