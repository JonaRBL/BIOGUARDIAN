@extends('layouts.plantillaadmin')

@section('titulo', 'Consulta de Usuarios')

@section('contenido')

    <div class="container mt-4">
        <form action="{{ route('consultas') }}" method="GET" class="mb-3">
            <div class="d-flex justify-content-end">
                <div class="input-group" style="width: 500px">
                    <input type="text" name="search" class="form-control" placeholder="Buscar usuarios..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
        <h1>Lista de Usuarios</h1>
        <table class="table" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editarModal{{ $user->id }}">
                            Editar
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal{{ $user->id }}">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @include('partials.editaruser', ['user' => $user])
                @include('partials.eliminaruser', ['user' => $user])
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
    <script>
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
    </script>
@endsection