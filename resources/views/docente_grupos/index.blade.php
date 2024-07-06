@extends('layouts.app')

@section('content')
    <div class="container pt-5">

        <h1 class="mb-3">Asignacion de Docente a Grupos</h1>

        <form method="GET" action="{{ route('docente_grupos.index') }}">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{ request('search') }}">
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
            <br />
        @endif

        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameDocenteGrupo"><i class="fa fa-plus"></i> Crear</button>
            </div>
        </div>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docenteGrupos as $docenteGrupo)
                    <tr>
                        <th scope="row">{{ $docenteGrupo->id }}</th>
                        <td>{{ $docenteGrupo->docente->nombre }}</td>
                        <td>{{ optional($docenteGrupo->grupo)->nombre }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ameDocenteGrupo" onclick="setModalForm('edit', {{ $docenteGrupo }})">Editar</button>
                            <form action="{{ route('docente_grupos.destroy', $docenteGrupo->id) }}" method="POST" style="display: inline;">
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
         <x-modal id="ameDocenteGrupo" title="Mantenimiento de Docentes Grupos">
            <form id="docenteGrupoForm" action="{{ route('docente_grupos.store') }}" method="POST">
                @csrf
                <input type="hidden" id="method" name="_method" value="POST">
                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docentes</label>
                    <select class="form-select" id="docente_id" name="docente_id" required>
                        @foreach ($docentes  as $_docente)
                            <option value="{{ $_docente->id }}">{{ $_docente->nombre }} {{ $_docente->apellido }}</option>
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

        <!-- Paginación -->
        {{-- {{ $docenteGrupos->links() }} --}}
    </div>

    <script>
        function setModalForm(action, docenteGrupo) {
            const form = document.getElementById('docenteGrupoForm');
            const methodInput = document.getElementById('method');
            const submitBtn = document.getElementById('submitBtn');

            if (action === 'create') {
                form.action = '{{ route('docente_grupos.store') }}';
                methodInput.value = 'POST';

                form.docente_id.value = ''; 
                form.group_id.value = ''; 
                submitBtn.innerText = 'Guardar';

            } else if (action === 'edit' && docenteGrupo) {
                form.action = '{{ route('docente_grupos.update', '') }}/' + docenteGrupo.id;
                methodInput.value = 'PUT';
                
                form.docente_id.value = docenteGrupo.docente_id;
                form.group_id.value = docenteGrupo.group_id;
                
                submitBtn.innerText = 'Guardar cambios';
            }
        }
    </script>
@endsection