<div class="modal fade" id="editar{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Avistamiento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='px-5 py-3' method="POST" action="/editaravist/{{ $item->id }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <input type="text" name="txtUbicacion" id="txtUbicacion" class="form-control" value="{{($item->ubicacion)}}" required>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                        <p class="fw-bolder">{{ $errors->first('txtUbicacion')}}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Información</label>
                        <input type="text" name="txtInformacion" class="form-control" value="{{($item->informacion)}}" required>
                        <p class="fw-bolder">{{ $errors->first('txtInformacion')}}</p>
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2o0QDA85_790TVnmhWFJT_4lzRQrD9aU&callback=initMap" async defer></script>
<script>
function initMap() {
    var initialPos = { lat: 15.83752, lng: -92.75774 };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: initialPos,
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: initialPos,
        map: map,
        draggable: true
    });

    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        document.getElementById('txtUbicacion').value = event.latLng.lat() + ',' + event.latLng.lng();
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            marker.setPosition(pos);
            document.getElementById('txtUbicacion').value = pos.lat + ',' + pos.lng;
        }, function() {
            handleLocationError(true, map.getCenter());
        });
    } else {
        handleLocationError(false, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    var infoWindow = new google.maps.InfoWindow({
        position: pos,
        content: browserHasGeolocation ? 
            'Error: El servicio de Geolocalización ha fallado.' :
            'Error: Tu navegador no soporta geolocalización.'
    });
    infoWindow.open(map);
}
</script>