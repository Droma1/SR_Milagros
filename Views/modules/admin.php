<?php
    require_once "./Controller/adminController.php";
    $name = new administradorController();
    $name_ = $name->perfil_admi($_SESSION["tipo_user"]);
    $name_view = (array) $name_->fetch();
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view); 
?>
<section class="content head_home">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"><img src="<?php echo URL ?>scripts/img/logo.png" style="max-width:60px;" alt="" srcset=""></li>
                    <li class="list-group-item"><h3 style="margin-bottom:0px;"><?php echo COMPANY; ?></h3>
                    <h4>Colegio</h4></li>
                </ul>
            </div>
            <div class="col-md-6 text-end view-none">
                <div class="form-group" style="transform:translateY(70%);">
                    <label for=""><span class="icon-user"></span> <?php echo $name_view[0]; ?></label>
                </div>
            </div>
        </div>
    </div>
    <div class="container menu-cont">
        <nav class="navbar menu">
            <a class="icon-menu btn-menu"></a>
            <div class="container-fluid enlaces">
                <a class="link" href="admin"><span class="icon-home"></span> Perfíl</a>
                <a class="link" href="recursosAdmin"><span class="icon-folder-open"></span> Recursos</a>
                <a class="link" href="usuarios"><span class="icon-contacts"></span> Usuarios</a>
                <a class="link" href="Out"><span class="icon-logout"></span> salir</a>
            </div>
        </nav>
    </div>
</section>