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


    <form id="formVentas" action="{{route('ventas.store')}}" method="POST">
        @csrf
        <h4 style="text-align: center;">REGISTRO DE VENTAS</h4>
        <br>
        <div class="row">
             <div class="col-md-4">
                <h5>Seleccione Producto</h5>
                <div class="input-group">
                    <select class="single-select" aria-label="Default select example" name="producto" id="producto" required>
                        @foreach ($productos as $p)
                        <option selected value="{{$p->id}}">{{$p->producto}}</option>
                        @endforeach    
                    </select>
                    <a class="btn btn-primary" id="btnNuevoProducto"><i class="bx bx-plus-circle end"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <h5>Precio Venta</h5>
                <input type="number" id="precio_venta" step="0.1" name="precio_venta" class="form-control" required>
            </div>
            <div class="col-md-2">
                <h5>Cantidad</h5>
                <input type="number" step="0.10" id="cantidad" name="cantidad" class="form-control" value="1.00" required>
            </div>
            <div class="col-md-3">
                <h5>Total</h5>
                <input type="number" id="total" name="total" class="form-control" readonly style="background-color: #e7e3e3">
            </div>

             <div class="col-md-4">
                <h5>Fecha</h5>
                <input type="date" class="form-control" name="fecha" id="fecha" readonly>
             </div>
             
             <br>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <button type="submit" class="btn btn-danger" style="font-size: 25px;">Guardar</button>
            </div>
        </div>
    </form>

    <div class="row row-cols-auto g-3">
        <div class="col">
            <div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formProducto">@csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Nuevo Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Nombre de Producto</label>
                                <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" maxlength="150" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <a type="submit" class="btn btn-primary" id="btnGuardarProducto">Guardar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection
@section('extra_js')
    <script src="../../../assets/plugins/select2/js/select2.min.js"></script>

    <script>

        $("#total").on("keyup",function () { 
            calculo_reverse_total();
        });

        $("#total").on("blur",function () { 
            $("#total").css("background-color","#e7e3e3");
            $("#total").prop("readonly",true);
            
        })

        $("#total").on("dblclick",function () { 
            $("#total").css("background-color","#ffffff");
            $("#total").prop("readonly",false);
            $("#total").focus();
         })

        $("#precio_venta").on("keyup",function (e) { 
            calculo_total();
        });
        $("#cantidad").on("keyup",function (e) { 
            calculo_total();
        });

        function calculo_reverse_total() { 
            total=$("#total").val();
            cantidad=$("#cantidad").val();
            precio=((parseFloat(total)/parseFloat(cantidad))).toFixed(2);
            $("#precio_venta").val(precio);
        }

        function calculo_total() { 
            precio=$("#precio_venta").val()
            cantidad=$("#cantidad").val()
            total = ((parseFloat(precio)*parseFloat(cantidad))).toFixed(2);
            $("#total").val(total);
        }

        $("#btnNuevoProducto").on("click",function (e) { 
            e.preventDefault();
            $("#modalProducto").modal('show');
        })

        $("#btnGuardarProducto").on("click",function (e) { 
            e.preventDefault();
            if ($("#nombre_producto").val()=='') {
                alert("Debe Ingresar un nombre de producto");
            }else{
                //Guardar
                ds=$("#formProducto").serialize()
                $.ajax({
                    type: "POST",
                    url: "/productos/store",
                    data: ds,
                    dataType: "json",
                    success: function (response) {
                        //reacargar el select nuevamente
                        $.ajax({
                            type: "GET",
                            url: "/productos/show",
                            dataType: "json",
                            success: function (response) {
                                $("#producto").empty();
                                response.forEach(element => {
                                    if (element.producto==$("#nombre_producto").val()) {
                                        $("#producto").append('<option selected value="'+element.id+'">'+ element.producto + '</option>').change();
                                    }else{
                                        $("#producto").append('<option value="'+element.id+'">'+ element.producto + '</option>');
                                    }
                                });
                            }
                        });

                    }
                });
            }
            $("#modalProducto").modal('hide');
         })


        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
            // font-size:$(this).data('font-size'),
        });
    </script>
  
    <script>
            // setInterval(muestrahora2, 1000);
            //     function muestrahora2() { 
            //         var hoy = new Date();
            //         hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
            //         document.getElementById("hora_reg").value = hora;    
            // }

            setTimeout(function(){
                $("#mensaje").css('display','none');
            }, 3000);

            var fecha = new Date();
            document.getElementById("fecha").value = fecha.toJSON().slice(0, 10);
    </script>
    {{-- <script src="../../../app_js/crud.js"></script> --}}
    
@endsection
