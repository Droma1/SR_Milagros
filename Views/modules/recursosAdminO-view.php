<?php
    require_once "./Controller/recursoController.php";
    $name = new recursoController();
    $recursos_ = $name->lista_recurso_o();
    $name_ = $name->grado_list();
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view); 
?>
<section class="content">
    <br>
    <div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Recursos</li>
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
                            <li class="list-group-item"><a href="recursosAdmin">Publicados</a></li>
                            <!--<li class="list-group-item"><a href="recursosAdminD">Docentes</a></li>-->
                            <!--<li class="list-group-item"><a href="recursosAdminA">Alumnos</a></li>-->
                            <li class="list-group-item"><a href="recursosAdminO">Observados</a></li>
                            <li class="list-group-item"><a href="recursosAdminE">En espera</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>Recursos Observados</h5>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
				<div class="container table-responsive">
				  <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
				  <br>
				  <table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Cod. Recurso</th>
				        <th>Título</th>
				        <th>icono</th>
				        <th>Estado</th>
				        <th>Opciones</th>
				      </tr>
				    </thead>
				    <tbody id="table_producto">
                    <?php $contador = 0; while($datos = $recursos_->fetch()){ $contador++;?>
				      <tr>
				        <td><?php echo $datos[2]; ?></td>
				        <td><?php echo $datos[5]; ?></td>
				        <td><span class="icon-file-pdf"></span></td>
				        <td><span class="badge bg-danger" style="text-shadow:0px 0px 2px #000;"><?php echo $datos[8]; ?></span></td>
				        <td><ul class="nav" style="text-shadow:0px 0px 2px #000;">
							  <li class="nav-item" style="margin-right:4px;">
                                <p class="nav-link badge bg-warning" data-bs-toggle="modal" data-bs-target="#modal_vista<?php echo $contador;?>"><i class="icon-pencil"></i></p>
							  </li>
							  <li class="nav-item">
							    <!--<p class="nav-link badge bg-danger"><i class="icon-trash"></i></p>-->
                              </li>
                              
							    <div class="modal fade" id="modal_vista<?php echo $contador; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content" style="text-shadow:none;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $datos[5]; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <br>
                                            
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                        <form action="<?php echo URL; ?>Ajax/recursosAjax.php" data-form="" method="post" class="formAjax" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="">Cambiar estado:</label>
                                                    <select name="estado" class="form-selct" style="max-width:150px">
                                                        <option value="Observado">Observado</option>
                                                        <option value="Publicado">Publicado</option>                                                        
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
                                            </form>
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