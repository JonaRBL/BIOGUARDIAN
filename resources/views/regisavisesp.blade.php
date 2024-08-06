@extends('layouts.plantillaesp')

@section('titulo', 'Registro de avistamiento')

@section('contenido')

@if(session()->has('confirmacion'))
<div class="alert alert-primary alert-dismissible fade show text-center mx-auto mt-4" style="max-width: 400px;" role="alert">
  <strong> {{ session('confirmacion') }} </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show text-center mx-auto mt-4" style="max-width: 400px;" role="alert">
  <strong> {{ $error }} </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class="login-container mb-4">
    <div class="login-card row">
        <div class="col-md-5 text-center">
            <img src="{{ asset('imagenes/logo.png') }}" alt="BIOGUARDIAN" width="150" class="login-image mt-4">
            <h1 class="mt-4 fs-2">BIOGUARDIAN</h1>
        </div>
        <div class="col-md-7">
            <div class="login-header">
                <h1 class="fs-2"> Registrar avistamiento </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="/guardaravistamiento" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion') }}" required>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                        @error('ubicacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="informacion" class="form-label">Información</label>
                        <div class="form-floating">
                            <textarea class="form-control @error('informacion') is-invalid @enderror" name="informacion" id="informacion" placeholder="Leave a comment here" style="height: 100px" required>{{ old('informacion') }}</textarea>
                            <label for="informacion">Escribe los datos aquí</label>
                            @error('informacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Seleccionar foto</label>
                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" required>
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid mb-4">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
body {
    font-family: 'Inter', sans-serif;
    background-size: cover;
    background-position: center;
}

.navbar {
    background-color: #28a745;            
}

.navbar-brand img {
    width: 46px;
    border-radius: 50%;
}

.login-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 20px;
}

.login-card {
    width: 100%;
    max-width: 800px;
    background: rgba(255, 255, 255, 0.9);
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-image {
    object-fit: cover;
    display: block;
    margin: 0 auto;
    padding-top: 60px;
}

.login-header {
    text-align: center;
    color: #007bff;
    margin-top: 20px;
    margin-bottom: 20px;
    letter-spacing: 0.5px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.login-title {
    font-family: 'Inter', sans-serif;
    font-size: 1.5em;
    color: #333;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    letter-spacing: 0.5px;
}
</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
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
        document.getElementById('ubicacion').value = event.latLng.lat() + ',' + event.latLng.lng();
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            marker.setPosition(pos);
            document.getElementById('ubicacion').value = pos.lat + ',' + pos.lng;
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

@endsection
