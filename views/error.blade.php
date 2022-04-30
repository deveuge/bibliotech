<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Error"])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
			<div class="col-12 card p-4 border-0 my-4">
				<img id="img-error" src="img/errors/{{ $code }}.svg" />
				<div class="row m-0 titulo card card-header text-muted text-center rounded">
					<h3 class="mb-2 mb-sm-0">Error {{ $code }}</h3>
					<h5>{{ $msg }}</h5>
				</div>
			</div>

		</div>
	</div>

    @include('plantillas.footer')
    @include('plantillas.scripts')
</body>
</html>