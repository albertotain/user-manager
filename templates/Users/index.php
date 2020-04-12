<?php
$this->Breadcrumbs->add([
    ['title' => __('Administración'), 'url' => ['action' => 'index']],
    ['title' => '<b>' . __('Usuarios') . '</b>', 'url' => ['action' => 'index']],
]);
$this->Buttoncrumbs->add(
        '<i class="fa fa-list" aria-hidden="true"></i> ' . __('Lista de roles'),
        ['controller' => 'Roles', 'action' => 'index', 'prefix' => false]
);
$this->Buttoncrumbs->add(
        '<i class="fa fa-plus" aria-hidden="true"></i> ' . __('Añadir usuario'),
        '/user-manager/users/add'
);
?>
<div class="col-12 ibox-content">
  <?php if ($users->toArray()): ?>
    <div id="users" class="table-responsive">
      <table class="table table-striped" data-sorting="true" data-paging="true" data-filtering="true">
        <thead>
          <tr>
            <th scope="col"><?= __('NOMBRE Y APELLIDOS') ?></th>
            <th scope="col"><?= __('ROL') ?></th>
            <th scope="col"><?= __('EMAIL') ?></th>
            <th scope="col"><?= __('TELÉFONO') ?></th>
            <th scope="col"><?= __('FECHA ALTA') ?></th>
            <th scope="col"><?= __('ÚLTIMO ACCESO') ?></th>
            <th scope="col" class="text-center"><?= __('BK-COLOR') ?></th>
            <th scope="col" class="text-center"><?= __('TXT-COLOR') ?></th>
            <th scope="col" class="text-center"><?= __('ACTIVO') ?></th>
            <th scope="col" class="actions text-right no-sort"><?= __('ACCIONES') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= h($user->full_name) ?></td>
              <td><?= h($user->role->role) ?></td>
              <td><a href="mailto:<?= $user->email ?>"><?= h($user->email) ?></a></td>
              <td><a href="tel:<?= $user->telefono ?>"><?php echo $user->telefono ?></a></td>
              <td><?= h($user->created->i18nFormat('dd/MM/Y')) ?></td>
              <td><?= $user->last_login ? $user->last_login->i18nFormat('dd/MM/Y HH:mm') : '' ?></td>
              <td><div class="square" style="background-color:<?php echo $user->background_color ?>;margin: auto;"></div></td>
              <td><div class="square" style="background-color:<?php echo $user->text_color ?>;margin: auto;"></div></td>
              <td class="text-center"><?= $this->Buttoncrumbs->activo($user->activo) ?></td>
              <?php
              $icon_active = ($user->activo) ? '<span class="hide">1</span><i class="far fa-check-circle fa-lg color-green" title="Activa"></i>' : '<span class="hide">0</span><i class="far fa-times-circle fa-lg color-danger" title="Inactiva"></i>';
              ?>
              <td class="actions text-right">
                <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['controller' => 'Users', 'action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'title' => __('Editar usuario')]) ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
<?php else: ?>
  <div class="p-3 mb-2 bg-light"><?= __('No existe usuarios registrados') ?></div>  
<?php endif; ?>

<style>
  #users .square{
    width: 25px;
    height: 25px;
    position: relative;
    border: 1px solid black;
  }
</style>

<script>
  $(document).ready(function () {
    $('.table').DataTable({
      responsive: false,
      pageLength: 100,
      dom: '<"html5buttons"B>lTfgtip',
      buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i>',
          titleAttr: '<?= __('Exportar a excel') ?>'
        }],
      columnDefs: [
        {orderable: false, targets: 'no-sort'},
      ],
      order: [[0, "asc"]],
      language: datatables.lang.es
    });
  });
</script>

<?= $this->Html->css('UserManager.datatables/datatables.min') ?>
<?= $this->Html->script('UserManager.datatables/datatables.min') ?>
<?= $this->Html->script('UserManager.datatables/locale/es_ES') ?>



