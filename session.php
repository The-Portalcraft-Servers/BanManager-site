<?php

session_start();
if (!$_SESSION['user'] && !$_SESSION['email']) {
    header('Location: ' . 'login.php');
}
?>