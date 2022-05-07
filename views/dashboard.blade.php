<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Inicio", 'estilo' => 'dashboard.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
		<!-- CATÁLOGO -->
		<div class="row justify-content-center">
			<div class="col-12 card p-4 border-0 my-4">
				<div class="row titulo mb-3">
					<span>
						<h3>Catálogo</h3>
						<h5 class="mb-2 mb-sm-0">Bibliotech tiene {{ $librosTotal }} libros en su biblioteca</h5>
					</span>
					<form class="d-flex input-group search-form" action="catalogo.php" method="POST">
						<input class="form-control" type="search" name="search" placeholder="Buscar libro por título, autor o ISBN..."
							aria-label="Search">
						<button class="btn bg-white" type="submit"><span class="fa fa-search"></span></button>
					</form>
				</div>
				<!-- Categorías -->
				<div class="row row-cols-2 row-cols-md-5 g-4" id="categorias">
					@foreach ($categorias as $categoria)
					<div class="col">
						<a href="catalogo.php?cat={{ $categoria->getId() }}" class="card">
							<img src="{{ $categoria->getImagen() }}" alt="{{ $categoria->getNombre() }}">
							<h5>{{ $categoria->getNombre() }}</h5>
						</a>
					</div>
					@endforeach
				</div>
				<!-- Ver catálogo completo -->
				<div class="row">
					<div class="col text-end mt-3">
						<a href="catalogo.php" class="btn btn-outline-primary btn-sm ver-mas rounded-pill">Ver catálogo
							completo</a>
					</div>
				</div>
			</div>
		</div>

		<!-- ÚLTIMOS LIBROS -->
		<div class="row justify-content-center">
			<div class="col-12 card p-4 border-0 my-4">
				<div class="row titulo mb-3">
					<h3 class="mb-2 mb-sm-0">Últimos libros añadidos</h3>
					<h5>Estos son los últimos libros agregados a la biblioteca</h5>
				</div>
				<!-- Carrusel -->
				<div class="row" id="ultimos-libros">
					<div class="col-12">
						<div class="glider-contain">
							<div class="glider">
								@foreach ($ultimosLibros as $libro)
								<a href="libro.php?id={{ $libro->getIsbn() }}" class="card">
									<img src="https://covers.openlibrary.org/b/isbn/{{ $libro->getIsbn() }}-L.jpg"
										class="card-img-top">
									<p>
										<strong>{{ $libro->getNombre() }}</strong>
										<span>{{ $libro->getAutor() }}</span>
									</p>
								</a>
								@endforeach
							</div>

							<button aria-label="Previous" class="glider-prev"><span
									class="fas fa-angle-left"></span></button>
							<button aria-label="Next" class="glider-next"><span
									class="fas fa-angle-right"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ACTUALMENTE LEYENDO -->
		<div class="row justify-content-center">
			<div class="col-12 card p-4 border-0 my-4">
				<div class="row titulo mb-3">
					<h3 class="mb-2 mb-sm-0">Actualmente leyendo</h3>
					<h5>Estos son los libros que tiene en préstamo</h5>
				</div>
				<!-- Libros actuales -->
				@if (sizeOf($prestamos) > 0)
				<div class="row row-cols-1 row-cols-md-2 g-4" id="libros-actuales">
					@foreach ($prestamos as $prestamo)
					<div class="col">
						<div class="card h-100">
							<div class="row h-100 g-0">
								<div class="col-sm-4">
									<img src="https://covers.openlibrary.org/b/isbn/{{ $prestamo->getLibro()->getIsbn() }}-L.jpg"
										class="img-fluid">
								</div>
								<div class="col-sm-8">
									<div class="card-body">
										<div>
											<h4 class="card-title">{{ $prestamo->getLibro()->getNombre() }}</h4>
											<h5>{{ $prestamo->getLibro()->getAutor() }}</h5>
										</div>
										<p class="card-text">{{ $prestamo->getLibro()->getDescripcion() }}</p>
										<p class="card-text"><small class="text-muted">Fecha de devolución: {{ $prestamo->getFechaAsignadaDevolucion() }}</small></p>
									</div>
								</div>
							</div>
							<a href="libro.php?id={{ $prestamo->getLibro()->getIsbn() }}" class="stretched-link"></a>
						</div>
					</div>
					@endforeach
				</div>
				<!-- Ver todos -->
				<div class="row">
					<div class="col text-end mt-3">
						<a href="perfil.php" class="btn btn-outline-primary btn-sm ver-mas rounded-pill">Ver todos</a>
					</div>
				</div>
				@else
				<p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>
				@endif
			</div>

		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')
    <script src="js/dashboard.js"></script>
</body>
</html>