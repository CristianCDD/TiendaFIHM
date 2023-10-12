<?php
    $productos = unserialize($_COOKIE['productos'] ?? '');
    echo json_encode($productos ?: []); // Devuelve una matriz vacía si $productos es falso
?>
