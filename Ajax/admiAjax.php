<?php
    $peticionAjax = true;
    require_once "../Config/config.php";
    if(isset($_POST['nombre_d']) && isset($_POST['apellido_d'])){
        require_once "../Controller/adminController.php";
        $insLog = new administradorController();
        if(isset($_POST['nombre_d']) && isset($_POST['apellido_d'])){
            echo $insLog->reg_docente();
        }
    }else if(isset($_POST['nombre_e']) && isset($_POST['apellido_e'])){
        require_once "../Controller/adminController.php";
        $insLog = new administradorController();
        if(isset($_POST['nombre_e']) && isset($_POST['apellido_e'])){
            echo $insLog->reg_alumno();
        }
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.URL.'";</script>';
    }
?>