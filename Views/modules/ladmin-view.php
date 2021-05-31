<?php
    require_once "./Controller/adminController.php";
    $admi = new administradorController();
    $recursos_ = $admi->lista_alumno_l();
    $cursos = $admi->grado_seccion();
    $cursos2 = $admi->grado_seccion();
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view); 
?>
<section class="content">
    <br>
    <div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item  " aria-current="page">Usuarios</li>
                <li class="breadcrumb-item active" aria-current="page">Administradores</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>Operaciones</h5>
                        </div>
                        <ul class="list-group list-group-flush option-list">
                            <li class="list-group-item"><a href="usuarios">Docentes</a></li>
                            <!--<li class="list-group-item"><a href="recursosAdminD">Docentes</a></li>-->
                            <!--<li class="list-group-item"><a href="recursosAdminA">Alumnos</a></li>-->
                            <li class="list-group-item"><a href="lalumno">Alumnos</a></li>
                            <li class="list-group-item"><a href="ladmin">administradores</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>Administradores</h5>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#add"><span class="icon-plus"></span> Registrar nuevo alumno</label>
                            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo Administrador</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <form action="<?php echo URL; ?>Ajax/admiAjax.php" data-form="" method="post" class="formAjax2" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                   
                                                    <div class="form-group">
                                                        <label for="">Nombre:</label>
                                                        <input type="text" name="nombre_e" id="cod_r" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Apellidos:</label>
                                                        <input type="text" name="apellido_e" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Correo:</label>
                                                        <input type="e-mail" name="user_d" id="titulo"  class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">clave:</label>
                                                        <input type="text" name="clave_d"   class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Fecha de Regsitro:</label>
                                                        <input type="e-mail" name="fecha_d" value="<?php echo date("Y-m-d"); ?>" readonly class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">teléfono:</label>
                                                        <input type="tel" name="fone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">dni:</label>
                                                        <input type="tel" name="dni_" class="form-control">
                                                    </div>                                                    
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Direccion:</label>
                                                        <input type="text" name="direc" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">genero:</label>
                                                        <select name="genero_" class="form-select">
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Femenino">Femenino</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Edad:</label>
                                                        <input type="text" name="edad_" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Grado:</label>
                                                        <select name="grado" class="form-select">
                                                            <?php while ($grade = $cursos->fetch()) {?>
                                                            <option value="<?php echo $grade[1];?>"><?php echo $grade[1];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Seccion:</label>
                                                        <select name="seccion" class="form-select">
                                                            <?php while ($grade2 = $cursos2->fetch()) {?>
                                                            <option value="<?php echo $grade2[4];?>"><?php echo $grade2[4];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <input type="submit" value="Registrar" class="btn btn-primary">
                                            </div>
                                            
                                            </div>
                                            <br>
                                            <div class="RespuestaAjax2"></div>
                                        </form>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-12">
				<div class="container table-responsive">
				  <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
				  <br>
				  <table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Cod. Administrador</th>
				        <th>Nombre</th>
				        <th>Apellido</th>
				        <th>Seccion</th>
				        <th>Opciones</th>
				      </tr>
				    </thead>
				    <tbody id="table_producto">
                    <?php $contador = 0; while($datos = $recursos_->fetch()){ $contador++;?>
				      <tr>
				        <td><?php echo $datos[9]; ?></td>
				        <td><?php echo $datos[0]; ?></td>
				        <td><?php echo $datos[1]; ?></td>
				        <td><?php echo $datos[12]; ?></td>
				        <td><ul class="nav" style="text-shadow:0px 0px 2px #000;">
							  <!--<li class="nav-item" style="margin-right:4px;">
                                <p class="nav-link badge bg-warning" data-bs-toggle="modal" data-bs-target="#modal_vista<?php echo $contador;?>"><i class="icon-pencil"></i></p>
							  </li>-->
                              <li class="nav-item" style="margin-right:4px;">
                                <p class="nav-link badge bg-warning"><i class="icon-pencil"></i></p>
							  </li>
							  <li class="nav-item">
							    <!--<p class="nav-link badge bg-danger"><i class="icon-trash"></i></p>-->
                              </li>
                              
							    <div class="modal fade" id="modal_vista<?php echo $contador; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content" style="text-shadow:none;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Docente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <br>
                                            
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                        <!--<form action="<?php echo URL; ?>Ajax/recursosAjax.php" data-form="" method="post" class="formAjax" enctype="multipart/form-data">-->
                                                <div class="form-group">
                                                    <label for="">Cambiar estado:</label>
                                                    <select name="estado" class="form-selct" style="max-width:150px">
                                                        <option value="Publicado">Publicado</option>
                                                        <option value="Observado">Observado</option>
                                                    </select>
                                                </div>

                                                <div class="form-group" style="display:none;">
                                                                    <label for="">det_recurso:</label>
                                                                    <input type="text" name="recurso" value="<?php echo $datos[9]; ?>" class="form-control" readonly>
                                                                </div>
                                                                <br>
                                                <div class="form-group">
                                                    <input type="submit" value="Cambiar Estado" class="btn btn-outline-success">
                                                </div>
                                                <br>
                                                <div class="RespuestaAjax"></div>
                                            <!--</form>-->
                                            <br>
                                            <br>
                                        </div>
                                        <br>
                                                <form action="<?php echo URL; ?>Ajax/recursosAjax.php" data-form="" method="post" class="formAjax2" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <h6>Pubicado por:</h6>
                                                                <div class="form-group" >
                                                                    <label for="">Nombre:</label>
                                                                    <input type="text" value="<?php echo $datos[0]; ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Apellidos:</label>
                                                                    <input type="text" value="<?php echo $datos[1]; ?>" id="cod_r" class="form-control" readonly>
                                                                </div>
                                                                <h6>Datos del Texto</h6>
                                                                <div class="form-group">
                                                                    <label for="">Archivo:</label>
                                                                    <input type="file" name="archivo_u" value="" id="PdfInp" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Título:</label>
                                                                    <input type="text" name="titulo_r_u" id="titulo" value="<?php echo $datos[5]; ?>"  class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Código:</label>
                                                                    <input type="text" name="codigo_u" id="titulo" value="<?php echo $datos[2]; ?>"  class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Grado:</label>
                                                                    <input type="text" readonly class="form-control" value="<?php echo $datos[4]; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">fecha de publicación:</label>
                                                                    <input type="text"  value="<?php echo $datos[6]; ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="form-group" style="display:none;">
                                                                    <label for="">det_recurso:</label>
                                                                    <input type="text" name="det_r" value="<?php echo $datos[9]; ?>" class="form-control" readonly>
                                                                </div>
                                                            <br>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                            <iframe id="view_pdf" src="<?php echo URL; ?>scripts/doc/<?php echo $datos[3]; ?>" frameborder="0" style="width:100%;height:100%;"></iframe>
                                                        </div>
                                                        <br>
                                                        <div class="modal-footer">
                                                            <input type="submit" value="Registrar" class="btn btn-primary">
                                                        </div>
                                                        
                                                        </div>
                                                        <div class="RespuestaAjax2"></div>
                                                    </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
								
							</ul>
						</td>
				      </tr>
                      <?php } ?>
				    </tbody>
				  </table>
				  
				</div>

				<script>
				$(document).ready(function(){
				  $("#entrada").on("keyup", function() {
				    var value = $(this).val().toLowerCase();
				    $("#table_producto tr").filter(function() {
				      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				    });
				  });
				});
				</script>

			</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>