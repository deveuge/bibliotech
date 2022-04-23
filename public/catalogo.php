<?php
    require_once '../vendor/autoload.php';
    require_once '../src/Utils/Blade.php';
    require_once '../src/Utils/Jaxon.php';

    use Clases\Libro;
    use Clases\Categoria;
    use Clases\Filtros\FiltroLibro;
    use Clases\Utils\Paginacion;

    use Jaxon\Jaxon;
    use Jaxon\Response\Response;

    $filtro = new FiltroLibro(1);
    $resultados = Libro::list($filtro);
    $paginacion = new Paginacion(Libro::countList($filtro), 1);

    function filtrar($texto, $categoria, $soloDisponibles, $ordenColumna, $ordenDireccion) {
        $filtro = new FiltroLibro($texto, $categoria, $soloDisponibles, $ordenColumna, $ordenDireccion, 1);
        return getFiltrado($filtro);
    }

    function paginar($pagina) {
        $filtro = isset($_SESSION['filtro_catalogo'])
            ? unserialize($_SESSION['filtro_catalogo'])
            : new FiltroLibro(1);
        $filtro->setPagina($pagina);
        return getFiltrado($filtro);
    }

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

    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "filtrar");
    $jaxon->register(Jaxon::CALLABLE_FUNCTION, "paginar");
    if($jaxon->canProcessRequest()){
        $jaxon->processRequest();
    }

    $_SESSION['filtro_catalogo'] = serialize($filtro);
    $librosTotal = Libro::countAll();
    $categorias = Categoria::list();
    echo $blade->view()->make('catalogo/lista', compact('librosTotal', 'categorias', 'resultados', 'paginacion', 'jaxon'))->render();
?>