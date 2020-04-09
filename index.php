<?php
require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

//use Diva\Repository\ProductRepository;
use Diva\Utils\DependencyInjector;
use Diva\Core\Config;

use Diva\Core\Router;
use Diva\Core\Request;

$config = new Config();
$dbConfig = $config->get('db');

////////////
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader, [
   //'cache' => '/path/to/compilation_cache',
]);

////////////
$paths = array(__DIR__."/src/Entity");
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host' => '127.0.0.1',
    'port' => '3306',
    'dbname'   => 'bookstore',
    //'user'     => 'root',
    //'password' => 'vuanh123',
    'user'     => $dbConfig['user'],
    'password' => $dbConfig['password'],
    
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$config->addEntityNamespace('Diva', 'Diva\Entity');
$entityManager = EntityManager::create($dbParams, $config);
//$entityManager->getConfiguration()->addEntityNamespace('Diva', 'Diva\Entity');

$di = new DependencyInjector();
$di->set('entityManager', $entityManager);
//$di->set('Utils\Config', $config);
$di->set('twig', $twig);
//$di->set('Logger', $log);

//$user = $entityManager->getRepository('Diva:User')->findOneById(1);
//$user = $entityManager->find('Diva\Entity\User', 1);
/*
$user = $entityManager->find('Diva:User', 1);
$user->setName('Hong2');
$entityManager->persist($user);
$entityManager->flush();
*/

// $repo = new ProductRepository($di->get('entityManager'));

// $result = $repo->getProductFeatures(1);

// echo $di->get('twig')->render('product.twig', [
//    'result' => $result
// ]);

$router = new Router($di);
$response = $router->route(new Request());
echo $response;