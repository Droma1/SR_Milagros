<section class="content">
    <br>
    <div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">Recursos</li>
                <li class="breadcrumb-item active" aria-current="page">Alumno</li>
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
                            <li class="list-group-item"><a href="recursosAdminD">Docentes</a></li>
                            <li class="list-group-item"><a href="recursosAdminA">Alumnos</a></li>
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
                            <h5>Recursos Publicados Alumnos</h5>
                        </div>
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
				      <tr>
				        <td>CAL001</td>
				        <td>Fernando</td>
				        <td><span class="icon-file-pdf"></span></td>
				        <td><span class="badge bg-info" style="text-shadow:0px 0px 2px #000;">Publicado</span></td>
				        <td><ul class="nav" style="text-shadow:0px 0px 2px #000;">
							  <li class="nav-item" style="margin-right:4px;">
                                <p class="nav-link badge bg-warning" data-bs-toggle="modal" data-bs-target="#modal_vista"><i class="icon-pencil"></i></p>
							  </li>
							  <li class="nav-item">
							    <p class="nav-link badge bg-danger" data-toggle="modal" data-target="#modal_info"><i class="icon-trash"></i></p>
                              </li>
                              
							    <div class="modal fade" id="modal_vista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
								
							</ul>
						</td>
				      </tr>
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