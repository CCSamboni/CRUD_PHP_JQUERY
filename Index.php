<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel= "stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel= "stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/26e6c93e8c.js" crossorigin="anonymous"></script>
    <br />
    <br />
    <title>PRUEBA TÉCNICA</title>
</head>
  <body>
      <div class="container fondo">
        <h1 class="text-left">Lista de empleados</h1>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <button type="button" class="btn btn-primary w-80" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                        <i class="fa-solid fa-user-plus"></i> Crear    
                        </button>
                </div>
            </div>
        </div>    
        <br />
        <div class="table-responsive">
            <table id="datos_usuario" class="table table-bordered table-striped" rows="6" cols="50">
                <thead>
                    <tr>                        
                        <th><i class="fa-solid fa-user"></i> Nombre</th> 
                        <th><i class="fa-solid fa-at"></i> Email</th>
                        <th class="d-flex align-items-end"><i class="fa-solid fa-venus-mars me-1 mb-1"></i> Sexo</th>                        
                        <th><i class="fa-solid fa-briefcase"></i> Area</th>
                        <th><i class="fa-solid fa-envelope"></i> Boletín</th>
                        <th><i class="fa-solid fa-pen-to-square"></i> Modificar</th>
                        <th><i class="fa-solid fa-trash-can"></i> Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear empleado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>               
                    <form method="POST" id="formulario" enctype="multipart/form-data"> 
                        <div class="modal-content">
                            <div class="modal-body">
                                <div>
                                    <h6 class= "bg-info p-2 text-primary bg-opacity-25 border border-info border-start-0 rounded-end"> Los campos con (*) son obligatorios <h6>
                                </div>                                  
                                <div class="form-group row">                                     
                                    <label for="nombre" class="col-3 col-form-label"><p  class="to-rigth">Nombre completo * </p></label>
                                        <div class="col-9">
                                            <input type="text" name="nombre" id="nombre" pattern = "([A-Z])\w+" class="form-control" placeholder="Nombre completo del empleado">
                                            <br>
                                        </div>
                                    
                                    <label for="email" class="col-3 col-form-label"><p  class="to-rigth">Correo electrónico * </p></label>                                    
                                        <div class="col-9">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico">
                                            <br>
                                        </div>

                                    <label class="col-3 col-form-label"><p  class="to-rigth">Sexo * </p></label>
                                        <div class="col-9">
                                            <input type="radio" id="Masculino" name="sexo" value="M">
                                            <label for="Masculino">Masculino</label><br>
                                            <input type="radio" id="Femenino" name="sexo" value="F">
                                            <label for="Femenino">Femenino</label><br>
                                            <div id="sexoError">                                                
                                            </div>
                                        </div>
                                        <br>
                                    <div class="mt-1 row">
                                        <label for="areas_id" class="col-3 col-form-label"><p  class="to-rigth">Área * </p></label> 
                                            <div class="col-9 ps-3">
                                                <select name="areas_id" id="areas_id">
                                                <option value="1" selected>Administración</option>
                                                <option value="2">Ventas</option>
                                                <option value="3">Calidad</option>
                                                <option value="4">Producción</option>
                                                </select>
                                                <br>
                                            </div>                                   
                                    </div>                                                                    
                                    <label for="descripcion" class="col-3 col-form-label "><p  class="to-rigth">Descripción * </p></label>                                    
                                        <div class="col-9">
                                            <textarea id="descripcion" name="descripcion" class="descripcion" rows="4" cols="50" placeholder="Descripción de la experiencia del empleado"></textarea>
                                            <br>
                                        </div>
                                    <label for="boletin" class="col-3 col-form-label"></label>                                    
                                        <div class="col-9">
                                            <input type="checkbox" name="boletin" id="boletin" > Deseo recibir boletin informativo                                             
                                            <br>                                         
                                        </div>   

                                    <label for="roles" class="col-3 col-form-label"><p  class="to-rigth">Roles * </p></label>                                    
                                        <div class="col-9">
                                            <input type="checkbox" name="roles_id" value="1"> Profesional de proyectos - Desarrollador<br>
                                            <input type="checkbox" name="roles_id" value="2"> Gerente estratégico<br>
                                            <input type="checkbox" name="roles_id" value="3"> Auxiliar administrativo<br>
                                            <br>
                                            <div id="rolesError"></div>
                                        </div>                             
                                </div>
                             </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id_empleado" id="id_empleado">
                                <input type="hidden" name="operacion" id="operacion">  <!-- Registrar, editar o borrar --> 
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Crear"> <!-- Funcionalidad de procesar --> 
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="js/index.js"></script>
    </body>
</html>
