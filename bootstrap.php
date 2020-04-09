<?php
// bootstrap.php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."/src/Entity");
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'host' => '127.0.0.1',
    'port' => '3306',
    'password' => 'vuanh123',
    'dbname'   => 'bookstore',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$config->addEntityNamespace('Diva', 'Diva\Entity');

$entityManager = EntityManager::create($dbParams, $config);
