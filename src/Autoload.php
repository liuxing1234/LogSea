<?php
spl_autoload_register(function ($name) {
    $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $name);
    if (strpos($name, 'LogSea\\') === 0) {
        $class_file = __DIR__ . substr($class_path, strlen('LogSea')) . '.php';
    } else {
        if (empty($class_file) || !is_file($class_file)) {
            $class_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "$class_path.php";
        }
    }

    if (is_file($class_file)) {
        require_once($class_file);
        if (class_exists($name, false)) {
            return true;
        }
    }
    return false;
});