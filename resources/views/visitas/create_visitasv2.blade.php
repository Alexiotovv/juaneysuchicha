@extends('bases.base')

@section('extra_css')
    <link href="../../../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../../../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endsection

@section('content')
    {{-- @if (session()->has('guardo')=='si') --}}
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2" id="mensaje" style="width:300px;position:absolute;" hidden>
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
        
        {{-- @endif --}}
        
        
        <form id="formVisitas">
        @csrf
        <h4 style="text-align: center;">REGISTRO DE VISITASv2</h4>
        {{-- niño --}}
        <div class="row" >
            <a type="submit" class="btn btn-danger btn-sm" id="btnGuardarVisita">Guardar</a>
            <div class="text-center" id="spinner_guardar" hidden>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-sm-3">
                <label for="" style="font-size: 17px;">CANTIDAD</label>
                <div class="input-group">
                    <input type="number" class="form-control" value="1" name="cantidad" id="cantidad" required>
                    <a href="" class="btn btn-primary" id="btnMenos"><i class="lni lni-circle-minus"></i></a>
                    <a href="" class="btn btn-warning" id="btnMas"><i class="lni lni-circle-plus"></i></a>
                </div>
                
            </div>
            <div class="col-sm-2">  
                <label for="" style="font-size: 17px;">GÉNERO</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="HOMBRE" style="font-size: 20px;" checked>
                    <label class="form-check-label" for="inlineRadio1" style="font-size: 20px;">HOMBRE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="MUJER" style="font-size: 20px">
                    <label class="form-check-label" for="inlineRadio2" style="font-size: 20px">MUJER</label>
                </div>
            </div>

            <div class="col-sm-3">
                <label for="" style="font-size: 17px;">ETAPA DE VIDA</label>
                <select name="etapa_vida" id="etapa_vida" class="form-select">
                    <option value="JOVEN">JOVEN</option>
                    <option value="NIÑO">NIÑO</option>
                    <option value="ADULTO">ADULTO</option>
                    <option value="ADULTO MAYOR">ADULTO MAYOR</option>
                </select>
            </div>

            <div class="col-sm-3">
                <label for="" style="font-size: 17px;">ORIGEN</label>
                <select name="origen" id="origen" class="form-select">
                    <option value="LOCAL">LOCAL</option>
                    <option value="NACIONAL">NACIONAL</option>
                    <option value="EXTRANJERO">EXTRANJERO</option>
                </select>
            </div>
            
        </div>
        {{-- joven --}}

    

        <br>
        <div class="col-md-4">
            <h5>Fecha Registro</h5>
            <input type="date" class="form-control" name="fecha_reg" id="fecha_reg" readonly style="background-color: #bebcbc">
         </div>
         <div class="col-md-4">
            <h5>Hora Registro</h5>
            <input type="text" class="form-control" name="hora_reg" id="hora_reg" readonly style="background-color: #bebcbc">
         </div>
         <br>
        </form>
        <div class="row">
           <div class="col-md-4">
               <label for="">CANTIDAD DE REGISTROS</label>
               <input type="text" class="form-control" id="cant" value="{{$cant}}" disabled>
           </div>
           <div class="col-md-4">
            <label for="">CANTIDAD DE PERSONAS</label>
            <input type="text" class="form-control" id="personas" value="{{$personas}}" disabled>
        </div>
       </div>
    {{-- <div class="row">
        <h5>Número de visitas</h5>
        <div class="col-md-4">
            <label for="">FREE</label>
            <input type="text" class="form-control" id="cant_free" value="{{$cant_free}}" disabled>
        </div>
        <div class="col-md-4">
            <label for="">VIP</label>
            <input type="text" class="form-control" id="cant_vip" value="{{$cant_vip}}" disabled>
        </div>
    </div> --}}
@endsection

@section('extra_js')
    <script src="../../../assets/plugins/select2/js/select2.min.js"></script>

    <script>

        $("#btnMas").on("click",function (e) { 
            e.preventDefault();
            aumenta_cantidad("cantidad");
         })
         $("#btnMenos").on("click",function (e) { 
            e.preventDefault();
            disminuye_cantidad("cantidad");
         })

        function aumenta_cantidad(nombre_input) { 
            num=parseInt($("#"+nombre_input).val());
            
            if (num>=0){
                $("#"+nombre_input).val(num+1);
            }
        }
        function disminuye_cantidad(nombre_input) { 
            num=parseInt($("#"+nombre_input).val());
            if (num>0){
                $("#"+nombre_input).val(num-1);
            }
        }

        $("#btnGuardarVisita").on("click",function (e) { 
            e.preventDefault();
            // if ($("#dni").val()=='' || $("#nombres").val()==''||$("#apellido_paterno").val()=='' ||$("#apellido_materno").val()=='') {
            if ($("#cantidad").val()=='') {
                alert("Complete una cantidad");
            }else{
                e.preventDefault();
                GuardarForm();

            }
         })

         function GuardarForm(){
            ds=$("#formVisitas").serialize();
                $.ajax({
                    type: "POST",
                    url: "/visitascontador/store",
                    data: ds,
                    dataType: "json",
                    beforeSend: function() {
                        $("#spinner_guardar").prop('hidden',false);
                    },
                    success: function (response) {
                        // $("#mensaje").css('display',t)
                        console.log(response);
                        $("#cant").val(response.cant);
                        $("#personas").val(response.personas);
                        $("#mensaje").prop('hidden',false)
                        desaparecer_mensaje();
                        // $("#cant_vip").val(response.cant_vip);
                        LimpiarForm();
                        $("#spinner_guardar").prop('hidden',true);
                        
                    },
                    error: function (response) {  
                        $("#spinner_guardar").prop('hidden',true);
                        alert('error'+response);
                    }


                });
         }


         function LimpiarForm(){
            $("#cantidad").val('1');
            // $("#cantidad").focus();
         };


        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script>

        
        $("#cantidad").focus();

    </script>
    <script>
            setInterval(muestrahora2, 1000);
                function muestrahora2() { 
                    var hoy = new Date();
                    hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
                    document.getElementById("hora_reg").value = hora;    
            }

            function desaparecer_mensaje() { 
                setTimeout(function(){
                    $("#mensaje").prop('hidden',true);
                }, 1000);
             }

            var fecha = new Date();
            document.getElementById("fecha_reg").value = fecha.toJSON().slice(0, 10);
    </script>
    {{-- <script src="../../../app_js/crud.js"></script> --}}
    
@endsection
