<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gestion de Asistencia</title>
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="{{route('home')}}">ESFE</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
             <!-- Navbar-->

             <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if(auth()->check())
                        <li>
                            <a class="dropdown-item" href="{{ route('docentes.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('docentes.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        
                        @else
                            <li><a class="dropdown-item" href="{{ route('docentes.showLoginForm') }}">Iniciar sesión</a></li>
                            {{-- <li><a class="dropdown-item" href="{{route('estudiante.showLoginForm')}}">Iniciar sesión como estudiante</a></li> --}}
                        @endif
                    </ul>
                </li>
            </ul>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @if(auth()->check())
                                <div class="sb-sidenav-menu-heading">Menu</div>
                                <a class="nav-link" href="{{route('docentes.index')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Docentes
                                </a>
                                <a class="nav-link" href="{{route('grupos.index')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Grupos
                                </a>
                                <a class="nav-link" href="{{route('docente_grupos.index')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    Grupos Docente
                                </a>
                            @endif

                            <a class="nav-link" href="{{route('estudiantes.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Estudiantes
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuario</div>
                        Alvaroblez
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                    <script src="{{asset('js/scripts.js')}}"></script>
                </main>
        </div>
       
    </body>
</html>
