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