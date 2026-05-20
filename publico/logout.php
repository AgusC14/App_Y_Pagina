<?php
// publico/logout.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Limpiamos todas las variables de la sesión
$_SESSION = array();

// 2. Si se desea destruir la sesión completamente, eliminamos también la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruimos la sesión en el servidor
session_destroy();

// 4. Redirigimos al inicio de manera limpia
header("Location: index.php");
exit();