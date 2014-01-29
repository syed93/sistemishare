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

$router->add('/ads/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ads',
	'action' => 'index'
));


$router->add('/posts/new', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Posts',
	'action' => 'index',
));

$router->add('/posts/steptwo', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Posts',
	'action' => 'steptwo',
));

$router->add('/imall/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'index',
));

$router->add('/imall/view/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Imall',
	'action' => 'view',
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

$router->add('/users/view', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'view',
));

$router->add('/users/profile/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Users',
	'action' => 'profile',
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

$router->add('/insuran/manage', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'manage',
));

$router->add('/insuran/quotation', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'quotation',
));

$router->add('/insuran/kiv', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'kiv',
));

$router->add('/insuran/all', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'all',
));

$router->add('/insuran/addtokiv/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'addtokiv',
));

$router->add('/insuran/done', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'done',
));

$router->add('/insuran/update/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'update',
));

$router->add('/commissions/payout', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Commissions',
	'action' => 'payout',
));
$router->add('/insuran/renew/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Insuran',
	'action' => 'renew',
));


$router->add('/epins/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'index',
));

$router->add('/epins/add', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'add',
));

$router->add('/epins/transfer', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'transfer',
));

$router->add('/epins/viewuseripin', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'viewuseripin',
));

$router->add('/epins/track', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Epins',
	'action' => 'track',
));

$router->add('/reports/index', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Reports',
	'action' => 'index',
));

$router->add('/reports/renewals', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Reports',
	'action' => 'renewals',
));

$router->add('/reports/payout', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Reports',
	'action' => 'payout',
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

$router->add('/ajax/ajaxusername', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaxusername',
));

$router->add('/ajax/ajaximall', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaximall',
));

$router->add('/ajax/ajaxuserid', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Ajax',
	'action' => 'ajaxuserid',
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

$router->add('/messages/preview', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'preview',
));

$router->add('/messages/compose', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'compose',
));


$router->add('/messages/view/{id}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Messages',
	'action' => 'view',
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

$router->add('/iprihatin/edit/{slug}', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Iprihatin',
	'action' => 'edit',
));


$router->add('/iprihatin/add', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Iprihatin',
	'action' => 'add',
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


$router->add('/graph/username', array(
	'module' => 'frontend',
	'namespace' => 'JunMy\Frontend\Controllers\\',
	'controller' => 'Graph',
	'action' => 'username',
));

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
