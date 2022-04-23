<nav>
    <ul class="pagination">
        <li class="page-item {{ $paginacion->isFirst() ? "disabled" : ""}}">
            <a class="page-link" href="javascript:void(0)" data-page="1"><i class="fas fa-angle-left"></i></a>
        </li>
        @foreach ($paginacion->getPaginas() as $pagina)
        <li class="page-item {{$pagina == $paginacion->getActual() ? "active" : ""}}">
            <a class="page-link" href="javascript:void(0)" data-page="{{$pagina}}">{{$pagina}}</a>
        </li>
        @endforeach
        <li class="page-item {{ $paginacion->isLast() ? "disabled" : ""}}">
            <a class="page-link" href="javascript:void(0)" data-page="{{$paginacion->getTotalPaginas()}}"><i class="fas fa-angle-right"></i></a>
        </li>
    </ul>
</nav>