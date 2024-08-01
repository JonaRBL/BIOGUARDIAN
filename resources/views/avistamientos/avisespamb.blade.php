@extends('layouts.plantillaespamb')

@section('titulo', 'Avistamientos')

@section('contenido')
    <div class="card-container">
        @foreach ($consultaAvistamientos as $item)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 img-container">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded-start card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"> Ubicación: {{$item->ubicacion}}</h5>
                            <p class="card-text"> Fecha: {{$item->fecha}}</p>
                            <p class="card-text"> Reporte: {{$item->informacion}}</p>
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
            @include('partials.editaravis', ['item' => $item])
            @include('partials.eliminaravis', ['item' => $item])
        @endforeach
    </div>

@endsection
