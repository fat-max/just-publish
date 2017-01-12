<?php
require_once 'config.php';
error_reporting(DEBUG_LEVEL);

require_once __DIR__.'/src/JustPublish/Autoload/Autoloader.php';

use JustPublish\Autoload\Autoloader;
$loader = Autoloader::register();
$loader->addNamespace('JustPublish', __DIR__.'/src/JustPublish');
$loader->addNamespace('App', __DIR__.'/App');

// init kernel with controller namespace
$kernel = new JustPublish\Kernel('App\Controller');

$kernel->run();

$kernel->terminate();

// $options = array('cost' => 11);
// echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT, $options);