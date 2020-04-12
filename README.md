# UserManager plugin for CakePHP 4

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require albertotain/UserManager
```

## Configuration
### Configura en: config/app_local.php

    'EmailTransport' => [
        'default' => [
            'host' => '',
            'port' => 465,
            'username' => '',
            'password' => '',
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],

### Configura en el `initialize()`: src/Controller/AppController
```bash
 $this->loadComponent('FormProtection');

 $this->loadComponent('Auth', [
		'loginAction' => [
			'plugin' => 'UserManager',
			'controller' => 'Users',
			'action' => 'login',
            'prefix' => false
		],
		'loginRedirect' => [
			'plugin' => 'UserManager',
			'controller' => 'Users',
			'action' => 'index',
            'prefix' => false
		],
		'logoutRedirect' => [
			'plugin' => 'UserManager',
			'controller' => 'Users',
			'action' => 'login',
			'prefix' => false
		],
		'unauthorizedRedirect' => [
			'plugin' => 'UserManager',
			'controller' => 'Users',
			'action' => 'login',
			'prefix' => false
		],
		'authError' => __('Acceso no permitido.'),
		'authenticate' => ['Form' => ['fields' => ['username' => 'email']]],
		'storage' => 'Session',
		'autoRedirect' => false
	]);
```
### Ejecutar migración para generar tablas en BD. 
Se crearán las tablas `Users` y `Roles` 

```bash
bin/cake migrations migrate -p UserManager

```


### Crea el layout en: src/templates/layout/
    -login.php

### Crea la plantilla del email en:  src/templates/layout/email/html/
    - forgot_password.php

### Crea las vistas en:  src/templates/Users/
    - login.php
    - forgot_password.php
    - reset_password.php


## Rutas habilidadas en la aplicación
- /user-manager/login
- /user-manager/forgot-password

(Necesita estar logueado en la aplicación)
- /user-manager/users
- /user-manager/users/add
- /user-manager/users/edit/:id
- /user-manager/roles
- /user-manager/roles/add
- /user-manager/roles/edit/:id
- /user-manager/roles/delete/:id
