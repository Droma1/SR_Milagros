<section class="content banner">
    <div class="container">
    <br>
        <div class="row">
            <div class="col-md-8">
                <div class="content textos">
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1>I.E. Señor de los Milagros</h1>
                    <br>
                    <h5>Portal de recursos educativos digitales del nivel secundario</h5>
                    <h5>encuentra los recursos que necesitas para tus tareas.</h5>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card col rounded-0 p-3">
                        <div class="card-body">
                            <center><h1 class="icon-user" style="font-size:70px;"></h1></center>
                            <form action="" data-form="" method="POST" class="logForm" autocomplete="off">
                                <div class="form-group">
                                    <label for="">Correo Electrónico</label>
                                    <input type="e-mail" name="usuario_log" class="form-control" placeholder="example@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="clave_log" id="pass" class="form-control" placeholder="******">
                                </div>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="eye">
                                    <label class="form-check-label" for="eye" id="text_eye">Mostrar password</label>
                                    <input type="checkbox" class="form-check-input" id="eye2">
                                    <label class="form-check-label" for="eye2" id="text_eye2">Ocultar password</label>
                                </div>
                                <!--<div class="form-group" style="text-align:center;">
                                    <label for="">¿No tienes una Cuenta? <a href="registro">Registrate gratis</a></label>
                                </div>-->
                                <br>
                                <div class="form-group" style="text-align:center;">
                                    <input type="submit" value="Ingresar" id="verif" class="btn btn-outline-warning">
                                </div>
                                <div class="RespuestaAjax"></div>
                            </form>
                        </div>
                    </div>
            </div>
            
        </div>
        <br>
    </div>
</section>
<?php
            if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
                require_once "./Controller/logController.php";
                $log = new logController();
                echo $log->log_Controller();	
            }
        ?>