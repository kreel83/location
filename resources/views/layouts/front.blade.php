<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locamarket</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

    <body>

      {{-- <div style="background:navy" class="p-2 w-100 text-white">

      </div> --}}

        {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary"> --}}
        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid">
              <a class="navbar-brand" href="#">LOCAMARKET</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li> --}}
                  <li class="nav-item me-2">
                    <a class="btn btn-primary" href="{{ route('login') }}">LOGIN</a>
                  </li>
                  <li class="nav-item">
                    <a class="btn btn-primary" href="{{ route('register') }}">CREER UN COMPTE</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                  </li>
                </ul>
                {{-- <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}

              </div>
            </div>
          </nav>

          <div class="container">
            @yield("content")
          </div>

    </body>
   
</html>