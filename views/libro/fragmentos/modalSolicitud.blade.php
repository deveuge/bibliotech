<div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close ms-auto m-3 mb-0" data-bs-dismiss="modal"
                aria-label="Cerrar"></button>
            <div class="modal-body text-center">
                ¿Desea solicitar el libro "{{ $libro->getNombre() }}" de {{ $libro->getAutor() }}?
                <div class="alert alert-primary d-inline-block p-2 lh-1 mt-2 mb-0" role="alert">
                    <span class="fas fa-info-circle fa-lg me-2"></span>
                    <small>Deberá devolverlo antes del: <span class="badge bg-secondary ms-1">{{ Clases\Utils\Funciones::getFechaDevolucion()->format('d/m/Y') }}</span></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <form action="prestamo.php" method="POST">
                    <input type="hidden" name="accion" value="solicitar"/>
                    <input type="hidden" id="isbn" name="isbn" value="{{$libro->getIsbn()}}"/>
                    <button type="submit" class="btn btn-primary text-light">Solicitar</button>
                </form>
            </div>
        </div>
    </div>
</div>