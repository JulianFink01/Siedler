<?php
    session_start();
    require_once("entities/db.php");
    require_once("entities/user.php");
    require_once('controller.php');

    $aktion = isset($_GET['aktion'])?$_GET['aktion']:'login';

    $controller = new Controller();

     if(method_exists($controller, $aktion)){
        $controller->run($aktion);
     }else{
       $controller->run("login");
     }


?>
