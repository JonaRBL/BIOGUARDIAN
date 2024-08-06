@extends('layouts.plantillaamb')

@section('titulo', 'Perfil de usuario')

@section('contenido')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .navbar {
            background-color: #28a745;
        }
        .navbar-brand img {
            width: 46px;
            border-radius: 50%;
        }
        
        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .profile-card {
            width: 100%;
            max-width: 600px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }
        .profile-card .card-header {
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .profile-card img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-top: -75px;
            border: 5px solid #fff;
            object-fit: cover;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .profile-card .card-body {
            padding-top: 0;
            background: rgba(255, 255, 255, 0.9);
        }
        .profile-info {
            margin-top: 20px;
        }
        .card-footer button {
            margin-left: 10px;
        }
        .card-header {
            text-align: center;
            color: #007bff;
            margin-top: 10px;
            margin-bottom: 20px;
            letter-spacing: 0.5px; /* Añade espacio entre las letras */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="content">
        <div class="card profile-card">
            <div class="card-header">
                <h1 class="fs-2">Perfil de Usuario</h1>
            </div>
            <div class="card-body text-center">
                <div class="profile-info">
                    <p><strong>Nombre de Usuario:</strong> {{ $user->name }}</p>
                    <p><strong>Correo:</strong> {{ $user->email }}</p>
                    <p><strong>Tipo de Usuario:</strong> {{ $user->role }}</p>
                    <p><strong>Fecha en la que se Unió:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-success" data-bs-target='#editar{{ $user->id }}' data-bs-toggle='modal'>
                    Editar
                </button>
                <button type="button" class="btn btn-danger ms-2" data-bs-target='#eliminar{{ $user->id }}' data-bs-toggle='modal'>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
    @include('partials.editusu')
    @include('partials.eliusu')

    @if(session()->has('confirmacion'))
    <script>
            Swal.fire({
            title: 'Confirmación',
            text: '{{ session('confirmacion') }}',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
    @endif
    @if(session()->has('confirmacion2'))
    <script>
        Swal.fire({
            title: 'Confirmación',
            text: '{{ session('confirmacion2') }}',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
    @endif

@endsection

