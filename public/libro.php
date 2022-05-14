<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';

    use Clases\Utils\Alert;
    use Clases\Categoria;
    use Clases\Filtros\FiltroPrestamo;
    use Clases\Libro;
    use Clases\Prestamo;
    use Clases\Utils\Paginacion;
    use Clases\Utils\Funciones;

    YsJQueryAutoloader::register();
    YsJQuery::usePlugin(YsJQueryConstant::PLUGIN_JQVALIDATE);

    $libro = new Libro();
    $categorias = Categoria::list();
    $alertMessage = null;

    // Crear, modificar o eliminar libro según la acción recibida por POST
    if(!empty($_POST) && isset($_POST['accion'])) {
        Funciones::comprobarAccesoModerador();
        
        switch($_POST['accion']) {
            // Nuevo libro
            case 'crear':
                $libro = getInformacionLibro();
                $url = "Location: libro.php?id=" . $libro->getIsbn();
                crearLibro();
                break;
            // Actualizar libro
            case 'modificar': 
                $libro = getInformacionLibro();
                $url = "Location: libro.php?id=" . $libro->getIsbn();
                actualizarLibro();
                break;
            // Eliminar libro
            case 'eliminar':
                Libro::eliminarLibro($_POST['isbn']);
                header("Location: catalogo.php?deleted=1");
                break;
        }
    }
    // Vista de creación de un nuevo libro
    elseif(isset($_GET["crear"])) {
        Funciones::comprobarAccesoModerador();
        echo $blade->view()->make('libro/editar', compact('libro', 'categorias'))->render();
    } 
    // Vista de detalle de un libro existente
    else {
        $libro = Libro::findLibro($_GET["id"]);
        Funciones::comprobarError404($libro);
        $esFavorito = Libro::esFavorito($_SESSION['usuario']->getUsername(), $libro->getIsbn());
        $alertMessage = Funciones::getAlertaSolicitudPrestamo();
        $alertMessage = Funciones::getAlertaDevolucionPrestamo();
        $alertMessage = Funciones::getAlertaLibro();

        if(isset($_GET["editar"])) {
            Funciones::comprobarAccesoModerador();
            echo $blade->view()->make('libro/editar' , compact('libro', 'categorias'))->render();
        } else {
            $filtro = new FiltroPrestamo(null, $libro->getIsbn(), 'assigned_return_date', 'ASC');
            $prestamos = Prestamo::list($filtro);
            $paginacion = new Paginacion(Prestamo::countList($filtro), $filtro->getPagina());
            echo $blade->view()->make('libro/ver' , compact('libro', 'esFavorito', 'categorias', 'prestamos', 'paginacion', 'alertMessage'))->render();
        }
    }
    
    // Construcción de un objeto Libro según los parámetros recibidos por POST
    function getInformacionLibro() {
        return new Libro (
            $_POST['isbn'],
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['cantidad'],
            new Categoria($_POST['categoria'], NULL, NULL),
            $_POST['paginas'],
            $_POST['fecha'],
            0
        );
    }

    // Guardar un nuevo libro en BD y redirigir a la vista de su detalle
    function crearLibro() {
        global $blade, $url, $libro, $categorias, $alertMessage;
        comprobarDatos();
        if($alertMessage) {
            $_GET['crear'] = true;
            echo $blade->view()->make('libro/editar', compact('libro', 'categorias', 'alertMessage'))->render();
            exit();
        }
        if(Libro::findLibro($libro->getIsbn())) {
            $alertMessage = new Alert("Ya existe un libro registrado con el ISBN " . $libro->getIsbn(), "danger");
            $_GET['crear'] = true;
            echo $blade->view()->make('libro/editar', compact('libro', 'categorias', 'alertMessage'))->render();
        } else {
            Libro::insertarLibro($libro);
            header($url . "&created=1");
        }
    }

    // Actualizar el libro en BD y redirigir a la vista de su detalle
    function actualizarLibro() {
        global $blade, $url, $libro, $categorias, $alertMessage;
        comprobarDatos();
        if($alertMessage) {
            $_GET['editar'] = true;
            echo $blade->view()->make('libro/editar', compact('libro', 'categorias', 'alertMessage'))->render();
            exit();
        }
        Libro::updateLibro($libro);
        header($url . "&updated=1");
    }

    // Revisión de campos obligatorios y de formato específico
    function comprobarDatos() {
        global $alertMessage;
        if(empty($_POST['isbn']) || empty($_POST['titulo']) || empty($_POST['autor']) || empty($_POST['categoria'] )|| empty($_POST['paginas'])) {
            $alertMessage = new Alert("Por favor, rellene todos los campos obligatorios", "danger");
            return;
        }
        if(strlen($_POST['isbn']) < 10 || strlen($_POST['isbn']) > 13) {
            $alertMessage = new Alert("El ISBN debe tener entre 10 y 13 caracteres", "danger");
            return;
        }
        if($_POST['paginas'] < 0 || $_POST['precio'] < 0 || $_POST['cantidad'] < 0) {
            $alertMessage = new Alert("No se admiten cantidades negativas", "danger");
            return;
        }
    }

?>