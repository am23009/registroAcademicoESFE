@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1 class="mb-3">Asignacion de Alumnos a Grupo</h1>
        

        <div class="row">
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameEstudianteGrupo"><i class="fa fa-plus"></i> Crear</button>
            </div>
        </div>
        <br>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            <br>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudianteGrupos as $estudianteGrupo)
                    <tr>
                        <th scope="row">{{ $estudianteGrupo->id }}</th>
                        <td>{{ optional($estudianteGrupo->grupo)->nombre }}</td>
                        <td>{{ $estudianteGrupo->estudiante->nombre }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ameEstudianteGrupo" onclick="setModalForm('edit', {{ $estudianteGrupo }})">Editar</button>
                            <form action="{{ route('estudiante_grupos.destroy', $estudianteGrupo->id) }}" method="POST" style="display: inline;">
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
         <x-modal id="ameEstudianteGrupo" title="Mantenimiento de Estudiantes Grupo">
            <form id="estudianteGrupoForm" action="{{ route('estudiante_grupos.store') }}" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <div class="mb-3">
                    <label for="estudiante_id" class="form-label">Estudiante</label>
                    <select class="form-select" id="estudiante_id" name="estudiante_id" required>
                        @foreach ($estudiantes  as $_estudiante)
                            <option value="{{ $_estudiante->id }}">{{ $_estudiante->nombre }} {{ $_estudiante->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="group_id" class="form-label">Grupo</label>
                    <!-- Aquí puedes usar un select para seleccionar un grupo -->
                    <select class="form-select" id="group_id" name="group_id" required>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <hr />
                <button type="submit" class="btn btn-primary" id="submitBtn">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </form>
        </x-modal>

        <script>
            function setModalForm(action, estudianteGrupo) {
                const form = document.getElementById('estudianteGrupoForm');
                const methodInput = document.getElementById('method');
                const submitBtn = document.getElementById('submitBtn');

                if (action === 'create') {
                    form.action = '{{ route('estudiante_grupos.store') }}';
                    methodInput.value = 'POST';
    
                    form.estudiante_id.value = ''; 
                    form.group_id.value = ''; 
                    submitBtn.innerText = 'Guardar';
    
                } else if (action === 'edit' && estudianteGrupo) {
                    form.action = '{{ route('estudiante_grupos.update', '') }}/' + estudianteGrupo.id;
                    methodInput.value = 'PUT';
                    
                    form.estudiante_id.value = estudianteGrupo.estudiante_id;
                    form.grupo_id.value = estudianteGrupo.group_id;
                    submitBtn.innerText = 'Guardar cambios';
                }
            }
        </script>
    </div>

    
@endsection