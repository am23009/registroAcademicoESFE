@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4">Registrar Asistencia</h1>
            <p class="lead">Ingrese el PIN del estudiante para registrar su asistencia.</p>
            <hr class="my-4">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            


            <form action="{{ route('asistencia.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pin" class="form-label">PIN del Estudiante</label>
                    <input type="text" class="form-control" id="pin" name="pin" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
            </form>
        </div>

        <div class="mt-4">
            <h2>Últimos registros de asistencia</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Grupo</th>
                        <th>Fecha</th>
                        <th>Hora de Entrada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistencias->take(5) as $asistencia)
                        <tr>
                            <td>{{ $asistencia->estudiante->nombre }} {{ $asistencia->estudiante->apellido }}</td>
                            <td>{{ $asistencia->grupo->nombre }}</td>
                            <td>{{ $asistencia->fecha }}</td>
                            <td>{{ $asistencia->hora_entrada }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
