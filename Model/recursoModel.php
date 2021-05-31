<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }

    class recursoModel extends mainModel{
        protected function lista_grado(){
            $sql = mainModel::consulta_simple("select * from grado;");
            $sql->execute();

            return $sql;
        }
        protected function update_recurso($dato){
            $sql = mainModel::conectar()->prepare("call actualizar_r(:Codigo,:Titulo,:Id,:Formato);");
            $sql->bindParam(":Codigo",$dato["codigo"]);
            $sql->bindParam(":Titulo",$dato["titulo"]);
            $sql->bindParam(":Id",$dato["id_detalle"]);
            $sql->bindParam(":Formato",$dato["pdf"]);

            $sql->execute();

            return $sql;
        }
        protected function reg_recurso($dato){
            $sql = mainModel::conectar()->prepare("call registro_recurso(:C_u,:C_r,:F,:T,:F_s,:G);");
            //echo var_dump($dato);
            $sql->bindParam(":C_u", $dato["Code_user"]);
            $sql->bindParam(":C_r",$dato["Code_resource"]);
            $sql->bindParam(":F",$dato['file']);
            $sql->bindParam(":T",$dato['title']);
            $sql->bindParam(":F_s",$dato["date_up"]);
            $sql->bindParam(":G",$dato["grade"]);

                $sql->execute();
            
            return $sql;
        }
    }
?>