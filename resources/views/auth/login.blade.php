@extends('layouts.plantilla')

@section('titulo', 'Inicio de sesión')

@section('contenido')
<br>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8 ">
                <div class="card" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <div class="card-header titulo fs-2" style="color: #007bff; letter-spacing: 0.5px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">{{ __('Inicio de sesión') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" style="color: black" class="col-md-4 col-form-label text-md-end letras fs-5">{{ __('Correo electronico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" style="color: black" class="col-md-4 col-form-label text-md-end letras fs-5">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" style="width: 180px; color: black" class="btn btn-primary fs-5">
                                        {{ __('Iniciar sesion') }}
                                    </button>

                                    
                                </div>
                                <div class="col-md-6 offset-md-3">
                                    @if (Route::has('password.request'))
                                        <a  style="width: 300px; color: #49562A" class="btn btn-link fs-5" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
