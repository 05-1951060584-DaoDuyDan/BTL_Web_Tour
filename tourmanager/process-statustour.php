<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_GET['tourcode']) && isset($_GET['status'])){

    }else if(isset($_GET['tourcode']) && isset($_GET['statuslock'])){

    }else{
        
    }
}
?>