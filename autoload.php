<?php

function autoload() {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/src'));
    
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            require_once $file->getPathname();
        }
    }
}

autoload();

?>