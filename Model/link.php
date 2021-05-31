<?php
    class linkProcess{
        protected function view_link($view){
            $listaSimple=["inicio","index","home","recursos","nosotros","lectura","search"];
            $listaD = ["inicio","index","home","recursos","lectura","docente"];
            $listaA = ["inicio","index","home","recursos","lectura","alumno","misrecursos","search"];
            $listaAD = ["inicio","index","home","recursos","lectura","admin","recursosAdmin","recursosAdminO","recursosAdminE","usuarios","lalumno","ladmin"];

            if(in_array($view,$listaSimple)){
                if(is_file("./Views/modules/".$view."-view.php")){
                    $cont = "./Views/modules/".$view."-view.php";
                }else{
                    $cont = "home";
                }
            }else if(in_array($view,$listaD)){
                if(is_file("./Views/modules/".$view."-view.php")){
                    $cont = "./Views/modules/".$view."-view.php";
                }else{
                    $cont = "docente";
                }
            }else if(in_array($view,$listaA)){
                if(is_file("./Views/modules/".$view."-view.php")){
                    $cont = "./Views/modules/".$view."-view.php";
                }else{
                    $cont = "alumno";
                }
            }else if(in_array($view,$listaAD)){
                if(is_file("./Views/modules/".$view."-view.php")){
                    $cont = "./Views/modules/".$view."-view.php";
                }else{
                    $cont = "admin";
                }
            }else if($view == "Out"){
                $cont = null;
            }else{
                $cont = "404";
            }
            return $cont;
        }
    }
?>