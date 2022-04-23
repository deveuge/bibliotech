<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Libro", 'estilo' => 'libro.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
		<div class="row justify-content-center">
			<!-- Información básica -->
			<div class="col-12 card p-4 border-0 my-4">
				<div class="row" id="libro-info">
					<div class="col-12 col-lg-4">
						<img src="https://covers.openlibrary.org/b/isbn/{{ $libro->getIsbn() }}-L.jpg" class="img-fluid">
						@if ($libro->getDisponibles() > 0)
							<button class="btn btn-primary my-3 mb-lg-0 px-5 text-light" data-bs-toggle="modal" data-bs-target="#solicitudModal">Solicitar libro</button>
						@else
							<span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Solicitud no disponible">
								<button class="btn btn-dark my-3 mb-lg-0 px-5 text-light disabled">Solicitar libro</button>
							</span>
						@endif
					</div>
					<div class="col-12 col-lg-8">
						<div class="mt-2 mt-lg-0 text-center text-lg-start">
							<h3>{{ $libro->getNombre() }}</h3>
							<h5 class="titulo clear">{{ $libro->getAutor() }}</h5>
						</div>
						<ul class="list-group list-group-flush mt-3 p-0">
							<li class="list-group-item">
								<strong>Categoría</strong> {{ $libro->getCategoria()->getNombre() }}
							</li>
							<li class="list-group-item">
								<strong class="fw-bold">Número de páginas</strong> {{ $libro->getPaginas() }}
							</li>
							<li class="list-group-item">
								<strong class="fw-bold">Precio</strong> {{ $libro->getPrecio() }}€
							</li>
							<li class="list-group-item">
								<strong>Fecha de publicación</strong> {{ $libro->getFechaPublicacion() }}
							</li>
						</ul>
						<div class="row mx-0 mt-3" id="libro-detalles">
							<div class="col">
								<span class="fas fa-barcode"></span>
								<h6>ISBN</h6>
								<strong>{{ $libro->getIsbn() }}</strong>
							</div>
							<div class="col">
								<span class="fas fa-box"></span>
								<h6>Total</h6>
								<strong>{{ $libro->getCantidad() }}</strong>
							</div>
							<div class="col">
								<span class="fas fa-box-open"></span>
								<h6>Disponibles</h6>
								<strong>{{ $libro->getDisponibles() }}</strong>
							</div>
						</div>
					</div>
					<div class="col-12 mt-3 mt-lg-0 offset-lg-4 col-lg-8">
						<blockquote>{{ $libro->getDescripcion() }}</blockquote>
					</div>
				</div>
			</div>

			<!-- Préstamos actuales -->
			<div class="col-12 card p-4 border-0 my-4">
				<h5 class="titulo mb-2"><span>Préstamos actuales</span></h5>
				@include('libro.fragmentos.prestamos')
			</div>

			<!-- Herramientas administración -->
			<div class="col-12 card p-4 border-0 my-4">
				<h5 class="titulo mb-2"><span>Herramientas de administración</span></h5>
				<div class="d-flex justify-content-end">
					<a href="?eliminar" class="btn btn-outline-danger mx-2">Eliminar libro</a>
					<a href="?id={{$libro->getIsbn()}}&editar" class="btn btn-primary text-light">Editar libro</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal solicitud -->
	<div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close ms-auto m-3 mb-0" data-bs-dismiss="modal"
					aria-label="Cerrar"></button>
				<div class="modal-body text-center">
					¿Desea solicitar el libro "{{ $libro->getNombre() }}" de {{ $libro->getAutor() }}?
					<div class="alert alert-primary d-inline-block p-2 lh-1 mt-2 mb-0" role="alert">
						<span class="fas fa-info-circle fa-lg me-2"></span>
						<small>Deberá devolverlo antes del: <span class="badge bg-secondary ms-1">{{ Clases\Utils\Funciones::getFechaDevolucion()->format('d/m/Y') }}</span></small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
					<form action="prestamo.php" method="POST">
						<input type="hidden" id="isbn" name="isbn" value="{{$libro->getIsbn()}}"/>
						<button type="submit" class="btn btn-primary text-light">Solicitar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal devolución -->
	<div class="modal fade" id="devolucionModal" tabindex="-1" aria-labelledby="devolucionModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close ms-auto m-3 mb-0" data-bs-dismiss="modal"
					aria-label="Cerrar"></button>
				<div class="modal-body text-center">
					¿Confirmar la devolución del libro ${BOOK} para el usuario ${USERNAME}?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary text-light">Confirmar</button>
				</div>
			</div>
		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')

</body>
</html>