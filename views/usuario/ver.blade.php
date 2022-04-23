<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Perfil", 'estilo' => 'perfil.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">

		<!-- PERFIL -->
		<div class="row justify-content-center">
			<div class="col-12 card p-4 border-0 my-4">
				<div class="col titulo text-center">
					<span class="w-100" id="perfil-info">
						<div id="perfil-avatar"><img src="{{ $usuario->getImagen() }}" /></div>
						<h3>{{ $usuario->getNombre() }}</h3>
						<h5>{{ $usuario->getRolname() }}</h5>
					</span>
				</div>

				<!-- Pestañas -->
				<ul class="nav nav-tabs d-flex justify-content-center mb-4" id="tabs" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="libros-tab" data-bs-toggle="tab" data-bs-target="#libros"
							type="button" role="tab" aria-controls="libros" aria-selected="true">Tus libros</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="favoritos-tab" data-bs-toggle="tab" data-bs-target="#favoritos"
							type="button" role="tab" aria-controls="favoritos" aria-selected="false">Favoritos</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="estadisticas-tab" data-bs-toggle="tab"
							data-bs-target="#estadisticas" type="button" role="tab" aria-controls="estadisticas"
							aria-selected="false">Estadísticas</button>
					</li>
				</ul>
				<div class="tab-content" id="tabs-content">
					<!-- Libros -->
					<div class="tab-pane fade show active" id="libros" role="tabpanel" aria-labelledby="libros-tab">
						<!-- Libros en préstamo -->
						<h5 class="titulo"><span>Libros en préstamo</span></h5>
						@include('usuario.fragmentos.prestamos')

						<!-- Multas -->
						<h5 class="titulo"><span>Sanciones recibidas</span></h5>
						
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-danger btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#multaModal">
								<i class="fas fa-file-signature"></i> Emitir multa
							</button>
						</div>

						<div class="table-responsive mb-3">
							<table class="table table-hover align-middle m-0">
								<thead>
									<tr>
										<th scope="col">ISBN</th>
										<th scope="col">Título</th>
										<th scope="col">Autor</th>
										<th scope="col">Fecha</th>
										<th scope="col">Importe</th>
										<th scope="col">Estado</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">8478885196</th>
										<td>Harry Potter y el Prisionero de Azkaban</td>
										<td>J. K. Rowling</td>
										<td>15/01/2022</td>
										<td>10.40</td>
										<td>Pagada</td>
										<td>
											<a href="#" class="btn btn-outline-primary"><i class="fas fa-fw fa-info"></i></a>
										</td>
									</tr>
									<tr>
										<th scope="row">8478885196</th>
										<td>Harry Potter y el Prisionero de Azkaban</td>
										<td>J. K. Rowling</td>
										<td>15/01/2022</td>
										<td>10.40</td>
										<td>Pagada</td>
										<td>
											<a href="#" class="btn btn-outline-primary"><i class="fas fa-fw fa-info"></i></a>
										</td>
									</tr>
									<tr class="table-danger">
										<th scope="row">8478885196</th>
										<td>Harry Potter y el Prisionero de Azkaban</td>
										<td>J. K. Rowling</td>
										<td>15/01/2022</td>
										<td>10.40</td>
										<td>Pendiente</td>
										<td>
											<a href="#" class="btn btn-outline-primary"><i class="fas fa-fw fa-info"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<nav class="d-flex justify-content-center">
							<ul class="pagination mx-auto mb-0">
								<li class="page-item disabled">
									<a class="page-link"><i class="fas fa-angle-left"></i></a>
								</li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item active" aria-current="page">
									<a class="page-link" href="#">2</a>
								</li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
									<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
								</li>
							</ul>
						</nav>
					</div>

					<!-- Favoritos -->
					<div class="tab-pane fade" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
						<h5 class="titulo"><span>Libros favoritos</span></h5>
						<div class="row row-cols-1 row-cols-md-2 g-4">
							<div class="col">
								<div class="card p-0">
									<div class="row g-0">
										<div class="col-sm-4">
											<img src="https://covers.openlibrary.org/b/isbn/9780805094596-L.jpg"
												class="img-fluid">
										</div>
										<div class="col-sm-8">
											<div class="card-body">
												<div>
													<h4 class="card-title">Sombra y hueso</h4>
													<h5 class="titulo"><span>Fantasía</span></h5>
												</div>
												<p class="card-text">This is a wider card with supporting text below as a
													natural
													lead-in to additional content. This content is a little bit longer.</p>
												<button type="button" class="btn btn-sm btn-outline-danger">Eliminar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card p-0">
									<div class="row g-0">
										<div class="col-sm-4">
											<img src="https://covers.openlibrary.org/b/isbn/9780805094596-L.jpg"
												class="img-fluid">
										</div>
										<div class="col-sm-8">
											<div class="card-body">
												<div>
													<h4 class="card-title">Sombra y hueso</h4>
													<h5 class="titulo"><span>Fantasía</span></h5>
												</div>
												<p class="card-text">This is a wider card with supporting text below as a
													natural
													lead-in to additional content. This content is a little bit longer.</p>
												<button type="button" class="btn btn-sm btn-outline-danger">Eliminar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<nav class="d-flex justify-content-center mt-3">
							<ul class="pagination">
								<li class="page-item disabled">
									<a class="page-link"><i class="fas fa-angle-left"></i></a>
								</li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item active" aria-current="page">
									<a class="page-link" href="#">2</a>
								</li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
									<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
								</li>
							</ul>
						</nav>
					</div>

					<!-- Estadísticas -->
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
									<span class="count-numbers">{{ $estadisticas->getFavoritos() }}</span>
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
				</div>
			</div>
		</div>

	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')
	<script>
		let categoriasFavoritasNombres = {!! json_encode($estadisticas->getCategoriasFavoritasNombres()) !!};
		let categoriasFavoritasValores = {!! json_encode($estadisticas->getCategoriasFavoritasValores()) !!};
		let librosLeidosNombres = {!! json_encode($estadisticas->getLibrosLeidosNombres()) !!};
		let librosLeidosValores = {!! json_encode($estadisticas->getLibrosLeidosValores()) !!};
	</script>
    <script src="js/perfil.js"></script>

</body>
</html>