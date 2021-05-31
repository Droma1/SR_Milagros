<?php
    $peticionAjax = true;
    require_once "../Config/config.php";
    if(isset($_POST['user']) && isset($_POST['titulo_r'])){
        require_once "../Controller/recursoController.php";
        $recurso = new recursoController();
        if(isset($_POST['user']) && isset($_POST['titulo_r'])){
            echo $recurso->reg_Controller();
        }
        
    }else if(isset($_POST['codigo_u']) && isset($_POST['titulo_r_u'])){
        require_once "../Controller/recursoController.php";
        $recurso = new recursoController();
        if(isset($_POST['codigo_u']) && isset($_POST['titulo_r_u'])){
            echo $recurso->update_Controller();
        }
    }else if(isset($_POST['recurso']) && isset($_POST['estado'])){
        require_once "../Controller/recursoController.php";
        $recurso = new recursoController();
        if(isset($_POST['recurso']) && isset($_POST['estado'])){
            echo $recurso->updatee_Controller();
        }
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.URL.'";</script>';
    }
?>