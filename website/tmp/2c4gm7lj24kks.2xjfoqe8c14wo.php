<?php foreach (($task_list_results?:[]) as $item): ?>
<label class="list-group-item d-flex gap-3 align-items-start py-3">
  <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
  <div class="d-flex flex-column me-auto">
    <strong><?= ($item['list_name']) ?> | <?= ($item['task_name']) ?> </strong>
    <p><?= ($item['task_description']) ?></p>
    <small class="text-body-secondary d-flex gap-3">
      <i class="bi bi-calendar-event"></i><?= ($item['task_due_date'])."
" ?>
    </small>
  </div>
  <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star"></i></span>
</label>
<?php endforeach; ?>