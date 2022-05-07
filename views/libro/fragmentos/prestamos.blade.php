
<div id="prestamos">
    @if (sizeOf($prestamos) > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col" style="width: 2rem"></th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha préstamo</th>
                    <th scope="col">Fecha devolución</th>
                    <th scope="col">Estado</th>
                    @if($_SESSION['usuario']->esModerador())
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                <tr class="{{ $prestamo->getColorFila() }}">
                    <td><img src="{{ $prestamo->getUsuario()->getImagen() }}" class="user-image"></td>
                    <th scope="row">
                        <a href="perfil.php?id={{ $prestamo->getUsuario()->getUsername() }}">{{ $prestamo->getUsuario()->getUsername() }}</a>
                    </th>
                    <td>{{ $prestamo->getUsuario()->getNombre() }}</td>
                    <td>{{ $prestamo->getFechaCreacionPrestamo() }}</td>
                    <td>{{ $prestamo->getFechaAsignadaDevolucion() }}</td>
                    <td>{{ $prestamo->getEstado() }}</td>
                    @if($_SESSION['usuario']->esModerador())
                    <td>
                        <span class="d-inline-block" data-bs-toggle="tooltip" title="Realizar devolución">
                            <a href="#" data-target-user="{{ $prestamo->getUsuario()->getUsername() }}" data-target-name="{{ $prestamo->getUsuario()->getNombre() }}" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#devolucionModal"><i class="fas fa-undo"></i></a>
                        </span>
                    </td>
                    @else
                    <td class="d-none"></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>
    @endif
</div>