<?php
session_start();

if(!isset($_SESSION['token'])){
    $_SESSION['token'] = bin2hex(random_bytes(32)); // TOKEN para segurança dos CRUDs
}

function verificarSessao(){
    if(!isset($_SESSION['logado']) || $_SESSION['logado'] != true){
        header("Location: ../../index.php?msg=acesso_negado");
        exit;
    }
}
?>
