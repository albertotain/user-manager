<?php

declare(strict_types=1);

namespace UserManager\Controller;

use UserManager\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \UserManager\Model\Table\RolesTable $Roles
 *
 * @method \UserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController {

  public $limit = 20;
  public $paginate = [
      'limit' => 20,
      'orden' => ['role' => 'ASC']
  ];

  public function initialize(): void {
    parent::initialize();
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|null|void Renders view
   */
  public function index() {
    $roles = $this->paginate($this->Roles);
    $limit = $this->limit;
    $title = __('Listado de roles de usuarios');

    $this->set(compact('roles', 'limit', 'title'));
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
   */
  public function add() {
    $rol = $this->Roles->newEmptyEntity();
    if ($this->request->is('post')) {
      $rol = $this->Roles->patchEntity($rol, $this->request->getData());
      if ($this->Roles->save($rol)) {
        $this->Flash->success(__('Guardado correcto.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('No se ha podido guardar. Por favor, intenlo de nuevo.') . $this->showErrors($rol->getErrors()));
    }
    $title = __('Añadir rol');
    $this->set(compact('title', 'rol'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Role id.
   * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function edit($id = null) {
    $rol = $this->Roles->get($id);
    if ($this->request->is('put')) {
      $rol = $this->Roles->patchEntity($rol, $this->request->getData());
      if ($this->Roles->save($rol)) {
        $this->Flash->success(__('Guardado correcto.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('No se ha podido guardar. Por favor, intenlo de nuevo.') . $this->showErrors($rol->getErrors()));
    }
    $title = __('Editar rol');
    $this->set(compact('title', 'rol'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Role id.
   * @return \Cake\Http\Response|null|void Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null) {
    $role = $this->Roles->get($id);
    debug($role);
    if ($role->id == 1) {
      $this->Flash->error(__('El rol de administrador no se puede eliminar'));
      return $this->redirect(['action' => 'index']);
    }
    if ($this->Roles->delete($role)) {
      $this->Flash->success(__('Eliminado correctamente.'));
    } else {
      $this->Flash->error(__('No se ha podido eliminar. Por favor, intentalo de nuevo.'));
    }

    return $this->redirect(['action' => 'index']);
  }

}
