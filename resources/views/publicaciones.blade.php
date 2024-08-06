@extends('layouts.plantillaamb')

@section('titulo', 'Crear publicaciones')

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

<div class="login-container">
    <div class="login-card row">
        <div class="col-md-5 text-center">
            <img src="{{ asset('imagenes/logo.png') }}" alt="BIOGUARDIAN" width="150" class="login-image mt-4">
            <h1 class="mt-4 fs-2">BIOGUARDIAN</h1>
        </div>
        <div class="col-md-7">
            <div class="login-header">
                <h1 class="fs-2"> Crear Publicación </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="/guardarpublicacion" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                        @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Publicación</label>
                        <div class="form-floating">
                            <textarea class="form-control @error('comentarios') is-invalid @enderror" name="comentarios" id="comentarios" placeholder="Leave a comment here" style="height: 100px" required>{{ old('comentarios') }}</textarea>
                            <label for="comentarios">Escribe la información aquí</label>
                            @error('comentarios')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Seleccionar foto</label>
                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
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
    font-family: 'Inter', sans-serif; /* Aplica la fuente Roboto al cuerpo del documento */
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
    margin: 0 auto; /* Centra horizontalmente la imagen */
    padding-top: 60px; /* Añade padding en la parte superior */
    
}

.login-header {
    text-align: center;
    color: #007bff;
    margin-top: 20px;
    margin-bottom: 20px;
    letter-spacing: 0.5px; /* Añade espacio entre las letras */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.login-title {
    font-family: 'Inter', sans-serif; /* Tipografía */
    font-size: 1.5em; /* Tamaño de fuente */
    color: #333; /* Color del texto */
    text-align: center; /* Alineación */
    margin-top: 20px; /* Espaciado superior */
    margin-bottom: 20px; /* Espaciado inferior */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Sombra del texto */
    letter-spacing: 0.5px; /* Espaciado entre letras */
}

</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>


@endsection
