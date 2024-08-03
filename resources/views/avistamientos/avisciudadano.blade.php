@extends('layouts.plantillaciudadano')

@section('titulo', 'Avistamientos')

@section('contenido')
    <div class="card-container">
        @foreach ($consultaAvistamientos as $item)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6 img-container">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded-start card-img">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="card-text"> Fecha: {{$item->fecha}}</p>
                            <p class="card-text"> Reporte: {{$item->informacion}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



@endsection
