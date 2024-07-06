@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1>Lista de grupos</h1>

        <form method="GET" action="{{ route('docentes.index') }}">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{ request('nombre') }}">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
        <br>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <br>
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameDocente"><i class="fa fa-plus"></i> Crear</button>
            </div>
        </div>
        <br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->id }}</td>
                        <td>{{ $docente->nombre }}</td>
                        <td>{{ $docente->apellido }}</td>
                        <td>{{ $docente->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ameDocente" onclick="setModalForm('edit', {{ $docente }})">Editar</button>
                            <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta relación?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <x-modal id="ameDocente" title="Mantenimiento de Docentes">
            <form id="docenteForm" action="{{ route('docentes.store') }}" method="POST">
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <hr />
                <button type="submit" class="btn btn-primary" id="submitBtn">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </form>
        </x-modal>

    </div>

    <script>
        function setModalForm(action, docente) {
            const form = document.getElementById('docenteForm');
            const methodInput = document.getElementById('method');
            const submitBtn = document.getElementById('submitBtn');
    
            if (action === 'create') {
                form.action = '{{ route('docentes.store') }}';
                methodInput.value = 'POST';
                form.nombre.value = '';
                form.apellido.value = '';
                form.email.value = '';
                form.password.value = '';
                submitBtn.innerText = 'Guardar';
            } else if (action === 'edit' && docente) {
                form.action = '{{ route('docentes.update', '') }}/' + docente.id;
                methodInput.value = 'PUT';
                form.nombre.value = docente.nombre;
                form.apellido.value = docente.apellido;
                form.email.value = docente.email;
                form.password.value = docente.password;
                submitBtn.innerText = 'Guardar cambios';
            }
        }
    </script>
@endsection
