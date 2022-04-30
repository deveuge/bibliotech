@if($_SESSION['usuario']->esModerador())
<div class="modal fade" id="eliminacionModal" tabindex="-1" aria-labelledby="eliminacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close ms-auto m-3 mb-0" data-bs-dismiss="modal"
                aria-label="Cerrar"></button>
            <div class="modal-body text-center">
                ¿Confirmar la eliminación del libro "{{ $libro->getNombre() }}" de {{ $libro->getAutor() }}?
                <div class="alert alert-danger mt-2 mb-0 p-1 d-flex align-items-center">
                    <span class="fas fa-exclamation-triangle fa-lg float-start ms-2"></span>
                    Esta acción borrará por completo el libro del sistema, incluyendo los préstamos asociados al mismo.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <form action="libro.php" method="POST">
                    <input type="hidden" name="accion" value="eliminar"/>
                    <input type="hidden" id="eliminacion-isbn" name="isbn" value="{{$libro->getIsbn()}}"/>
                    <button type="submit" class="btn btn-danger text-light">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
