<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Acerca de"])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
			<div class="col-12 card p-4 border-0 my-4">
				<div class="row titulo mb-3">
					<h3 class="mb-2 mb-sm-0">Acerca de</h3>
					<h5>Proyecto Bibliotech</h5>
				</div>
				<div class="accordion" id="acordeon">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Descripción de la aplicación
						</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#acordeon">
						<div class="accordion-body">
							<p>Bibliotech es un proyecto final del ciclo formativo Desarrollo de Aplicaciones Web.</p>
							<p>Su propósito es la gestión de una biblioteca en el ámbito educativo 
							para ser usado por diferentes centros escolares o universitarios de forma que se 
							facilite la concesión y gestión de préstamos de los libros disponibles.</p>
						</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Dependencias utilizadas
						</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acordeon">
						<div class="accordion-body">
							<ul>
								<li><a target="_blank" href="https://laravel.com/docs/9.x/blade">Blade</a> - Sistema de plantillas de Laravel que permite generar HTML dinámico.</li>
								<li><a target="_blank" href="https://getbootstrap.com/docs/5.0/getting-started/introduction/">Bootstrap 5</a> - Framework CSS utilizado para desarrollar aplicaciones web y sitios mobile first.</li>
								<li><a target="_blank" href="https://www.chartjs.org">Chart.js</a> - Librería que proporciona gráficas de JavaScript simples pero flexibles para diseñadores y desarrolladores.</li>
								<li><a target="_blank" href="https://getcomposer.org">Composer</a> - Administrador de dependencias de PHP.</li>
								<li><a target="_blank" href="https://fontawesome.com">FontAwesome</a> - Framework de iconos vectoriales y estilos CSS.</li>
								<li><a target="_blank" href="https://nickpiscitelli.github.io/Glider.js/">GliderJS</a> - Librería que proporciona un carusel ligero, responsivo, customizable, libre de dependencias y con scroll nativo del navegador.</li>
								<li><a target="_blank" href="https://www.jaxon-php.org">Jaxon</a> - Librería PHP para crear aplicaciones web Ajax.</li>
								<li><a target="_blank" href="https://jquery.com">jQuery</a> - Librería JavaScript rápida, pequeña y rica en funciones</li>
								<li><a target="_blank" href="https://packagist.org/packages/yepsua/jquery4php">JQuery4PHP</a> - Interface de programación en PHP que aprovecha las capacidades de jQuery.</li>
								<li><a target="_blank" href="http://jquery4php.sourceforge.net/index.php?section=plugins&module=jqValidate&method=about">JqValidate</a> - Plugin JQuery para la validación de formularios en el lado cliente.</li>
								<li><a target="_blank" href="https://openlibrary.org/dev/docs/api/covers">Open Library Covers API</a> - API que permite acceder a las portadas de los libros disponibles en el repositorio de Open Library.</li>
							</ul>
						</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							Recursos utilizados
						</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#acordeon">
						<div class="accordion-body">
							<ul>
								<li><a target="_blank" href="https://iconos8.es/icons/cotton">Icons8</a> - Iconos de categorías</li>
								<li><a target="_blank" href="https://www.flaticon.es/autores/victoruler">Victoruler</a> - Avatares de usuario</li>
								<li><a target="_blank" href="https://storyset.com/pana">Storyset</a> - Imágenes de errores HTTP</li>
							</ul>
						</div>
						</div>
					</div>
					</div>
			</div>

		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')
</body>
</html>