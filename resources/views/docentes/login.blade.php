@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1>Inicio de sesión</h1>
        <br>
        <div class="row">
            <form action="{{ route('docentes.login') }}" method="POST">
                @csrf
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Ingresar</button>
             
                <div style="margin-top: 10px;" class="row">
                    @error('InvalidCredentials')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

            </div>
        </form>
    </div>
@endsection
