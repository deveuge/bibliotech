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
                        <td>// TODO:</td>
                        <td>
                            <a href="libro.php?id={{ $libro->getIsbn() }}" class="btn btn-outline-primary"><i class="fas fa-fw fa-info"></i></a>
                            <a href="#" class="btn btn-outline-success"><i class="fas fa-fw fa-book"></i></a>
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