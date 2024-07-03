@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1>Lista de grupos</h1>

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
        @endif

        <br>
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ameEstudianteGrupo"><i class="fa fa-plus"></i> Crear</button>
            </div>
        </div>
        <br>
    </div>