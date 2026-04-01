<?php

    spl_autoload_register(function($className){
        $basePath = __DIR__ . "/App/";
        $prefix = "App\\";

        $len = strlen($prefix);

        if(substr_compare($className, $basePath, 0, $len) !== 0){
            return;
        }

        $relativeClass = substr($className, $len);

        $file = $basePath . str_replace('\\', '/', $relativeClass) . '.php';

        if(file_exists($file)){
            require $file;
        }
        });