@extends('layouts.plantillaamb')

@section('titulo', 'Educación Ambiental')

@section('contenido')

    <div id="carouselExampleCaptions" class="carousel slide mb-5">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://visado-india.es/wp-content/uploads/2023/01/animales-de-la-india-como-es-su-fauna.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h1 class="display-1" style="color: black"> BIOGUARDIAN </h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://wastemagazine.es/fotos2/lobo-1200-pixabay.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-1 fs-1" style="color: black">Elevando juntos el eco de la vida</h1>
            </div>
        </div>
            <div class="carousel-item">
                <img src="https://mx.parent.com/cdn/shop/articles/preschooler-boy-is-exploring-nature-with-magnifying-glass._1000x.jpg?v=1687225670" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-1 fs-1" style="color: black">Tu plataforma para proteger y preservar la biodiversidad</h1>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="card-container">
        @foreach ($consultaPublicaciones as $item)
            <div class="card mb-3">
                <div class="row g-0">
                    @if($item->foto_publi)
                        <div class="col-md-6 img-container">
                            <img src="{{ asset('storage/' . $item->foto_publi) }}" class="img-fluid rounded-start card-img" alt="Foto publicada">
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Título: {{$item->titulo}}</h5>
                            <p class="card-text">Fecha de Publicación: {{$item->fecha}}</p>
                            <p class="card-text"> {{$item->comentario}}</p>
                            <div class="button-container">
                                <button type='button' class='btn btn-success' data-bs-target='#editar{{ $item->id }}' data-bs-toggle='modal'>
                                    Editar
                                </button>
                                <button type='button' class='btn btn-danger' data-bs-target='#eliminar{{ $item->id }}' data-bs-toggle='modal'>
                                    Borrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.editarpubli', ['item' => $item])
            @include('partials.eliminarpubli', ['item' => $item])
        @endforeach
    </div>

@endsection
