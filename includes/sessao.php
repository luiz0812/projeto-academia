<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['usuario_logado'])) {
   header("Location: /projeto-academia/login.php");
   exit();
}
?>
