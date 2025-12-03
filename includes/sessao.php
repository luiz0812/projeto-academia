<?php
// includes/sessao.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Exemplo: para marcar usuário logado
// $_SESSION['usuario_logado'] = true; // quando fizer login

// Função helper para mensagens flash
function flash($key = null, $value = null) {
    if ($key === null) return $_SESSION['flash'] ?? [];
    if ($value === null) {
        $val = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $val;
    }
    $_SESSION['flash'][$key] = $value;
}
?>
