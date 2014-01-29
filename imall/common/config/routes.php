<?php

$router = new \Phalcon\Mvc\Router();

//Remove trailing slashes automatically
$router->removeExtraSlashes(true);
/**
 * Frontend routes
 */
$router->add('/', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

//Set 404 paths
$router->notFound(array(
    'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));
 

$router->add('/index/', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('/ajax/ajaximall', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaximall'
));

$router->add('/ads/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ads',
	'action' => 'index'
));

 

 
/*
$router->add('/play/{id:[0-9]+}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'catalog',
	'action' => 'play',
));

$router->add('/tag/{name}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'catalog',
	'action' => 'tag'
));

$router->add('/tag/{name}/{page:[0-9]+}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'catalog',
	'action' => 'tag'
));

$router->add('/search(/?)', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'catalog',
	'action' => 'search'
));

$router->add('/popular', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'catalog',
	'action' => 'popular'
));
*/
$router->add('/find', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Find',
	'action' => 'index'
));

 

/**
 * Backend routes
 */

return $router;
