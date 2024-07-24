
<?php if ($errors): ?>
  
    <div class="jumbotron jumbotron-fluid bg-tertiary border-0 py-3 ps-lg-5 px-auto px-lg-0">
      <?php foreach (($errors?:[]) as $error): ?>
        <h3><?= ($error) ?></h3>
      <?php endforeach; ?>
    </div>
    <div class="list-group w-100">

      <h3 class="lead text-uppercase ms-3 my-3">Tasks</h3>  
      <label class="list-group-item d-flex gap-3 bg-body-tertiary py-3" id="createTask"  data-bs-toggle="modal" data-bs-target="#createTaskModal">
        <i class="bi bi-plus-lg" style="font-size: 1.375em;"></i>
        <span class="pt-1 form-checked-content">
          <span class="w-100">Add new task...</span>
        </span>
      </label>
    </div>
  
  <?php else: ?>
    <!-- Heading and task list -->
    <div class="jumbotron jumbotron-fluid bg-tertiary border-0 py-3 ps-lg-5 px-auto px-lg-0">
      <small class="fw-light text-uppercase text-secondary">List name:</small>
      <h1 class="display-3 mb-2 ms-0"><?= ($item_task_list[0]['list_title']) ?></h1>
      <p class="lead text-muted">Manage the tasks with ease</p>
    </div>
    

 

    <!-- tasks with checkboxes and stars-->
    <div class="container-fluid m-0 p-0 my-3">
      
      <div class="row mb-3">
        <div class="col-md-8 d-flex">      

          <div class="list-group w-100">

          <h3 class="lead text-uppercase ms-3 my-3">Tasks</h3>        
          
          
          <label class="list-group-item d-flex gap-3 bg-body-tertiary py-3" id="createTask"  data-bs-toggle="modal" data-bs-target="#createTaskModal">
            <i class="bi bi-plus-lg" style="font-size: 1.375em;"></i>
            <span class="pt-1 form-checked-content">
              <span class="w-100">Add new task...</span>
            </span>
          </label>

          <?php foreach (($item_task_list?:[]) as $item): ?>
            <label class="list-group-item d-flex gap-3 align-items-start py-3">
              <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
              <div class="d-flex flex-column me-auto">
                <strong><?= ($item['task_title']) ?></strong>
                <p><?= ($item['task_description']) ?></p>
                <small class="text-body-secondary d-flex gap-3">
                  
                  <i class="bi bi-clock"></i> <!-- add time here if available -->
                </small>
              </div>
              <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star"></i></span>
            </label>
          <?php endforeach; ?>
          

          </div>
        </div>



        <!-- Statistics to the right of tasks-->
        <div class="col-md-4">
          <h3 class="lead text-uppercase ms-3 my-3">Quick Stats for the list</h3>
          <ol class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
              <div class="ms-2 me-auto">
                <div class="">Total</div>
              </div>
              <span class="badge text-bg-secondary rounded-pill">4</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
              <div class="ms-2 me-auto">
                <div class="">Completed</div>
              </div>
              <span class="badge text-bg-secondary rounded-pill">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
              <div class="ms-2 me-auto">
                <div class="">Important</div>
              </div>
              <span class="badge text-bg-secondary rounded-pill">1</span>
            </li>
          </ol>
        </div>

      </div>




    </div>

      

<?php endif; ?>
