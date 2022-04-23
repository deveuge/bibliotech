<div class="modal fade" id="devolucionModal" tabindex="-1" aria-labelledby="devolucionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close ms-auto m-3 mb-0" data-bs-dismiss="modal"
                aria-label="Cerrar"></button>
            <div class="modal-body text-center">
                ¿Confirmar la devolución del libro "{{ $libro->getNombre() }}" de {{ $libro->getAutor() }} para el usuario <span class="badge bg-secondary ms-1"><span id="devolucion-nombre"></span> (<span id="devolucion-usuario"></span>)</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <form action="prestamo.php" method="POST">
                    <input type="hidden" name="accion" value="devolver"/>
                    <input type="hidden" id="isbn" name="isbn" value="{{$libro->getIsbn()}}"/>
                    <input type="hidden" id="devolucion-user" name="user"/>
                    <button type="submit" class="btn btn-primary text-light">Devolver</button>
                </form>
            </div>
        </div>
    </div>
</div>
