<div class="paginator text-center">
  <?php if (isset($limit) && isset($count) && $limit <= $count): ?> 
    <ul class="pagination d-flex justify-content-center">
      <?= $this->Paginator->first('<< ' . __('primera')) ?>
      <?= $this->Paginator->prev('< ' . __('anterior')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('siguiente') . ' >') ?>
      <?= $this->Paginator->last(__('última') . ' >>') ?>
    </ul>
  <?php endif ?>
  <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} resultados de {{count}} total')) ?></p>
</div>
