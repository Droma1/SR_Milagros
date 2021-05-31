<?php
    if($peticionAjax){
        require_once "../Model/recursoModel.php";
    }else{
        require_once "./Model/recursoModel.php";
    }

    class recursoController extends recursoModel{
        public function grado_list(){
            $grado = recursoModel::lista_grado("select * from grado;");
            return $grado;
        }
        public function lista_recurso_p(){
            $recu = mainModel::consulta_simple("select * from recurso_view where estado = 'Publicado'");
            return $recu;
        }
        public function lista_recurso_o(){
            $recu = mainModel::consulta_simple("select * from recurso_view where estado = 'Observado'");
            return $recu;
        }
        public function lista_recurso_e(){
            $recu = mainModel::consulta_simple("select * from recurso_view where estado = 'Espera'");
            return $recu;
        }
        public function recurso_search($texto){
            $respuesta = mainModel::consulta_simple("select * from recurso_view where estado = 'Publicado' and (titulo like '%".$texto."%' or codigo_grado like '%".$texto."%' );" );
            return $respuesta;
        }
        public function view_recurso($dato){
            $consulta = mainModel::consulta_simple("select * from recurso_view where id_det_recurso = ".$dato.";");
            return $consulta;
        }
        public function updatee_Controller(){

            $estado = $_POST['estado'];
            $recurso = $_POST['recurso'];


            $consulta = mainModel::consulta_simple("update det_recurso set estado = '".$estado."' where id_det_recurso = ".$recurso."");
            if($consulta->rowCount() >=1 ){
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Completado!",
                    "texto" => "Se registro exitosamente el material educativo",
                    "tipo" => "Terminado...",
                    "clase" => "success"
                ];
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Error inesperado",
                    "texto" => "No se completo el cambio de estado",
                    "tipo" => "Failed...",
                    "clase" => "danger"
                ];
            }

            return mainModel::alerts($alerta);
        }
        public function update_Controller(){

            $cod = mainModel::clear_string($_POST['codigo_u']);            
            $titulo = mainModel::clear_string($_POST['titulo_r_u']);
            $det_r = mainModel::clear_string($_POST['det_r']);
            if(isset($_FILES['archivo_u']['name'])){
                $F1_name = $_FILES['archivo_u']['name'];
                //echo $F1_name;
                if($F1_name !=""){
                    $type=$_FILES['archivo_u']['type'];
                    $tmp_name = $_FILES['archivo_u']["tmp_name"];
                    $name = $_FILES['archivo_u']["name"];
                    $nuevo_path="../scripts/doc/".$name;
                    move_uploaded_file($tmp_name,$nuevo_path);
                    $array=explode('.',$nuevo_path);
                    $ruta1 = $nuevo_path;
                    $arch=$F1_name;
                    $ext= end($array);

                }else{
                    $arch = "";
                }
                if($cod!="" && $titulo!=""){
                    $datos_r = [
                        "codigo" => $cod,
                        "titulo" =>$titulo,
                        "id_detalle" => $det_r,
                        "pdf" => $arch
                    ];
                    $respuesta = recursoModel::update_recurso($datos_r);
                    if($respuesta->rowCount()>=1){
                        $alerta = [
                            "Alerta" => "simple",
                            "titulo" => "Completado!",
                            "texto" => "Se registro exitosamente el material educativo",
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
                        "titulo" => "Error!",
                        "texto" => "Es necesario completar el formulario para registrar los recursos",
                        "tipo" => "No completado!",
                        "clase" => "danger"
                    ];
                }
            }else{
                if($cod!="" && $titulo!=""){
                    $datos_r = [
                        "codigo" => $cod,
                        "titulo" =>$titulo,
                        "id_detalle" => $det_r,
                        "pdf" => ""
                    ];
                    $respuesta = recursoModel::update_recurso($datos_r);
                    if($respuesta->rowCount()>=1){
                        $alerta = [
                            "Alerta" => "simple",
                            "titulo" => "Completado!",
                            "texto" => "Se registro exitosamente el material educativo",
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
                        "titulo" => "Error!",
                        "texto" => "Es necesario completar el formulario para registrar los recursos",
                        "tipo" => "No completado!",
                        "clase" => "danger"
                    ];
                }
            }

            return mainModel::alerts($alerta);
        }
        public function reg_Controller(){
            $code_u = mainModel::clear_string($_POST['user']);
            $cod = mainModel::clear_string($_POST['cod_rec']);
            
            $titulo = mainModel::clear_string($_POST['titulo_r']);
            $grado = intval(mainModel::clear_string($_POST['grado']));
            $date = mainModel::clear_string($_POST['fecha_s']);
            
            //echo "el grado es: $grado-----------";
            $F1_name = $_FILES['archivo']['name'];
            //echo $F1_name;
            if($F1_name !=""){
                $type=$_FILES['archivo']['type'];
                $tmp_name = $_FILES['archivo']["tmp_name"];
                $name = $_FILES['archivo']["name"];
                $nuevo_path="../scripts/doc/".$name;
                move_uploaded_file($tmp_name,$nuevo_path);
                $array=explode('.',$nuevo_path);
                $ruta1 = $nuevo_path;
                $arch=$F1_name;
                $ext= end($array);

            }
            /*-------------name the file is arch----------------*/

            if($code_u != "" && $cod != "" && $arch!="" && $titulo != "" && $grado!="" && $date!=""){
                $datos_r = [
                    "Code_user" => $code_u,
                    "Code_resource" => $cod,
                    "file" => $arch,
                    "title" => $titulo,
                    "date_up" => $date,
                    "grade" => intval($grado)
                ];
                //echo var_dump($datos_r);
                $respuesta = recursoModel::reg_recurso($datos_r);
                //echo "<br>------------------";
                //echo var_dump($respuesta->fetch());
                //echo "<br>";
                if($respuesta->rowCount()>=1){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Completado!",
                        "texto" => "Se registro exitosamente el material educativo",
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
                    "titulo" => "Error!",
                    "texto" => "Es necesario completar el formulario para registrar los recursos",
                    "tipo" => "No completado!",
                    "clase" => "danger"
                ];
            }
            return mainModel::alerts($alerta);
        }
    }
?>