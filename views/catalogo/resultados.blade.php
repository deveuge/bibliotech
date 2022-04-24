<div id="resultados">
    <!-- Resultados -->
    <div class="col-12">
        <small class="text-muted">Se han encontrado {{ $paginacion->getTotalRegistros() }} resultados coincidentes</small>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Disp.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultados as $libro)
                    <tr>
                        <td>{{ $libro->getNombre() }}</td>
                        <td>{{ $libro->getAutor() }}</td>
                        <td>{{ $libro->getCategoria()->getNombre() }}</td>
                        <td>{{ $libro->getDisponibles() }}</td>
                        <td>
                            <a href="libro.php?id={{ $libro->getIsbn() }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Ver detalle"><i class="fas fa-fw fa-info"></i></a>
                            @if ($libro->getDisponibles() > 0)
                            <span data-bs-toggle="tooltip" title="Solicitar libro">
                                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#solicitudModal" data-target-isbn="{{ $libro->getIsbn() }}" data-target-libro="{{ $libro->getNombre() }}" data-target-autor="{{ $libro->getAutor() }}"><i class="fas fa-fw fa-book"></i></button>
                            </span>
                            @else
                            <span data-bs-toggle="tooltip" title="Solicitud no disponible">
                                <button class="btn btn-outline-dark disabled"><i class="fas fa-fw fa-book"></i></button>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div class="col-12 d-flex justify-content-center">
        @include('plantillas.paginacion')
    </div>
</div>