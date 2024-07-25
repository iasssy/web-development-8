
<?php foreach (($resultsLists?:[]) as $itemList): ?>
  <li class="nav-item d-flex border-bottom">
    <button data-href="<?= ($BASE) ?><?= (Base::instance()->alias('showListByIdWithTasks', ['id'=>$itemList['id']])) ?>" 
      class="nav-link d-flex text-start list-link">
      <span class="title-text d-inline">
        <?= ($itemList['title'])."
" ?>
      </span>
    </button>
    <button data-href="<?= ($BASE) ?><?= (Base::instance()->alias('editList', ['id'=>$itemList['id']])) ?>" class="nav-link d-flex align-items-center list-edit">
      <i class="bi bi-pencil d-none d-sm-inline fs-5"></i>
    </button>
    <button data-href="<?= ($BASE) ?><?= (Base::instance()->alias('deleteList', ['id'=>$itemList['id']])) ?>" class="nav-link d-flex align-items-center list-delete">
      <i class="bi bi-trash d-none d-sm-inline fs-5"></i>
    </button>
  </li>
<?php endforeach; ?>
<li id="createList">
  <small role="button" class="text-uppercase text-secondary mx-auto" data-bs-toggle="modal" data-bs-target="#createListModal">
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
          <?php echo $this->render('tasks/new-list.html',NULL,get_defined_vars(),0); ?>
        </div>
        </div>
      </div>
  </div>

<!-- modal for creating a new list -->
  <div class="modal fade" id="editListModal" tabindex="-1" aria-labelledby="editListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editListModalLabel">Editing the list</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php echo $this->render('tasks/edit-list.html',NULL,get_defined_vars(),0); ?>
        </div>
        </div>
      </div>
  </div>

  <!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteListModal" tabindex="-1" aria-labelledby="deleteListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteListModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this list?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
