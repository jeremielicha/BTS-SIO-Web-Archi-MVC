<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Quizz\Core\Controller\FastRouteCore;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Couche Controller
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', 'Quizz\Controller\HomeController');
    $route->addRoute('GET', '/lister', 'Quizz\Controller\Questionnaire\ListController');
    $route->addRoute('GET', '/detail/{id:\d+}', 'Quizz\Controller\Questionnaire\ViewController');
    $route->addRoute(['GET','POST'],'/etudiant','Quizz\Controller\Etudiant\ListController');
    $route->addRoute(['GET','POST'],'/etudiant/add','Quizz\Controller\Etudiant\AddController');
});
// Dispatcher -> Couche view
echo FastRouteCore::getDispatcher($dispatcher);