<div class="modal fade" id="eliminar{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='px-5 py-3' method="POST" action="/editarelimi/{{ $item->id }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titulo</label>
                            <input type="text" name="txtTitulo" class="form-control" value="{{($item->titulo)}}" disabled>
                            <p class="fw-bolder">{{ $errors->first('txtTitulo')}}</p>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Recuerdos</label>
                            <input type="text" name="txtComentario" class="form-control" value="{{($item->comentario)}}" disabled>
                            <p class="fw-bolder">{{ $errors->first('txtRecuerdos')}}</p>
                        </div> 
            </div>
            <div class="modal-footer">
                <div class="card-footer text-body-secondary">
                    <div class="d-grid mx-auto">
                        <button class="btn btn-outline-success" type="submit">Eliminar</button>
                    </div>
                </div>
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form[action^="/editarelimi/"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(this.action, {
                            method: 'POST',
                            body: new FormData(this),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(() => {
                            Swal.fire(
                                'Eliminado',
                                'La publicación ha sido eliminada.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        });
                    }
                });
            });
        });
    });
</script>