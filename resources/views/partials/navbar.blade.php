<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto mr-4">
      <li class="nav-item d-none d-sm-inline-block">
        <form action="/logout" method="post">
          @csrf
          <button class="nav-link"><i class="fas fa-right-from-bracket"></i></button>
        </form>
        
      </li>
    </ul>
  </nav>