<?php
$this->Breadcrumbs->add([
    ['title' => __('Administración'), 'url' => ['action' => 'index']],
    ['title' => __('Usuarios'), 'url' => ['action' => 'index']],
    ['title' => __('Roles'), 'url' => ['controller' => 'Roles', 'action' => 'index']],
]);
$this->Buttoncrumbs->add(
        '<i class="fa fa-list" aria-hidden="true"></i> ' . __('Lista de usuarios'),
         '/user-manager/users'
);
$this->Buttoncrumbs->add(
        '<i class="fa fa-plus" aria-hidden="true"></i> ' . __('Añadir rol'),
        ['action' => 'add', 'prefix' => false]
);
?>

<div class="col-12 ibox-content">
  <?php if ($roles->toArray()): ?>
    <div id="users" class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('role', __('ROLES')) ?></th>
            <th scope="col" class="actions text-right"><?= __('ACCIONES') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($roles as $rol): ?>
            <tr>
              <td><?= h($rol->role) ?></td>
              <td class="actions text-right">
                <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $rol->id], ['class' => 'btn btn-primary btn-sm mb-1', 'escape' => false, 'title' => __('Editar usuario')]) ?>
                <?php if ($rol->id != 1): ?>
                  <button type="button" onclick="deleteRol(<?= $rol->id ?>)" class="btn btn-danger btn-sm mb-1"><i class="fa fa-lg fa-trash-o"></i></button>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <?= $this->element('Paginator', ['count' => count($roles), 'limit' => $limit]) ?>
    </div>
  </div>
<?php else: ?>
  <div class="p-3 mb-2 bg-light"><?= __('No existen roles de usuario') ?></div>  
<?php endif; ?>

<?= $this->Html->script('UserManager.sweetalert.min') ?>

<script>
  function deleteRol(id) {
    Swal.fire({
      icon: 'error',
      title: '<?= __('Eliminar rol') ?>',
      text: '<?= __('¿Está seguro de eliminar el rol. Esta acción es irreversible.') ?>',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      cancelButtonText: '<?= __('Cancelar') ?>',
      confirmButtonText: '<?= __('Eliminar') ?>'
    }).then((result) => {
      if (result.value) {
        //Ejecuto url
        window.location.href = <?= $this->request->getAttribute('webroot') ?> + 'user-manager/roles/delete/' + id;
      }
    })
  }
</script>