@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success fade show" id='success-message' data-bs-dismiss='alert' role='alert'>
            {{session('success')}}
        </div>
    @endif
    
    <div class="container pt-5">
        <h1>Lista de grupos</h1>

        <div class="row">
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameGrupo"><i class="fa fa-plus"></i> Crear</button>
            </div>
        </div>
        <br>
        <table class="table table-stripped mt-10">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->descripcion }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ameGrupo" onclick="setModalForm('edit', {{ $grupo }})">
                            Editar
                        </button>
                        <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
        <div class="row">
            <div class="col-sm-12">
                {{$grupos->links()}}
            </div>
        </div>   
    </div>
    
    <x-modal id="ameGrupo" title="Mantenimiento de Grupos">
        <form id="grupoForm" action="{{ route('grupos.store') }}" method="POST">
            @csrf
            <input type="hidden" id="method" name="_method" value="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <hr />
            <button type="submit" class="btn btn-primary" id="submitBtn">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </form>
    </x-modal>

    <script>
        function setModalForm(action, grupo) {
            const form = document.getElementById('grupoForm');
            const methodInput = document.getElementById('method');
            const submitBtn = document.getElementById('submitBtn');
    
            if (action === 'create') {
                form.action = '{{ route('grupos.store') }}';
                methodInput.value = 'POST';
                form.nombre.value = '';
                form.descripcion.value = '';
                submitBtn.innerText = 'Guardar';
            } else if (action === 'edit' && grupo) {
                form.action = '{{ route('grupos.update', '') }}/' + grupo.id;
                methodInput.value = 'PUT';
                form.nombre.value = grupo.nombre;
                form.descripcion.value = grupo.descripcion;
                submitBtn.innerText = 'Guardar cambios';
            }
        }
    </script>

@endsection
