<div class="row">
  <div class="col-12">
    <div class="form-group">
      <label><b><?= __('Rol *') ?></b></label>
      <?=
      $this->Form->control('role', [
          'type' => 'text',
          'label' => false,
          'class' => 'form-control',
          'value' => $rol->role ?? null,
          'required',
          'autofocus']
      );
      ?>
    </div>
  </div>
  <div class="col-12">
    <hr>
    <p class="text-left campos-obligatorios">
      <b><?= __('* Campos obligatorios.'); ?></b>
    </p>
    <button type="submit" class="btn btn-lg btn-block btn-primary p-xs">
      <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> <?= __('Guardar') ?>
    </button>
  </div>
</div>


