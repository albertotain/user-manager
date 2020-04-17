# UserManager plugin for CakePHP 4

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require albertotain/user-manager
```

## Configuration

### Añade el plugin en: src/Application.php

```
public function bootstrap(): void {

	$this->addPlugin('UserManager');

}
```

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

Se crearán las tablas `Users` y `Roles`. Se crea el rol administrador y un usuario administrador:
- Email: admin@admin.es
- Contraseña: admin

```bash
bin/cake migrations migrate -p UserManager

bin/cake migrations seed -p UserManager

```

### Crea el layout en: src/templates/layout/

    -login.php

-Y añade a tus plantillas:
  - <?= $this->fetch('css') ?>
  - <?= $this->fetch('script'); ?>

```bash
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
  
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

  </head>
  <body>
    <?= $this->Flash->render(); ?>
    <?= $this->fetch('content'); ?>
    <div id="footer" class="container"></div>
    
    <?= $this->fetch('script'); ?>
  </body>
</html>
````

### Crea la plantilla del email en: src/templates/layout/email/html/

    - forgot_password.php

### Crea las vistas en: src/templates/Users/

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
