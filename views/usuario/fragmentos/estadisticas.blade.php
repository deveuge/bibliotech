<div class="tab-pane fade" id="estadisticas" role="tabpanel" aria-labelledby="estadisticas-tab">
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <h5 class="titulo"><span>Categorías favoritas</span></h5>
            <canvas id="chart-categorias"></canvas>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <h5 class="titulo"><span>Libros leídos</span></h5>
            <canvas id="chart-leidos"></canvas>
        </div>
    </div>

    <h5 class="titulo"><span>Visión general</span></h5>
    <div class="row">
        <div class="col-6 col-md-3 mb-4">
            <div class="card-counter bg-primary text-light">
                <i class="fas fa-book"></i>
                <span class="count-numbers">{{ $estadisticas->getLibros() }}</span>
                <span class="count-name">Libros leídos</span>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <div class="card-counter bg-primary text-light">
                <i class="fas fa-feather"></i>
                <span class="count-numbers">{{ $estadisticas->getAutores() }}</span>
                <span class="count-name">Autores leídos</span>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <div class="card-counter bg-primary text-light">
                <i class="fas fa-star"></i>
                <span class="count-numbers" id="contador-favoritos">{{ $estadisticas->getFavoritos() }}</span>
                <span class="count-name">Libros en favoritos</span>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <div class="card-counter bg-primary text-light">
                <i class="fas fa-bookmark"></i>
                <span class="count-numbers">{{ $estadisticas->getPrestamos() }}</span>
                <span class="count-name">Libros en préstamo</span>
            </div>
        </div>
    </div>
</div>