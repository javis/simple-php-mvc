<?php
/**
 * App single point entry
 */

// include composer autoload and Framework bootstrap
require_once '../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Whoops\Run as WhoopsRun;
use Whoops\Handler\PrettyPageHandler as WhoopsPrettyPageHandler;

// init error handler
$whoops = new WhoopsRun();
$handler = new WhoopsPrettyPageHandler();
$whoops->pushHandler($handler)->register();

// Start a Session
if( !session_id() ) @session_start();

// set up the router
$router = new RouteCollector();

include APP_ROOT.'/app/routes.php'; // include the list of routes

// fixes $_GET variable after URL rewrite
$parsed_url = parse_url($_SERVER['REQUEST_URI']);
parse_str($parsed_url['query']??'', $output);
$_GET = array_merge($_GET, $output);
if (!isset($_GET['url'])){
    $_GET['url'] = '';
}

// dispatch URL handler
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_GET['url']);

// Print out the value returned from the dispatched function
echo $response;
