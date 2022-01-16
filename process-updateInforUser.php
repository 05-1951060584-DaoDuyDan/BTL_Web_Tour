<?php
session_start();
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {
    
}
?>