<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo COMPANY; ?></title>
    <?php include "./Views/scripts.php"; ?>
</head>
<body>

<?php 
$peticionAjax=false;
require_once "./Controller/viewProcess.php";
    $vista = new viewProcess();
    $vistaR = $vista->view_Process();

    session_start(['name'=>'SRM']);

    if(!isset($_SESSION['tipo_user']) && $vistaR!= null){
        $listaSimple=["inicio","index","home","recursos","lectura","404","search"];
        include "./Views/modules/inicio.php";
        //echo $vistaR;
        //echo "<br>";
        //echo $_GET['page'];
        //echo date('Y-m-d');
        
        if(isset($_GET['page'])){
            if(in_array($_GET['page'],$listaSimple)){
                
                switch ($vistaR) {
                    case "inicio":
                        //echo $vistaR;
                        include "./Views/modules/banner.php";
                        break;
                    case "home":
                            include "./Views/modules/banner.php";
                            break;
                    case "index":
                        include "./Views/modules/banner.php";
                        break;
                    case "404":
                        include "./Views/modules/404-view.php";
                        break;
                    default:
                        include $vistaR;
                        break;
                }
            }else{
                include "./Views/modules/404-view.php";
            }
        }else{
            if($vistaR == "home"){
                include "./Views/modules/banner.php";
            }
        }
    }else{
        if(isset($_SESSION['tipo_user'])){
            if(substr($_SESSION['tipo_user'],0,2) == "DC"){
                $listaD=["inicio","index","home","recursos","docente","lectura","404"];
                include "./Views/modules/docente.php";
                //echo $vistaR;
                //echo "<br>";
                //echo $_GET['page'];
                //echo date('Y-m-d');
                if(isset($_GET['page'])){
                    if(in_array($_GET['page'], $listaD)){
                        require_once $vistaR;
                    }else{
                        if($vistasR == null){
                            $_SESSION['tipo_user'] = null;
                            $_GET['page'] = "Out";
                            echo '<script> window.location="http://localhost/web/otorongo/" </script>';
                        }else{
                            require_once "./View/contents/docente-view.php";
                        }
                    }
                }else{
                    require_once "./View/contents/perfil-docente.php";
                }

            }else if(substr($_SESSION['tipo_user'],0,2) == "AL"){
                $listaA=["inicio","index","home","recursos","lectura","alumno","404","misrecursos","search"];
                include "./Views/modules/alumno.php";
                //echo $vistaR;
                //echo "<br>";
                //echo $_GET['page'];
                //echo date('Y-m-d');
                if(isset($_GET['page'])){
                    if(in_array($_GET['page'], $listaA)){
                        require_once $vistaR;
                    }else{
                        if($vistasR == null){
                            $_SESSION['tipo_user'] = null;
                            $_GET['page'] = "Out";
                            echo '<script> window.location="http://localhost/web/srmilagros/" </script>';
                        }else{
                            require_once "./View/contents/alumno-view.php";
                        }
                    }
                }else{
                    require_once "./View/contents/alumno-view.php";
                }
            }else if(substr($_SESSION['tipo_user'],0,2) == "AD"){
                $listaAD = ["inicio","index","home","recursos","lectura","admin","404","recursosAdmin","recursosAdminD","recursosAdminA","recursosAdminO","recursosAdminE","usuarios","lalumno","ladmin"];
                include "./Views/modules/admin.php";
                //echo $vistaR;
                //echo "<br>";
                //echo $_GET['page'];
                //echo date('Y-m-d');
                if(isset($_GET['page'])){
                    if(in_array($_GET['page'], $listaAD)){
                        require_once $vistaR;
                    }else{
                        if($vistasR == null && $_GET['page'] == "Out"){
                            $_SESSION['tipo_user'] = null;
                            $_GET['page'] = "Out";
                            echo '<script> window.location="http://localhost/web/srmilagros/" </script>';
                        }else{
                            require_once "./Views/modules/admin-view.php";
                        }
                    }
                }else{
                    require_once "./Views/modules/admin-view.php";
                }
            }
        }
    }

?>
    
</body>
</html>