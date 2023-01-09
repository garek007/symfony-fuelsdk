<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
//session stuff here?Using slim middleware?

// Create Twig
$twig = Twig::create(__DIR__.'/views', ['cache' => false]);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

$what = explode('/',$_SERVER['REQUEST_URI']);

$nm = '\App\Action\\'.ucfirst($what[1]);
$class = new $nm();
//$app->get('/', \App\Action\HomeAction::class);
//$app->get('/loadit/{externalkey}', \App\Action\LoadDataExtension::class);
$app->get($_SERVER['REQUEST_URI'], $class);
//$app->get('/', function (Request $request, Response $response, $args) {
            //$response->getBody()->write("Hello world!");
            //echo $_SERVER['REQUEST_URI'];
            //return $app['twig']->render('index.twig');
    //$view = Twig::fromRequest($request);
    //return $view->render($response, 'index.twig');
//});

$app->run();