
  <?php foreach (($resultsLists?:[]) as $itemList): ?>
    <li class="nav-item d-flex">
      <a href="<?= ($BASE) ?><?= (Base::instance()->alias('showListByIdWithTasks', ['id'=>$itemList['id']])) ?>" class="nav-link d-flex align-items-center list-link">
        <i class="bi bi-record2 fs-5 me-1"></i>
        <span class="title-text d-inline">
          <?= ($itemList['title'])."
" ?>
        </span>
      </a>
      <a href="<?= ($BASE) ?><?= (Base::instance()->alias('modifyList')) ?>" class="nav-link d-flex align-items-center">
        <i class="bi bi-pencil d-none d-sm-inline fs-5 ms-1"></i>
      </a>
    </li>
  <?php endforeach; ?>
  <li id="createList">
      <small  role="button" class="text-uppercase text-secondary mx-auto" data-bs-toggle="modal" data-bs-target="#createListModal">
        <i class="bi bi-plus" style="font-size: 1.375em;"></i> New list
      </small>
  </li>  

  <!-- modal for creating a new list -->
  <div class="modal fade" id="createListModal" tabindex="-1" aria-labelledby="createListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createListModalLabel">Creating a new list</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php echo $this->render('tasks/newList.html',NULL,get_defined_vars(),0); ?>
        </div>
        </div>
      </div>
  </div>
