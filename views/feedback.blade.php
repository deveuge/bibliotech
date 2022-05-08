<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Contacto", 'estilo' => 'feedback.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
			<div class="col-12 col-lg-8 mx-auto card p-4 border-0 my-4">
				<div class="row titulo mb-3">
					<h3 class="mb-2 mb-sm-0">Contacto</h3>
					<h5>Formulario para comentarios, problemas o sugerencias</h5>
				</div>
				<form action="feedback.php" method="POST" id="form">
					<div class="mb-3">
						<label for="tipo" class="form-label">Tipo de mensaje</label>
						<select class="form-select" id="tipo" name="tipo" required>
							<option selected disabled>Seleccionar una opción</option>
							<option value="Comentario">Comentario</option>
							<option value="Problema">Problema</option>
							<option value="Sugerencia">Sugerencia</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="asunto" class="form-label">Asunto</label>
						<input type="text" class="form-control" id="asunto" name="asunto" required/>
					</div>
					<div class="mb-3">
						<label for="mensaje" class="form-label">Mensaje</label>
						<textarea class="form-control" id="mensaje" name="mensaje" rows="7" required></textarea>
					</div>
					<label class="form-label">Grado de satisfacción</label>
					<div class="mb-3 d-flex justify-content-around" id="satisfaccion-selector">
						<label>
							<input type="radio" name="satisfaccion" value="1">
							<span>&#128544;</span>
						</label>
						<label>
							<input type="radio" name="satisfaccion" value="2">
							<span>&#128577;</span>
						</label>
						<label>
							<input type="radio" name="satisfaccion" value="3">
							<span>&#128528;</span>
						</label>
						<label>
							<input type="radio" name="satisfaccion" value="4">
							<span>&#128578;</span>
						</label>
						<label>
							<input type="radio" name="satisfaccion" value="5">
							<span>&#128515;</span>
						</label>
					</div>
					<div class="d-grid">
						<button type="submit" id="submit" class="btn btn-primary text-light">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')
	<?php
		echo YsJQuery::newInstance()
				->onClick()
				->in("#submit")
				->execute(YsJQValidate::build()->in('#form'));
	?>
</body>
</html>