<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Catálogo", 'estilo' => 'catalogo.css'])

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
					<div class="col d-flex justify-content-end">
						<a href="libro.php?crear" class="btn btn-outline-primary">Nuevo libro</a>
					</div>
				</div>

				<form action="catalogo.php" method="POST" class="row" id="filtros">
					<span class="d-flex input-group">
						<input class="form-control" type="search" id="texto" name="texto" placeholder="Buscar libro por título, autor o ISBN..." aria-label="Search" value="{{ $filtro->getTexto() }}">
						<button class="btn bg-primary text-light" type="submit"><span class="d-none d-md-inline-block">Buscar</span> <i class="fa fa-search"></i></button>
					</span>
					<div class="col-12 col-md-3">
						<label for="categoria" class="form-label">Categoría</label>
						<select class="form-select form-select-sm" id="categoria" name="categoria">
							<option value="" selected>Seleccionar categoría</option>
							@foreach ($categorias as $categoria)
							<option value="{{ $categoria->getId() }}">{{ $categoria->getNombre() }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-12 col-md-3">
						<label for="categoria" class="form-label">Ordenar por</label>
						<select class="form-select form-select-sm" id="orden" name="orden">
							<option value="" selected>Seleccionar orden</option>
							<option value="name">Título</option>
							<option value="author">Autor</option>
							<option value="isbn">ISBN</option>
						</select>
					</div>
					<div class="col-12 col-md-3">
						<label for="categoria" class="form-label">En sentido</label>
						<select class="form-select form-select-sm" id="direccion" name="direccion">
							<option value="" selected>Seleccionar sentido</option>
							<option value="ASC">Ascendente</option>
							<option value="DESC">Descendente</option>
						</select>
					</div>
					<div class="col-12 col-md-3">
						<div class="text-end mt-2 mt-md-0">
							<input type="checkbox" class="form-check-input m-1" id="solo-disponibles" name="solo-disponibles">
							<label class="form-check-label small text-muted px-1" for="solo-disponibles">Mostrar solo disponibles</label>
							<button type="reset" class="btn btn-sm py-0 btn-outline-primary">Limpiar todo</button>
						</div>
					</div>
				</form>

				<div class="row mt-4">
				@include('catalogo.resultados')
				</div>
			</div>
		</div>
	</div>

	@include('catalogo.modalSolicitud')
    @include('plantillas.footer')
    @include('plantillas.scripts')
	<script>
		$("#filtros").on("submit", function(e) {
			e.preventDefault();
			jaxon_filtrar(
				$("#texto").val(),
				$("#categoria").val(),
				$("#solo-disponibles").is(':checked'),
				$("#orden").val(),
				$("#direccion").val()
			);
		});

		$("body").on("click", ".page-link", function(e) {
			e.preventDefault();
			jaxon_paginar($(this).attr("data-page"));
		});

		$(document).ready(function () {
			$("#solicitudModal").on("show.bs.modal", function (e) {
				$('#solicitud-libro').text($(e.relatedTarget).data('target-libro'));
				$('#solicitud-autor').text($(e.relatedTarget).data('target-autor'));
				$('#solicitud-isbn').val($(e.relatedTarget).data('target-isbn'));
			});
		});

		$('button[type="reset"]').on('click', function() {
			$("#texto").attr("value", "");
		});
	</script>
</body>
</html>