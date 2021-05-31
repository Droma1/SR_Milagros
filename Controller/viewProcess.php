<?php
    require_once "./Model/link.php";
    class viewProcess extends linkProcess{
        public function index(){
            return require_once "./Views/home.php";
        }

        public function view_Process(){
            if(isset($_GET['page'])){
                $ruta = explode("/",$_GET['page']);
                $resp = linkProcess::view_link($ruta[0]);
            }else{
                $resp = "home";
            }
            return $resp;
        }
    }
?>