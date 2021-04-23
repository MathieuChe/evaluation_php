<?php

ini_set('display_errors', '1');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

// example.com/web/front.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Simplex\Framework;

require_once '../config.php';

$request = Request::createFromGlobals();
if($request->getMethod() === Request::METHOD_OPTIONS) {
    $response = new Response();
    $response->send();
    exit();
}

$request->attributes->add(['_app_root' => __DIR__ . '/../src/']);

$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();

$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);

session_start();

$response = $framework->handle($request);

$response->send();