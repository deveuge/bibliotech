<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Libro", 'estilo' => 'libro.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
		<div class="row justify-content-center">
			<form action="libro.php" method="POST" id="form">
				<div class="col-12 card p-4 border-0 my-4">
					@isset($_GET["crear"])
					<div class="row titulo">
						<h3>Crear libro</h3>
						<h5 class="mb-2 mb-sm-0">Agregar un nuevo libro a la biblioteca</h5>
					</div>
					@endisset
					@isset($_GET["editar"])
					<div class="row titulo">
						<h3>Modificar libro</h3>
						<h5 class="mb-2 mb-sm-0">Editar la información de un libro de la biblioteca</h5>
					</div>
					@endisset
					<div class="col-12 card p-4 border-0 my-4">
						<div class="row" id="libro-info">
							<div class="col-12 col-lg-4">
								<img src="https://covers.openlibrary.org/b/isbn/{{ $libro->getIsbn() }}-L.jpg" id="portada" class="img-fluid">
								
								<div class="input-group my-3 mb-lg-0 px-md-3">
									<span class="input-group-text col-2 col-md-3 justify-content-center">ISBN</span>
									<input type="text" class="form-control" id="isbn" name="isbn" minlength="10" maxlength="13" placeholder="ISBN-10 o ISBN-13" value="{{ $libro->getIsbn() }}" {{ isset($_GET["editar"]) ? 'disabled' : ''}} autofocus required>
								</div>
							</div>
							<div class="col-12 col-lg-8">
								<div class="mt-2 mt-lg-0 text-center text-lg-start">
									<div class="input-group input-group-lg mb-2">
										<span class="input-group-text col-2 justify-content-center">Título</span>
										<input type="text" class="form-control" id="titulo" name="titulo" maxlength="255" placeholder="Título del libro" value="{{ $libro->getNombre() }}" autofocus required>
									</div>
									<div class="input-group">
										<span class="input-group-text col-2 justify-content-center">Autor</span>
										<input type="text" class="form-control" id="autor" name="autor" maxlength="255" placeholder="Autor del libro" value="{{ $libro->getAutor() }}" required>
									</div>
									
								</div>
								<ul class="list-group list-group-flush p-0">
									<li class="list-group-item row">
										<label for="categoria" class="col-12 col-md-3 col-form-label fw-bold">Categoría</label>
										<div class="col-12 col-md-9">
											<select class="form-select" id="categoria" name="categoria" required>
												<option value="" selected disabled>Seleccionar categoría</option>
												@foreach ($categorias as $categoria)
												<option value="{{ $categoria->getId() }}" {{ $libro->getCategoria() && $libro->getCategoria()->getId() == $categoria->getId() ? 'selected' : ''}}>{{ $categoria->getNombre() }}</option>
												@endforeach
											</select>
										</div>
									</li>
									<li class="list-group-item row">
										<label for="paginas" class="col-12 col-md-9 col-form-label fw-bold">Número de páginas</label>
										<div class="col-12 col-md-3">
											<input type="number" class="form-control text-end" id="paginas" name="paginas" min="1" value="{{ $libro->getPaginas() }}" required>
										</div>
									</li>
									<li class="list-group-item row">
										<label for="precio" class="col-12 col-md-9 col-form-label fw-bold">Precio</label>
										<div class="col-12 col-md-3">
											<div class="input-group">
												<input type="number" class="form-control text-end" id="precio" name="precio" min="0" step="0.01" value="{{ $libro->getPrecio() }}">
												<span class="input-group-text">€</span>
											</div>
										</div>
									</li>
									<li class="list-group-item row">
										<label for="fecha" class="col-12 col-md-8 col-form-label fw-bold">Fecha de publicación</label>
										<div class="col-12 col-md-4">
											<input type="date" class="form-control" id="fecha" name="fecha" value="{{ $libro->getFechaPublicacionInput() }}" required>
										</div>
									</li>
									<li class="list-group-item row">
										<label for="cantidad" class="col-12 col-md-10 col-form-label fw-bold">Número de ejemplares total</label>
										<div class="col-12 col-md-2">
											<input type="number" class="form-control text-end" id="cantidad" name="cantidad" min="0" value="{{ $libro->getCantidad() }}" required>
										</div>
									</li>
								</ul>
							</div>
							<div class="col-12 mt-3 mt-lg-0 offset-lg-4 col-lg-8">
								<label for="descripcion" class="form-label d-none">Descripción</label>
  								<textarea class="form-control" id="descripcion" name="descripcion" placeholder="Breve descripción o sinopsis del libro" rows="6">{{ $libro->getDescripcion() }}</textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 card p-4 border-0 my-4">
					<div class="d-flex justify-content-between">
						@isset($_GET["editar"])
						<a href="libro.php?id={{ $libro->getIsbn() }}" class="btn btn-outline-primary">Volver</a>
						@endisset
						@isset($_GET["crear"])
						<a href="catalogo.php" class="btn btn-outline-primary">Volver</a>
						@endisset
						<div>
							<button type="submit" id="submit" class="btn btn-primary text-light">Guardar</a>
						</div>
					</div>
				</div>
				
				@isset($_GET["editar"])
				<input type="hidden" name="isbn" value="{{ $libro->getIsbn() }}"/> 
				@endisset

				<input type="hidden" name="accion" value="{{ isset($_GET["editar"]) ? 'modificar' : 'crear' }}"/>
			</form>
		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')

	<script>
		$("#isbn").on("change", function() {
			$("#portada").attr("src","https://covers.openlibrary.org/b/isbn/" + this.value + "-L.jpg");
		});
	</script>

	<?php
		echo YsJQuery::newInstance()
				->onClick()
				->in("#submit")
				->execute(YsJQValidate::build()->in('#form'));
	?>
</body>
</html>