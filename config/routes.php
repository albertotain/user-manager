<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Router;

Router::plugin(
        'UserManager',
        function ($routes) {
          $routes->get('/login', ['controller' => 'Users', 'action' => 'login']);
          $routes->post('/login', ['controller' => 'Users', 'action' => 'login']);
          $routes->get('/logout', ['controller' => 'Users', 'action' => 'logout']);
          $routes->get('/forgot-password', ['controller' => 'Users', 'action' => 'forgotPassword']);
          $routes->post('/forgot-password', ['controller' => 'Users', 'action' => 'forgotPassword']);
          $routes->get('/reset-password/:token', ['controller' => 'Users', 'action' => 'resetPassword']);
          $routes->post('/reset-password/:token', ['controller' => 'Users', 'action' => 'resetPassword']);

          $routes->get('/', ['controller' => 'Users']);
          $routes->get('/add', ['controller' => 'Users', 'action' => 'add']);
          $routes->put('/edit/:id', ['controller' => 'Users', 'action' => 'edit']);
        },
        function ($routes) {
          $routes->get('/', ['controller' => 'Roles', 'action' => 'index']);
          $routes->get('/add', ['controller' => 'Roles', 'action' => 'add']);
          $routes->put('/edit/:id', ['controller' => 'Roles', 'action' => 'edit']);
          $routes->put('/delete/:id', ['controller' => 'Roles', 'action' => 'delete']);
      }
);
