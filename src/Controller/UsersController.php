<?php

declare(strict_types=1);

namespace UserManager\Controller;

use UserManager\Controller\AppController;
use Cake\Mailer\Mailer;
use UserManager\Util\Token;
use Cake\Routing\Router;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \UserManager\Model\Table\UsersTable $Users
 *
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

  public function initialize(): void {
    parent::initialize();
    $this->Auth->allow(['isEmailUnique', 'forgotPassword', 'resetPassword', 'login', 'logout']);
  }

  public function login() {
    if ($this->Auth->user()) {
      return $this->redirect($this->Auth->redirectUrl());
    }
    $this->viewBuilder()->setLayout('login');
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user && $user['activo']) {
        $this->Auth->setUser($user);
        $this->Users->updateAll(['last_login' => Time::now()], ['id' => $user['id']]);
        return $this->redirect($this->Auth->redirectUrl());
      } else {
        $this->Flash->error(__('Usuario o contraseña incorrecta'));
      }
    }
  }

  public function logout() {
    $this->request->getSession()->destroy();
    return $this->redirect($this->Auth->logout());
  }

  public function forgotPassword() {
    if ($this->Auth->user()) {
      return $this->redirect($this->Auth->redirectUrl());
    }

    $this->viewBuilder()->setLayout('login');
    if ($this->request->is('post')) {
      $email = $this->request->getData('email');
      $user = $this->Users->findByEmail($email)->first();
      if ($user) {
        $token = $user->tokenGenerate(1440);
        $url = Router::url(['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'resetPassword', $token], true);
        // send email
        $mail = new Mailer('default');
        $mail->viewBuilder()->setTemplate('forgot_password');
        $mail->setEmailFormat('html')
                ->setTo($email, $user->full_name);
        $mail->setViewVars(['url' => $url]);
        $mail->setSubject(__('Solicitud de recuperación de contraseña'));

        if (!$mail->send()) {
          $this->Flash->error(__('Lo sentimos no hemos podido enviar el email. Intentalo de nuevo'));
        } else {
          $this->Flash->success(__('Le hemos enviado un correo a: ' . $email . '. Acceda a su correo para restablecer la contraseña.'));
          $this->redirect(['action' => 'login']);
        }
      }
    }
  }

  public function resetPassword($token) {
    if ($this->Auth->user()) {
      return $this->redirect($this->Auth->redirectUrl());
    }
    $this->viewBuilder()->setLayout('login');
    $user = $this->Users->get(Token::getId($token));

    if (!$user->tokenVerify($token)) {
      throw new \Cake\Network\Exception\NotFoundException();
    }

    if ($this->request->is('post')) {
      if ($this->request->getData('password') != $this->request->getData('confirm-password')) {
        $this->Flash->error(__('Las contraseñas no son iguales'));
      } else {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
          $this->Flash->success(__('Contraseña guardada correctamente'));
          return $this->redirect(['action' => 'login']);
        } else {
          $this->Flash->error(__('No se ha podido guardar la contraseña. Intentelo de nuevo.'));
        }
      }
    }
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|null|void Renders view
   */
  public function index() {
    $users = $this->Users->find()->contain('Roles')->orderDesc('Users.created');

    $title = __('Listado de usuarios');

    $this->set(compact('users', 'title'));
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
   */
  public function add() {
    $user = $this->Users->newEmptyEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('Guardado correcto.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('No se ha podido guardar. Por favor, intenlo de nuevo.') . $this->showErrors($user->getErrors()));
    }
    $roles = $this->Users->Roles->find('list', ['keyField' => 'id', 'valueField' => 'role']);
    $title = __('Añadir usuario');
    $this->set(compact('title', 'user', 'roles'));
  }

  /**
   * Edit method
   *
   * @param string|null $id User id.
   * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function edit($id = null) {
    $user = $this->Users->get($id);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $data = $this->request->getData();
      if (empty($data['password'])) {
        unset($data['password']);
      }
      $user = $this->Users->patchEntity($user, $data);
      if ($this->Users->save($user)) {
        $this->Flash->success(__('Guardado correcto.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('No se ha podido guardar. Por favor, intenlo de nuevo.') . $this->showErrors($user->getErrors()));
    }
    $roles = $this->Users->Roles->find('list', ['keyField' => 'id', 'valueField' => 'role']);
    $title = __('Editar usuario');
    $this->set(compact('title', 'user', 'roles'));
  }

}
