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

$router->add('/epins/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'epins',
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



$router->add('/users/register', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'register',
));

$router->add('/users/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'index',
));

$router->add('/users/logout', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'logout',
));

$router->add('/users/login', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'login',
));

$router->add('/users/forgotpassword', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'forgotpassword',
));

$router->add('/wallets/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Wallets',
	'action' => 'index',
));

$router->add('/wallets/add', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Wallets',
	'action' => 'add',
));

$router->add('/transactions/histories', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Transactions',
	'action' => 'histories',
));

$router->add('/settings/profile', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Settings',
	'action' => 'profile',
));

$router->add('/settings/edit', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Settings',
	'action' => 'edit',
));

$router->add('/activations/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Activations',
	'action' => 'index',
));

$router->add('/messages/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'index',
));

$router->add('/messages/sentitems', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'sentitems',
));

$router->add('/messages/view/{id:[0-9]+}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'view',
));

$router->add('/messages/compose', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'compose',
));

$router->add('/imall/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'index',
));

$router->add('/imall/myads', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'myads',
));

$router->add('/imall/add', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'add',
));

$router->add('/imall/steptwo', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'steptwo',
));

$router->add('/imall/finish/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'finish',
));

$router->add('/imall/view/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'view',
));

$router->add('/ajax/ajaximall', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaximall',
));

$router->add('/imall/edit/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'edit',
));

$router->add('/epins/transfer', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'transfer',
));

$router->add('/epins/confirmation', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'confirmation',
));

$router->add('/graph/username', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Graph',
	'action' => 'username',
));

$router->add('/iprihatin/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Iprihatin',
	'action' => 'index',
));

$router->add('/iprihatin/view/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Iprihatin',
	'action' => 'view',
));

$router->add('/ajax/ajaxuserid', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaxuserid',
));

$router->add('/ajax/ajaxusername', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaxusername',
));

$router->add('/ajax/ajaxcategory', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaxcategory',
));

/*
$router->add('/play/{id:[0-9]+}', array(   ajaxcategory
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
	'controller' => 'find',
	'action' => 'index'
));

$router->add('/about', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'about',
	'action' => 'index'
));

/**
 * Backend routes
 */

return $router;
