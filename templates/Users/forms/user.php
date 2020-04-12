
<div class="col-12">
  <div class="form-group checkbox-active">
    <div class="d-flex justify-content-end">
      <label class="mt-2"><b><?= __('Activo') ?></b></label>&nbsp;&nbsp;
      <?= $this->Form->checkbox('activo', ['class' => 'js-switch']) ?>
    </div>
  </div>
</div>

<div class="col-12 col-sm-4">
  <div class="form-group">
    <label><b><?= __('Nombre *') ?></b></label>
    <?=
    $this->Form->control('name', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control',
        'required',
        'autofocus']
    );
    ?>
  </div>
</div>
<div class="col-12 col-sm-8">
  <div class="form-group">
    <label><b><?= __('Apellidos *') ?></b></label>
    <?=
    $this->Form->control('last_name', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control',
        'required']
    );
    ?>
  </div>
</div>
<div class="col-12 col-sm-6">
  <div class="form-group">
    <label><b><?= __('Rol *') ?></b></label>
    <?=
    $this->Form->control('role_id', [
        'type' => 'select',
        'data-placeholder' => __('Escoge rol'),
        'options' => $roles,
        'label' => false,
        'class' => 'form-control',
        'required']
    );
    ?>
  </div>
</div>

<div class="col-12 col-sm-6">
  <div class="form-group">
    <label><b><?= __('Correo electrónico *') ?></b></label>
    <?=
    $this->Form->control('email', [
        'type' => 'email',
        'label' => false,
        'class' => 'form-control',
        'required']
    );
    ?>
  </div>
</div>
<div class="col-12 col-sm-6">
  <div class="form-group">
    <?= $this->Form->label('telefono', __('Teléfono')) ?>
    <?=
    $this->Form->control('telefono', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control',
        'required' => false]
    );
    ?>
  </div>
</div>

<div class="col-4 col-sm-6 col-md-2">
  <div class="form-group">
    <label><?= __('Abreviatura') ?></label>
    <?=
    $this->Form->control('abrev', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control']
    );
    ?>
  </div>
</div>
<div class="col-4 col-sm-6 col-md-2">
  <div class="form-group">
    <?= $this->Form->label('background_color', __('Color de fondo')); ?>
    <?=
    $this->Form->control('background_color', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control',
        'data-huebee' => '{ "setBGColor": true, "saturations": 2 }',
    ]);
    ?>
  </div>
</div>
<div class="col-4 col-sm-6 col-md-2">
  <div class="form-group">
    <?= $this->Form->label('text_color', __('Color de texto')) ?>
    <?=
    $this->Form->control('text_color', [
        'type' => 'text',
        'label' => false,
        'class' => 'form-control',
        'data-huebee' => '{ "setBGColor": true, "saturations": 2 }',
    ]);
    ?>
  </div>
</div>



<?= $this->Html->css('UserManager.switchery.min') ?>
<?= $this->Html->css('UserManager.huebbe.min') ?>
<?= $this->Html->script('UserManager.switchery.min') ?>
<?= $this->Html->script('UserManager.huebbe.min') ?>

<script>

  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  elems.forEach(function (html) {
    var switchery = new Switchery(html, {color: '#1ab394'});
  })


</script>