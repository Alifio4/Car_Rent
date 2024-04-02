<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('mobil') }}">Daftar Mobil</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('mobil/form') }}">Peminjaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('mobil/pengembalian') }}">Pengembalian</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li> --}}
          </ul>
          <ul class="navbar-nav d-flex" >
            @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{-- {{ Auth::user()->name }} --}}
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Setting</a></li>
                  <li><hr class="dropdown-divider"></li>
                  {{-- <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li> --}}
                </ul>
              </li>
            @endauth
            @guest
            <li class="nav-item">
              {{-- <a class="nav-link" href="{{ route('login') }}">Login</a> --}}
            </li>
            @endguest
            </ul>
        </div>
      </div>
    </nav>
  </head>
  <body>
    <div class="container"> @yield('content') </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>