<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 text-center" href="/" target="_blank">
      <img src="{{ asset('img/yazaki-text.png') }}" width="125px" class="navbar-brand-img h-100" alt="main_logo">
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ $title === 'Dashboard' ? "active" : '' }}" href="/">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      @if(Auth::user()->type === 'l/d')
      <li class="nav-item">
        <a class="nav-link {{ $title === 'List Data' ? "active" : '' }}" href="/e-container-content/history">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-list text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data List</span>
        </a>
      </li>
      @elseif(Auth::user()->type === 'ppc')
      <li class="nav-item">
        <a class="nav-link {{ $title === 'Request' ? "active" : '' }}" href="/e-container-content/request-ppc">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-code-pull-request text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Request</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $title === 'History' ? "active" : '' }}" href="/e-container-content/history-ppc">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-clock text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">History</span>
        </a>
      </li>
      @elseif(Auth::user()->type === 'admin')
      <li class="nav-item">
        <a class="nav-link {{ $title === 'Request' ? "active" : '' }}" href="/e-container-content/request-admin">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-code-pull-request text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Request</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $title === 'History' ? "active" : '' }}" href="/e-container-content/history-admin">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-clock text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">History</span>
        </a>
      </li>
      @elseif(Auth::user()->type === 'super_admin')
      <li class="nav-item">
        <a class="nav-link {{ $title === 'List User' ? "active" : '' }}" href="/e-container-content/users">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">List User</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</aside>
