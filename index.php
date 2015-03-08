<?php

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require('vendor/autoload.php');
}

// load application config (error reporting etc.)
require('application/configs/application.php');

// start the application
$app = new \Core\Application();