<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container-fluid">
        <a href="index.php" id="logo" class="navbar-brand dark">
            <img src="img/logo.svg" />
            <span>biblio<strong>tech</strong></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-auto">
                <form class="d-flex input-group search-form" action="catalogo.php" method="POST">
                    <input class="form-control" type="search" name="search" placeholder="Buscar un libro..." aria-label="Search">
                    <button class="btn" type="submit"><span class="fa fa-search"></span></button>
                </form>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div id="navbar-avatar" class="d-none d-lg-inline-block"><img src="{{ $_SESSION['usuario']->getImagen() }}" /></div>
                        <span class="d-lg-none">{{ $_SESSION['usuario']->getUsername() }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-lg-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="perfil.php"><span class="far fa-id-card"></span> Perfil</a></li>
                        <li><a class="dropdown-item" href="perfil.php?editar"><span class="fas fa-cog"></span> Configuración</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="logout.php" method="POST">
                                <button class="dropdown-item" type="submit">
                                    <span class="fas fa-power-off"></span> Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>