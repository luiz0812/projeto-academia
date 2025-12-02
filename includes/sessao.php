<?php
session_start();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] =
bin2hex(random_bytes(32));
}
?>