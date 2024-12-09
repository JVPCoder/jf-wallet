<?php 
    require_once("layout/head.php");

    require_once('layout/header.php');
    
    if(file_exists("views/${recurso}.view.php")){
        include("views/${recurso}.view.php");

    } else {
        include("layout/404.php");
    }  