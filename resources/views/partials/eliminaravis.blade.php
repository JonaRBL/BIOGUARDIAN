<div class="modal fade" id="eliminar{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Avistamiento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='px-5 py-3' method="POST" action="/eliminaravis/{{ $item->id }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ubicacion</label>
                            <input type="text" name="txtUbicacion" class="form-control" value="{{($item->ubicacion)}}" >
                            <p class="fw-bolder">{{ $errors->first('txtUbicacion')}}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Información</label>
                            <input type="text" name="txtInformacion" class="form-control" value="{{($item->informacion)}}" >
                            <p class="fw-bolder">{{ $errors->first('txtInformacion')}}</p>
                        </div> 
            </div>
            <div class="modal-footer">
                <div class="card-footer text-body-secondary">
                    <div class="d-grid mx-auto">
                        <button class="btn btn-outline-success" type="submit">Elliminar</button>
                    </div>
                </div>
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>