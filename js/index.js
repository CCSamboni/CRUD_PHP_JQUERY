$(document).ready(function()
{  
    $.validator.addMethod(
        "regex_nombre",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Por favor ingrese un nombre correcto."
    ); 
    $("#formulario").validate({

        rules:{
            nombre:{
                required: true,
                minlength: 4,
                regex_nombre: /^([a-zA-ZùÙüÜäàáëèéïìíöòóüùúÄÀÁËÈÉÏÌÍÖÒÓÜÙÚñÑ ]+)$/
            },
            email:{
                required: true,
                email:true
            },
            sexo:{
                required: true,
            },
            areas_id:{
                required: true,
            },
            descripcion:{
                required: true,
            },
            roles_id:{
                required: true,
            }
        },
        messages:{
            nombre:{
                required: "Este campo es requerido",
                minlength: "Minimo 4 caracteres"
            },
            email:{                
                required: "Correo electrónico requerido",
                email: "El correo no es valido"
            },
            sexo:{
                required: "Seleccionar sexo"
            },
            areas_id:{
                required: "Seleccionar área de trabajo"
            },
            descripcion:{
                required: "Por favor, llenar la descripción"
            },
            roles_id:{
                required: "Por favor, seleccione un rol"
            }
                                  
        },   
        errorPlacement: function(error, element) {
            
            if (element[0].type == 'radio' || element[0].type == 'checkbox' ) {
                error.appendTo(element.parent());
            }
            else {
                error.insertAfter(element);
            }            
        }
        
    });
    $("#botonCrear").click(function(){
        $("#formulario")[0].reset();
        $(".modal-title").text("Crear empleado");
        $("#action").val("Crear");
        $("#operacion").val("Crear");
    });

    var dataTable = $('#datos_usuario').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: "obtener_registros.php",
            type: "POST"
        },
        "columnsDefs":[
            {
                "targets":[0, 3, 4],
                "orderable":false,
            },
        ],
        "language":{
        "decimal": "",
        "emptyTable": "No hay registros",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
            }
        }
    });

    //Aquí codigo inserción

    $(document).on('submit', '#formulario', function(event)
    {
        event.preventDefault();
        let data = new FormData(this);
        let sexo= $('input[name="sexo"] option:checked'); 
        let boletin = $('#boletin').prop("checked") ? 1 : 0;
        data.set("boletin",boletin);    
        let roles_id=$('input:checkbox[name="roles_id"]:checked').val();
        data.set("roles_id",roles_id);
        // console.log($("#areas_id").val());
        // console.log($("#boletin").val());        
        $.ajax({
                url: "crear.php",
                method: "POST",
                data: data,
                contentType: false,
                processData: false,
                success:function(data)
                {
                    alert(data);
                    $('#formulario')[0].reset();
                    $('#modalUsuario').modal('hide');
                    dataTable.ajax.reload();
                }
            });
    })
    //Funcionalidad editar.
    $(document).on('click', '.editar', function(){
        let id_empleado = $(this).attr("id");
        $.ajax({
            url: "obtener_registro.php",
            method: 'POST',
            data: {id_empleado:id_empleado},
            dataType:"json",
            success:function(data)
            {
                console.log(data);
                $('#modalUsuario').modal('show');
                $('#nombre').val(data.nombre);                                  
                $("#email").val(data.email);
                $('input[name="sexo"] option:checked').val(data.sexo);
                $('#areas_id').val(data.areas_id);
                $("#descripcion").val(data.descripcion);      
                $('input:checkbox[value=boletin]:checked').val(data.boletin);
                $('.modal-title').text("Editar Usuario");
                $('#id_empleado').val(id_empleado);                              
                $('#action').val("Editar");
                $('#operacion').val("Editar");                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            } 
        });               
    });

    //Funcionalidad borrar

    $(document).on('click', '.borrar', function(){
        var id_empleado = $(this).attr('id');                    
        if (confirm("Esta seguro de borrar este registro: "  + id_empleado)) 
        {
            $.ajax({
                url:"borrar.php",
                method:'POST',
                data:{id_empleado:id_empleado},
                success:function(data)
                {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
            
        }else{
            return false;
        }
    });
});                  