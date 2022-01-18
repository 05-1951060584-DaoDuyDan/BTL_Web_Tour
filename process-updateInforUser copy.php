<?php
session_start();
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {
    if(isset($_POST['submitUpdateUser'])){
        $nameUser = $_POST['nameuser'];
        $surnameUser = $_POST['surnameuser'];
        $data = file_get_contents($_FILES['imgUserUpdate']['tmp_name']);
