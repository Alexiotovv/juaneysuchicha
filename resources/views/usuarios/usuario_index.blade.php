@extends('bases.base')

@section('extra_css')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')

    <h5>Lista Usuarios</h5>
    @if (session()->has('guardo')=='si')
    {{-- comprueba si existe el valor en sesión --}}

        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Registro</h6>
                    <div class="text-white">Guardado correctamente!</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="DTUsuarios">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Acción</th>
                    <th>nombre_usuario</th>
                    <th>tipo_usuario</th>
                    <th>correo</th>
                    <th>nombres</th>
                    <th>apellidos</th>
                    <th>nro_stand</th>
                    <th>procedencia</th>
                    <th>linea_artesanal</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($obj as $usu)
                    <tr>
                        <td>{{ $usu->id }}</td>
                        <td><a href="/usuarios/edit/{{ $usu->id }}" class="btn btn-warning btn-sm">Editar</a>
                        <a class="btn btn-danger btn-sm btnCambiarClave">Cambiar Contraseña</a>
                        </td>
                        <td>{{ $usu->name }}</td>
                        <td>{{ $usu->tipo }}</td>
                        <td>{{ $usu->email }}</td>
                        <td>{{ $usu->nombres }}</td>
                        <td>{{ $usu->apellidos }}</td>
                        <td>{{ $usu->nro_stand }}</td>
                        <td>{{ $usu->procedencia }}</td>
                        <td>{{ $usu->linea_artesanal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <form id="formCambiarClave">
        @csrf
        <div class="modal-size-lg d-inline-block">
            <div class="modal fade text-left" id="ModalCambiarClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-default" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="EtiquetaCambiarClave">-</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        {{-- <label for="">Id</label> --}}
                                        <input type="text" class="form-control form-control" name="IdUsuarioClave" id="IdUsuarioClave" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="">Nombre del Usuario</label>
                                    <input type="text" id="NombreUsuario" name="NombreUsuario" class=" form-control form-control-md" readonly/>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input  class="form-control border-end-0" id="passwordchange" type="password" name="passwordchange" placeholder="············"/><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                    <label class="form-label">Reingrese Contraseña</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input  class="form-control border-end-0" id="passwordchange2" type="password" name="passwordchange2" placeholder="············"/><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                            </div>        
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" id="btnGuardaContrasena">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('extra_js')
    <script src="../../../app_js/crud.js"></script>
    <script src="../../../app_js/usuarios.js"></script>
@endsection
