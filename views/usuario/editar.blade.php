<!DOCTYPE html>
<html lang="es">
@include('plantillas.header', ['titulo' => "Perfil", 'estilo' => 'perfil.css'])

<body>
    @include('plantillas.navbar')

    <div class="container-fluid contenedor-principal">
        <div class="row justify-content-center">
            <form action="perfil.php" method="POST" id="form">
                <div class="col-12 card p-4 border-0 my-4">
                    <div class="row titulo mb-3">
                        <h3>Configuración</h3>
                        <h5 class="mb-2 mb-sm-0">Editar información de la cuenta</h5>
                    </div>

                    <label>Imagen de perfil</label>
                    <div class="card card-header p-3 mb-3 d-flex justify-content-center text-center">
                        <div id="perfil-avatar-selector">
                            @for($i = 1; $i <= 10; $i++)
                            <label>
                                <input type="radio" name="image" value="{{ $i }}" {{ $usuario->getImagenIndex() != $i ?: 'checked'}}>
                                <img src="img/avatars/{{ $i }}.png">
                            </label>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="usuario">Nombre de usuario</label>
                            <input type="text" class="form-control" id="usuario" value="{{ $usuario->getUsername() }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="role">Tipo de perfil</label>
                            <input type="text" class="form-control" id="role" value="{{ $usuario->getRolname() }}" disabled>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $usuario->getEmail() }}" disabled>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y apellidos" value="{{ $usuario->getNombre() }}" required>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" minlength="6" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Repetir contraseña</label>
                            <input type="password" class="form-control" id="repeat-password" minlength="6" name="repeat-password">
                        </div>
                    </div>
                </div>

                <div class="col-12 card p-4 border-0 my-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="submit" class="btn btn-primary text-light">Guardar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('plantillas.footer')
    @include('plantillas.scripts')

    <?php
		echo YsJQuery::newInstance()
				->onClick()
				->in("#submit")
				->execute(YsJQValidate::build()->in('#form')
                ->_rules([
                    'repeat-password' => ['equalTo' => '#password']
                ])
            );
	?>
</body>
</html>