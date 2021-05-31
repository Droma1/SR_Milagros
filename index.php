<?php
    require_once "./Config/config.php";
    require_once "./Controller/viewProcess.php";

    $views = new viewProcess();
    $views->index();
?>