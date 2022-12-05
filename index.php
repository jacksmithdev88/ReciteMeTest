<?php

require_once('Routes.php');
function __autoload($class)
{
    if (file_exists('./controllers/' . $class . '.php')) {
        require_once 'controllers/' . $class . '.php';
    }

    if (file_exists('./models/' . $class . '.php')) {
        require_once './models/' .$class. '.php';
    }

    if (file_exists('./views/' . $class . '.php')) {
        require_once './views/' .$class. '.php';
    }
}
