<?php
$this->Breadcrumbs->add([
    ['title' => __('Administración'), 'url' => ['action' => 'index']],
    ['title' => __('Usuarios'), 'url' => ['action' => 'index']],
    ['title' => __('Roles'), 'url' => ['controller'=> 'Roles' ,'action' => 'index']],
    ['title' => '<b>' . __('Editar') . '</b>', 'url' => ['controller'=> 'Roles' , 'action' => 'add']],
]);
$this->Buttoncrumbs->add(
        '<i class="fa fa-lg fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp; ' . __('Volver'),
        ['controller'=> 'Roles' ,'action' => 'index' , 'prefix' => false]
);
?>

<div class="col-12 ibox-content">
  <?= $this->Form->create($rol, ['autocomplete' => 'off']) ?>
  <?php include 'forms/rol.php'; ?>
  <?= $this->Form->end(); ?>
</div>