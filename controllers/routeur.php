<?php
    if ($uri === '/equipements/create') {
        $controller = new EquipementController();
        $controller->create();
        exit;
    }
?>
