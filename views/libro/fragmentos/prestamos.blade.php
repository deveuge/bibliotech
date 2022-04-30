
<div id="prestamos">
    @if (sizeOf($prestamos) > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha préstamo</th>
                    <th scope="col">Fecha devolución</th>
                    <th scope="col">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                <tr class="{{ $prestamo->esFueraDePlazo() ? 'table-danger' : '' }}">
                    <th scope="row">{{ $prestamo->getUsuario()->getUsername() }}</th>
                    <td>{{ $prestamo->getUsuario()->getNombre() }}</td>
                    <td>{{ $prestamo->getFechaCreacionPrestamo() }}</td>
                    <td>{{ $prestamo->getFechaAsignadaDevolucion() }}</td>
                    <td>{{ $prestamo->getEstado() }}</td>
                    <td>
                        <span class="d-inline-block" data-bs-toggle="tooltip" title="Realizar devolución">
                            <a href="#" data-target-user="{{ $prestamo->getUsuario()->getUsername() }}" data-target-name="{{ $prestamo->getUsuario()->getNombre() }}" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#devolucionModal"><i class="fas fa-undo"></i></a>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="card card-header text-muted text-center rounded mb-3">Sin registros</p>
    @endif
</div>