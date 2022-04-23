<div id="prestamos">
    @if (sizeOf($prestamos) > 0)
    <div class="table-responsive mb-3">
        <table class="table table-hover align-middle m-0">
            <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Fecha devolución</th>
                    <th scope="col">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                <tr class="{{ $prestamo->esFueraDePlazo() ? 'table-danger' : '' }}">
                    <th scope="row">{{ $prestamo->getLibro()->getIsbn() }}</th>
                    <td>{{ $prestamo->getLibro()->getNombre() }}</td>
                    <td>{{ $prestamo->getLibro()->getAutor() }}</td>
                    <td>{{ $prestamo->getFechaAsignadaDevolucion() }}</td>
                    <td>{{ $prestamo->getEstado() }}</td>
                    <td>
                        <a href="libro.php?id={{ $prestamo->getLibro()->getIsbn() }}" class="btn btn-outline-primary"><i class="fas fa-fw fa-info"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <nav class="d-flex justify-content-center">
        @include('plantillas.paginacion')
    </nav>
    @else
        <p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>
    @endif
</div>