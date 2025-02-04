<div class="modal fade" id="editar{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='px-5 py-3' method="POST" action="/editarpubli/{{ $item->id }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titulo</label>
                            <input type="text" name="txtTitulo" class="form-control" value="{{($item->titulo)}}" required>
                            <p class="fw-bolder">{{ $errors->first('txtTitulo')}}</p>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Recuerdos</label>
                            <input type="text" name="txtComentario" class="form-control" value="{{($item->comentario)}}" required>
                            <p class="fw-bolder">{{ $errors->first('txtComentario')}}</p>
                        </div> 
            </div>

            <div class="modal-footer">
                        <div class="card-footer text-body-secondary">
                            <div class="d-grid mx-auto">
                                <button class="btn btn-outline-success" type="submit">Guardar</button>
                            </div>
                        </div>
            </div>
                    
                </form> 
                
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit form submission
        document.querySelectorAll('form[action^="/editarpubli/"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Publicación editada correctamente',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            });
        });
    });
</script>