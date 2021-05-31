<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }

    class alumnoController extends mainModel{
        public function perfil_alumno($codigo){
            $perfil = mainModel::consulta_simple("select * from perfil_alumno where cod_alumno = '".$codigo."';");
            return $perfil;
        }
    }
?>