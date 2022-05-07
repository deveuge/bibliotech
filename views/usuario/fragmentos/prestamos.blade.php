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
                <tr class="{{ $prestamo->getColorFila() }}">
                    <th scope="row">{{ $prestamo->getLibro()->getIsbn() }}</th>
                    <td>{{ $prestamo->getLibro()->getNombre() }}</td>
                    <td>{{ $prestamo->getLibro()->getAutor() }}</td>
                    <td>{{ $prestamo->getFechaAsignadaDevolucion() }}</td>
                    <td>{{ $prestamo->getEstado() }}</td>
                    <td>
                        @if($_SESSION['usuario']->esModerador() && $prestamo->getDevuelto() != 1)
                        <span class="d-inline-block" data-bs-toggle="tooltip" title="Realizar devolución">
                            <a href="#" data-target-isbn="{{ $prestamo->getLibro()->getIsbn() }}" data-target-book="{{ $prestamo->getLibro()->getNombre() }}" data-target-author="{{ $prestamo->getLibro()->getAutor() }}" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#devolucionModal"><i class="fas fa-undo"></i></a>
                        </span>
                        @endif
                        <a href="libro.php?id={{ $prestamo->getLibro()->getIsbn() }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalle"><i class="fas fa-fw fa-info"></i></a>
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