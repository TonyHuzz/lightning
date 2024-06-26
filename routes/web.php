<?php

foreach (glob(__DIR__ . '/backend/*.php') as $routeFile) {
    require $routeFile;
}

require __DIR__ . '/auth.php';
