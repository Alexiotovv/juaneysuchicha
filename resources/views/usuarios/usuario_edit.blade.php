@extends('bases.base')

@section('content')
@if (session()->has('guardo')=='si')
{{-- comprueba si existe el valor en sesión --}}

    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Registro</h6>
                <div class="text-white">Actualizado correctamente!</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
    <h5>Editar Usuario</h5>
    <form action="{{route('usuarios.update')}}" method="POST">@csrf
        <div class="row">
            <div class="col-md-2">
                <label for="">Id</label>
                <input type="text" class="form-control" name="id" value="{{$obj->id}}" readonly style="background-color: rgb(223, 217, 217)">
            </div>
            <div class="col-md-4">
                <label for="">correo</label>
                <input type="text" class="form-control" name="email" value="{{$obj->email}}" maxlength="50" required>
            </div>
            <div class="col-md-3">
                <label for="">nombre usuario</label>
                <input type="text" class="form-control" name="name" value="{{$obj->name}}" maxlength="100" required>
            </div>

            <div class="col-md-3">
                <label for="">Nombres</label>
                <input type="text" class="form-control" name="nombres" id="nomrbes" value="{{$obj->nombres}}" maxlength="150" required>
                
            </div>
            <div class="col-md-3">
                <label for="">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{$obj->apellidos}}" maxlength="150" required>
            </div>
            <div class="col-md-3">
                <label for="">Nro Stand</label>
                <input type="text" class="form-control" name="nro_stand" id="nro_stand" value="{{$obj->nro_stand}}" maxlength="150" required>
            </div>
            <div class="col-md-3">
                <label for="">Procedencia</label>
                <input type="text" class="form-control" name="procedencia" id="procedencia" value="{{$obj->procedencia}}" maxlength="150" required>
            </div>
            <div class="col-md-3">
                <label for="">Linea Artesanal</label>
                <input type="text" class="form-control" name="linea_artesanal" id="nro_stand" value="{{$obj->linea_artesanal}}" maxlength="150" required>
            </div>

            <div class="col-md-3">
                <label for="">tipo</label>
                <select name="tipo" id="tipo" class="form-select">
                    @if ($obj->tipo=='VISITAS')
                        <option selected value="VISITAS">VISITAS</option>
                        <option value="ARTESANIAS">ARTESANIAS</option>
                    @else
                        <option selected value="ARTESANIAS">ARTESANIAS</option>
                        <option value="VISITAS">VISITAS</option>
                    @endif
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>  
            </div>
        </div>

    </form>
@endsection
