<?php
    require_once "./Controller/alumnoController.php";
    $name = new alumnoController();
    $name_ = $name->perfil_alumno($_SESSION["tipo_user"]);
    $name_view = (array) $name_->fetch();
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view); 
?>
<section class="content">
    <br>
    <div class="container">
        <h5>Perfíl del Alumno</h5>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"><label for="" class="icon-user" style="font-size:200px;"></label></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombres: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[0];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Apellidos: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[1];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Usuario: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[2];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Grado: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[11];?> secundaria">
                        </div>
                        <div class="form-group">
                            <label for="">Sección: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[12];?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha de Registro: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[3];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Teléfono: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[4];?>">
                        </div>
                        <div class="form-group">
                            <label for="">DNI: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[5];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Código de Alumno: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[9];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Dirección: </label>
                            <input type="text" name="" class="form-control" readonly id="" value="<?php echo $name_view[6];?>">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>