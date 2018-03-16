<?php
/**
 * Sets the APP environment
 */
use Illuminate\Database\Capsule\Manager as Capsule;
use Matomo\Ini\IniReader;
use App\Controllers\BaseController;

// Root path for inclusion.
define('APP_ROOT', dirname(__DIR__));

// read config file
$reader = new IniReader();
$dbconfig = $reader->readFile(APP_ROOT.'/app/config/database.ini');

// set up DB connection
$capsule = new Capsule();
$capsule->addConnection($dbconfig);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// set up Twig templates path
$loader = new Twig_Loader_Filesystem(APP_ROOT.'/app/views');
$twig = new Twig_Environment($loader);
BaseController::setTwig($twig);
