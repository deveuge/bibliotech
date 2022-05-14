<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';
    require_once '../src/Utils/Jaxon.php';

    use Clases\Libro;
    use Clases\Categoria;
    use Clases\Filtros\FiltroLibro;
    use Clases\Utils\Paginacion;
    use Clases\Utils\Funciones;

    use Jaxon\Jaxon;
    use Jaxon\Response\Response;

    $filtro = new FiltroLibro(1);
    // Si viene de la barra de búsqueda
    if(isset($_POST['search'])) {
        $filtro->setTexto($_POST['search']);
    }
    // Si viene de una categoría concreta
    if(isset($_GET['cat'])) {
        $filtro->setCategoria($_GET['cat']);
    }
    $paginacion = new Paginacion(Libro::countList($filtro), 1);

    // Si viene de reservar un libro directamente desde el catálogo, se recupera la última búsqueda
    if(isset($_GET['booked']) && isset($_SESSION['filtro_catalogo'])) {
        $filtro = unserialize($_SESSION['filtro_catalogo']);
        $paginacion = new Paginacion(Libro::countList($filtro), $filtro->getPagina());
    }
    $resultados = Libro::list($filtro);
    
    // Filtrado de libros según la búsqueda del usuario
    function filtrar($texto, $categoria, $soloDisponibles, $ordenColumna, $ordenDireccion) {
        $filtro = new FiltroLibro($texto, $categoria, $soloDisponibles, $ordenColumna, $ordenDireccion, 1);
        return getFiltrado($filtro);
    }

    // Paginación de libros según la última búsqueda del usuario
    function paginar($pagina) {
        $filtro = isset($_SESSION['filtro_catalogo'])
            ? unserialize($_SESSION['filtro_catalogo'])
            : new FiltroLibro(1);
        $filtro->setPagina($pagina);
        $_SESSION['filtro_catalogo'] = serialize($filtro);
        return getFiltrado($filtro);
    }

    // Construcción del filtro
    function getFiltrado($filtro) {
        global $blade;
        $response = new Response();
        $resultados = Libro::list($filtro);
        $paginacion = new Paginacion(Libro::countList($filtro), $filtro->getPagina());
        $_SESSION['filtro_catalogo'] = serialize($filtro);
        $viewRendered = $blade->view()->make('catalogo/resultados', compact('resultados', 'paginacion'))->render();
        $response->assign('resultados', 'innerHTML', $viewRendered);
        return $response;
    }

    // Registro de funciones a llamar por Jaxon
    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "filtrar");
    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "paginar");
    if($jaxon->canProcessRequest()){
        $jaxon->processRequest();
    }

    // Guardado de la búsqueda en sesión y paso de variables a la vista
    $_SESSION['filtro_catalogo'] = serialize($filtro);
    $librosTotal = Libro::countAll();
    $categorias = Categoria::list();
    $alertMessage = Funciones::getAlertaLibro();
    $alertMessage = Funciones::getAlertaSolicitudPrestamo();
    echo $blade->view()->make('catalogo/lista', compact('librosTotal', 'categorias', 'resultados', 'paginacion', 'filtro', 'alertMessage', 'jaxon'))->render();
?>