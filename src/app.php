<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('home', new Routing\Route('/', [
    '_controller' => 'eCommerce\Controller\AppController::index',
], [], [], '', [], ['GET']));

$routes->add('security_register', new Routing\Route('/register', [
    '_controller' => 'eCommerce\Controller\UserController::register',
], [], [], '', [], ['GET', 'POST']));

$routes->add('security_login', new Routing\Route('/login', [
    '_controller' => 'eCommerce\Controller\UserController::login',
], [], [], '', [], ['GET', 'POST']));

$routes->add('security_logout', new Routing\Route('/logout', [
    '_controller' => 'eCommerce\Controller\UserController::logout',
], [], [], '', [], ['GET']));

$routes->add('security_profil', new Routing\Route('/profil', [
    '_controller' => 'eCommerce\Controller\UserController::profil',
], [], [], '', [], ['GET', 'POST']));

$routes->add('security_delete_profile', new Routing\Route('/delete_profile', [
    '_controller' => 'eCommerce\Controller\UserController::deleteProfile',
], [], [], '', [], ['POST']));

$routes->add('create_product', new Routing\Route('/myProducts', [
    '_controller' => 'eCommerce\Controller\ProductController::createProduct',
], [], [], '', [], ['GET', 'POST']));

$routes->add('delete_product', new Routing\Route('/delete_product', [
    '_controller' => 'eCommerce\Controller\ProductController::deleteUserProduct',
], [], [], '', [], ['POST']));

$routes->add('update_product', new Routing\Route('/update_product', [
    '_controller' => 'eCommerce\Controller\ProductController::updateUserProduct',
], [], [], '', [], ['POST']));

$routes->add('get_user_products', new Routing\Route('/myProducts/list', [
    '_controller' => 'eCommerce\Controller\ProductController::getUserAllProducts',
], [], [], '', [], ['GET']));

$routes->add('home_home', new Routing\Route('/home', [
    '_controller' => 'eCommerce\Controller\ProductController::index',
], [], [], '', [], ['GET']));

return $routes;
