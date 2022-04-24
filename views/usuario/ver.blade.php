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

					<div class="tab-pane fade" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
						<h5 class="titulo"><span>Libros favoritos</span></h5>
						@if (sizeOf($favoritos) > 0)
						<div class="row row-cols-1 row-cols-md-2 g-4" id="favoritos-resultados">
							@include('usuario.fragmentos.favoritos')
						</div>
						<div class="d-grid">
							@if($existenMasFavoritos)
							<button class="btn btn-primary text-light mt-3" id="cargar-mas" data-page="2" type="button">Cargar más</button>
							@endif
						</div>
						@else
							<p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>
						@endif
					</div>

					@include('usuario.fragmentos.estadisticas')
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
		let username = {!! json_encode($usuario->getUsername()) !!};
	</script>
    <script src="js/perfil.js"></script>

</body>
</html>