@extends('bases.base')

@section('extra_css')
    <link href="../../../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../../../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endsection

@section('content')
    @if (session()->has('guardo')=='si')
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2" id="mensaje" style="width:300px;position:absolute; ">
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


    <form id="formVisitas" action="{{route('visitas.store')}}" method="POST">
        @csrf
        <h4 style="text-align: center;">REGISTRO DE VISITAS</h4>
        <div class="row"  style="place-content:center">
            <div class="col-md-4" style="text-align-last: center;">
                <h2 style="text-align: center;">INGRESE DNI</h3>
                <input type="text" class="form-control" name="dni" id="dni" style="height: 90px;font-size:50px;text-align:center" required>
                <a href="" id="btnConsultar" class="btn btn-warning" style="width:100%;font-size:30px">Consultar</a>
                <div class="text-center" id="spinner" hidden>
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
             <div class="col-md-4">
                <h5>Nombres</h5>
                <input type="text" class="form-control" name="nombres" id="nombres" required>
            </div>
            <div class="col-md-4">
                <h5>Apellido Paterno</h5>
                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" required>
             </div>
             <div class="col-md-4">
                <h5>Apellido Materno</h5>
                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
             </div>
             <div class="col-md-3">
                <h5>Sexo</h5>
                <select name="sexo" id="sexo" class="form-select">
                    <option value="MASCULINO">MASCULINIO</option>
                    <option value="FEMENINO">FEMENINO</option>
                </select>
             </div>
             <div class="col-md-3">
                <h5>Fecha Nac.</h5>
                <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
             </div>
             <div class="col-md-3">
                <h5>Tipo Visita</h5>
                <select class="form-select" name="tipo_visita" id="tipo_visita">
                    <option value="FREE">FREE</option>
                    <option value="VIP">VIP</option>
                </select>
             </div>
             <div class="col-md-3">
                <h5>Origen</h5>
                <select class="form-select" name="origen" id="origen">
                    <option value="LOCAL">LOCAL</option>
                    <option value="TURISTA">TURISTA</option>
                </select>
             </div>
             <div class="row" id="seccion_turista" hidden>
                 <div class="col-md-4">
                     <h5>Pais</h5>
                     <select class="single-select" aria-label="Default select example" name="pais" id="pais">
                         @foreach ($paises as $p)
                             @if ($p->pais=='PERU')
                                 <option selected value="{{$p->pais}}">{{$p->pais}}</option>    
                             @else
                                 <option value="{{$p->pais}}">{{$p->pais}}</option>
                             @endif
                         @endforeach
                         
                     </select>
                 </div>
                 <div class="col-md-4">
                     <h5>Ciudad</h5>
                     <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="nombre ciudad">
                 </div>
 
                 <div class="col-md-4">
                     <h5>¿Tiempo de Permanencia?</h5>
                     <select name="tiempo_permanencia" id="tiempo_permanencia" class="form-select">
                         <option value="UNAS_HORAS">UNAS HORAS</option>
                         <option value="UNA NOCHE O MAS">UNA NOCHE O MÁS</option>
                     </select>
                 </div>
 
                 <div class="col-md-4">
                     <h5>¿Qué medio de tranporte utilizó para realizar este viaje?</h5>
                     <select name="medio_viaje" id="medio_viaje" class="form-select">
                         <option value="AVION">AVION</option>
                         <option value="EMBARCACION FLUVIAL">EMBARCACIÓN FLUVIAL</option>
                         <option value="BUS INTERPROVINCIAL">BUS INTERPROVINCIAL</option>
                         <option value="MOVILIDAD PARTICULAR">MOVILIDAD PARTICULAR</option>
                         <option value="TAXI COLECTIVO">TAXI COLECTIVO</option>
                     </select>
                 </div>

             </div>

             <div class="col-md-4">
                <h5>Fecha Registro</h5>
                <input type="date" class="form-control" name="fecha_reg" id="fecha_reg" readonly style="background-color: #bebcbc">
             </div>
             <div class="col-md-4">
                <h5>Hora Registro</h5>
                <input type="text" class="form-control" name="hora_reg" id="hora_reg" readonly style="background-color: #bebcbc">
             </div>
             <br>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <br>
                <button type="submit" class="btn btn-danger" style="font-size: 25px;">Guardar</button>
            </div>
        </div>
    </form>
    <div class="row">
        <h5>Número de visitas</h5>
        <div class="col-md-4">
            <label for="">FREE</label>
            <input type="text" class="form-control" id="cant_free" value="{{$cant_free}}" disabled>
        </div>
        <div class="col-md-4">
            <label for="">VIP</label>
            <input type="text" class="form-control" id="cant_vip" value="{{$cant_vip}}" disabled>
        </div>
    </div>
@endsection
@section('extra_js')
    <script src="../../../assets/plugins/select2/js/select2.min.js"></script>

    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script>
        $("#origen").on("change",function () {
            
            if ($("#origen").val()=='TURISTA') {
                $("#seccion_turista").prop('hidden',false);
            }else{
                $("#seccion_turista").prop('hidden',true);
            }
        })
        

        $("#dni").focus();
        $("#btnConsultar").on("click",function (e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "https://dniruc.apisperu.com/api/v1/dni/"+ $("#dni").val() +"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsZXhpb3RvdnZAZ21haWwuY29tIn0.lI0TpAOzB02VvEjL01-oofG-Zk9glBYVfE6gJ766H0M",
                // data: "data",
                dataType: "json",
                beforeSend: function() {
                        $("#spinner").prop('hidden',false);
                },
                success: function (response) {
                    $("#nombres").val(response['nombres']);
                    $("#apellido_paterno").val(response['apellidoPaterno']);
                    $("#apellido_materno").val(response['apellidoMaterno']);
                    $("#spinner").prop('hidden',true);
                    
                },
                error: function (response) {  
                    $("#spinner").prop('hidden',true);
                    alert('error'+response);
                    
                }
                
            });
        })

    </script>
    <script>
            setInterval(muestrahora2, 1000);
                function muestrahora2() { 
                    var hoy = new Date();
                    hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
                    document.getElementById("hora_reg").value = hora;    
            }

            setTimeout(function(){
                $("#mensaje").css('display','none');
            }, 3000);

            var fecha = new Date();
            document.getElementById("fecha_reg").value = fecha.toJSON().slice(0, 10);
    </script>
    {{-- <script src="../../../app_js/crud.js"></script> --}}
    
@endsection
