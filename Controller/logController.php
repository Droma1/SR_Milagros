<?php
    if($peticionAjax){
        require_once "../Model/logModel.php";
    }else{
        require_once "./Model/logModel.php";
    }

    class logController extends logModel{
        public function log_Controller(){
            $usuario = mainModel::clear_string($_POST['usuario_log']);
            $clave = mainModel::clear_string($_POST['clave_log']);

            if($clave != "" && $usuario!=""){
                $clave_c = mainModel::consulta_simple("select clave from persona where usuario = '$usuario';");
                if($clave_c->rowCount() >=1){
                    $verif_c = $clave_c->fetch();
                    $verif = (array) $verif_c;
                    #echo $verif['clave'];
                    $clave_v = $verif['clave'];
                    if($clave == $verif['clave']){
                        #echo $usuario;
                        #echo $clave;
                        session_start(['name'=>'SRM']);
                        $tipo_usuario = logModel::log_Model($usuario);
                        $tipo_usuario2 = (array) $tipo_usuario->fetch();
                        $_SESSION['tipo_user'] = $tipo_usuario2[0];
                        //$_SESSION['name_user'] = $tipo_usuario2[]
                        #echo $_SESSION['tipo_user'];
                        if(substr($_SESSION['tipo_user'],0,2) == "DC"){
                            $url = URL."docente";
                        }else if(substr($_SESSION['tipo_user'],0,2) == "AL"){
                            $url = URL."alumno";
                        }else{
                            $url = URL."admin";
                        }
                        return $urllocation = '<script> window.location="'.$url.'" </script>';
                        
                        
                    }else{
                        $alerta = [
                            "Alerta" => "simple",
                            "titulo" => "Ocurrio un error inesperado",
                            "texto" => "las Contraseñas no coinciden",
                            "tipo" => "error",
                            "clase" => "danger"
                        ];
                    }
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Ocurrio un error inesperado",
                        "texto" => "El usuario no se encuantra registrado",
                        "tipo" => "error",
                        "clase" => "danger"
                    ];
                }
                
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "No se completo los Campos",
                    "tipo" => "error",
                    "clase" => "warning"
                ];
            }
            return mainModel::alerts($alerta);
        }
    }
?>