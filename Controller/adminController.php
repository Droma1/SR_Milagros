<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }

    class administradorController extends mainModel{
        public function perfil_admi($codigo){
            $perfil = mainModel::consulta_simple("select * from perfil_admin where cod_admi = '".$codigo."';");
            return $perfil;
        }
        public function lista_alumno_l(){
            $lista = mainModel::consulta_simple("select * from perfil_alumno;");
            return $lista;
        }
        public function lista_admi_l(){
            $lista = mainModel::consulta_simple("select * from admin;");
            return $lista;
        }
        public function lista_docente_l(){
            $lista = mainModel::consulta_simple("select * from perfil_docente;");
            return $lista;
        }
        public function  lista_curso(){
            $lista = mainModel::consulta_simple("call curso();");
            return $lista;
        }
        public function grado_seccion(){
            $dato = mainModel::consulta_simple("call grado_seccion();");
            return $dato;
        }
        public function reg_alumno(){
            $nom = mainModel::clear_string($_POST['nombre_e']);
            $ape = mainModel::clear_string($_POST['apellido_e']);
            $user = mainModel::clear_string($_POST['user_d']);
            $clave = mainModel::clear_string($_POST['clave_d']);
            $fecha = mainModel::clear_string($_POST['fecha_d']);
            $phone = mainModel::clear_string($_POST['fone']);
            $dni = mainModel::clear_string($_POST['dni_']);
            $direc = mainModel::clear_string($_POST['direc']);
            $gen = mainModel::clear_string($_POST['genero_']);
            $edad = mainModel::clear_string($_POST['edad_']);
            $grado = mainModel::clear_string($_POST['grado']);
            $seccion = mainModel::clear_string($_POST['seccion']);
            if($nom!="" && $ape!="" && $user!="" && $clave!="" && $fecha!="" && $phone!="" && $dni!="" && $direc!="" && $gen!="" && $edad!="" && $grado!="" && $seccion!=""){

                    echo $nom,$ape,$user,$clave,$fecha,$phone,$dni,$direc,$gen,$edad,$grado,$seccion;
                try{
                    $respuesta = mainModel::consulta_simple("call registrar_alumno('".$nom."','".$ape."','".$user."','".$clave."','".$fecha."',".$phone.",".$dni.",'".$direc."','".$gen."',".$edad.",'".$grado."','".$seccion."');");
                
                }catch(Exeption $e){
                    echo "el error es: ".$e;
                }
                if($respuesta->rowCount() >=1){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Completado!",
                        "texto" => "Se registro exitosamente al Alumno",
                        "tipo" => "Terminado...",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Error inesperado",
                        "texto" => "No se completo el guardado del Registro",
                        "tipo" => "Failed...",
                        "clase" => "danger"
                    ];
                }
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Error inesperado",
                    "texto" => "Es necesario completar el registro",
                    "tipo" => "Failed...",
                    "clase" => "warning"
                ];
            }
            return mainModel::alerts($alerta);
        }
        public function reg_docente(){
            $nom = mainModel::clear_string($_POST['nombre_d']);
            $ape = mainModel::clear_string($_POST['apellido_d']);
            $user = mainModel::clear_string($_POST['user_d']);
            $clave = mainModel::clear_string($_POST['clave_d']);
            $fecha = mainModel::clear_string($_POST['fecha_d']);
            $phone = mainModel::clear_string($_POST['fone']);
            $dni = mainModel::clear_string($_POST['dni_']);
            $direc = mainModel::clear_string($_POST['direc']);
            $gen = mainModel::clear_string($_POST['genero_']);
            $edad = mainModel::clear_string($_POST['edad_']);
            $curso = mainModel::clear_string($_POST['grado']);
            $esp = mainModel::clear_string($_POST['esp']);
            $nivel = mainModel::clear_string($_POST['nivel']);

            if($nom!="" && $ape !="" && $user!="" && $clave!="" && $fecha!="" && $phone!="" && $dni!="" && $direc!="" && $gen!="" && $edad!="" && $curso!="" && $esp!="" && $nivel!=""){

                    //echo $nom,$ape,$user,$clave,$fecha,$phone,$dni,$direc,$gen,$edad,$curso,$esp,$nivel;
                try{
                    $respuesta = mainModel::consulta_simple("call registro_docente('".$nom."','".$ape."','".$user."','".$clave."','".$fecha."',".$phone.",".$dni.",'".$direc."','".$gen."',".$edad.",".$curso.",'".$esp."','".$nivel."');");
                
                }catch(Exeption $e){
                    echo "el error es: ".$e;
                }
                if($respuesta->rowCount() >=1){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Completado!",
                        "texto" => "Se registro exitosamente al docente",
                        "tipo" => "Terminado...",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Error inesperado",
                        "texto" => "No se completo el guardado del Registro",
                        "tipo" => "Failed...",
                        "clase" => "danger"
                    ];
                }
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Error inesperado",
                    "texto" => "Es necesario completar el registro",
                    "tipo" => "Failed...",
                    "clase" => "warning"
                ];
            }
            return mainModel::alerts($alerta);
        }
    }
?>