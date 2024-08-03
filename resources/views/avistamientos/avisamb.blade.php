@extends('layouts.plantillaamb')

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
                            <h5 class="card-title"> Ubicación: {{$item->ubicacion}}</h5>
                            <p class="card-text"> Fecha: {{$item->fecha}}</p>
                            <p class="card-text"> Reporte: {{$item->informacion}}</p>
                            <div class="button-container">
                                <button type='button' class='btn btn-danger' onclick="confirmarEliminacion({{ $item->id }})">
                                    Borrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.eliminaravis', ['item' => $item])
        @endforeach
    </div>

    @foreach ($consultaAvistamientos as $item)
        <form id="deleteForm{{ $item->id }}" action="{{ route('avistamientos.destroy', $item->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <script>
        function confirmarEliminacion(itemId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres eliminar este avistamiento?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm${itemId}`).submit();
                }
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
            
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });
    </script>

@endsection
