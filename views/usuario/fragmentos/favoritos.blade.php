@foreach ($favoritos as $favorito)
<div class="col favorito" id="fav-{{ $favorito->getIsbn() }}">
    <div class="card p-0">
        <div class="row g-0">
            <div class="col-sm-4">
                <img src="https://covers.openlibrary.org/b/isbn/{{ $favorito->getIsbn() }}-L.jpg"
                    class="img-fluid">
            </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <div>
                        <h4 class="card-title">{{ $favorito->getNombre() }}</h4>
                        <h5 class="titulo"><span>{{ $favorito->getAutor() }}</span></h5>
                    </div>
                    <p class="card-text">{{ $favorito->getDescripcion() }}</p>
                    <div class="gap-1 d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-outline-danger eliminar-favorito" data-isbn="{{ $favorito->getIsbn() }}" data-bs-toggle="tooltip" title="Eliminar favorito"><span class="fas fa-times fa-fw"></span></button>
                        <a href="libro.php?id={{ $favorito->getIsbn() }}" class="btn btn-sm btn-primary text-light" data-bs-toggle="tooltip" title="Ver detalle"><span class="fas fa-info fa-fw"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach