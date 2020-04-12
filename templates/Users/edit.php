<?php
$this->Breadcrumbs->add([
    ['title' => __('Administración'), 'url' => ['action' => 'index']],
    ['title' => __('Usuarios'), 'url' => '/user-manager/users'],
    ['title' => '<b>' . __('Añadir') . '</b>'],
]);
$this->Buttoncrumbs->add(
        '<i class="fa fa-lg fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp; ' . __('Volver'),
        '/user-manager/users'
);
?>
<div class="col-12 ibox-content">
  <?= $this->Form->create($user, ['autocomplete' => 'off']) ?>
  <div class="row">
    <?php include 'forms/user.php'; ?>
     <div class="col-12">
        <hr>
        <p><b><?= __('Para conservar la contraseña dejar los campos en blanco') ?></b></p>
     </div>
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <?= $this->Form->label('password', __('Nueva contraseña')) ?>
        <?=
        $this->Form->control('password', [
            'type' => 'password',
            'label' => false,
            'value' => '',
            'class' => 'form-control']
        );
        ?>
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="form-group">
        <?= $this->Form->label('confirm_password', __('Repite la nueva contraseña')) ?>
        <?=
        $this->Form->control('confirm_password', [
            'type' => 'password',
            'label' => false,
            'class' => 'form-control']
        );
        ?>
      </div>
    </div>
    <div class="col-12">
      <hr>
      <p class="text-left campos-obligatorios">
        <?= __('* Campos obligatorios.'); ?>
      </p>
      <button type="submit" class="btn btn-lg btn-block btn-primary p-xs">
        <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> <?= __('Guardar') ?>
      </button>
    </div>
  </div>
  <?= $this->Form->end(); ?>
</div>

<script>
  var password = document.getElementById("password"), confirm_password = document.getElementById("confirm-password");

  function validatePassword() {
    if (password.value != confirm_password.value) {
      confirm_password.setCustomValidity("La contraseña no coincide");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
