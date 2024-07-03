@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Estudiantes</h1>
    
    <div class="row">
        <div class="col-sm-4">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
        </div>
    </div>
    <br>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        <br>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameEstudiante"><i class="fa fa-plus"></i> Crear</button>
        </div>
    </div>
    <br>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Pin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->id }}</td>
                <td>{{ $estudiante->nombre }}</td>
                <td>{{ $estudiante->apellido }}</td>
                <td>{{ $estudiante->email }}</td>
                <td>{{ $estudiante->pin }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ameEstudiante"
                    onclick="setModalForm('edit', {{ $estudiante }})">Editar</button>
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<x-modal id="ameEstudiante" title="Mantenimiento de Estudiantes">
    <form id="estudianteForm" action="{{ route('estudiantes.store') }}" method="POST">
        @csrf
        <input type="hidden" id="method" name="_method" value="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="pin" class="form-label">Pin</label>
            <input type="text" class="form-control" id="pin" name="pin" required>
        </div>
        <hr />
        <button type="submit" class="btn btn-primary" id="submitBtn">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </form>
</x-modal>

<script>
    function setModalForm(action, estudiante) {
            const form = document.getElementById('estudianteForm');
            const methodInput = document.getElementById('method');
            const submitBtn = document.getElementById('submitBtn');
    
            if (action === 'create') {
                form.action = '{{ route('estudiantes.store') }}';
                methodInput.value = 'POST';
                form.nombre.value = '';
                form.apellido.value = '';
                form.email.value = '';
                form.pin.value = '';
                submitBtn.innerText = 'Guardar';
            } else if (action === 'edit' && estudiante) {
                form.action = '{{ route('estudiantes.update', '') }}/' + estudiante.id;
                methodInput.value = 'PUT';
                form.nombre.value = estudiante.nombre;
                form.apellido.value = estudiante.apellido;
                form.email.value = estudiante.email;
                form.pin.value = estudiante.pin;
                submitBtn.innerText = 'Guardar';
            }
        }
    </script>
</script>
@endsection
