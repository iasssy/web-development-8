<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>

  <div class="container">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-3">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="images/task-management.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Master your schedule and achieve your goals</h1>
        <p class="lead">Simplify task management and and prioritize effectively.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="<?= ($BASE) ?><?= (Base::instance()->alias('login')) ?>" class="btn btn-primary d-inline-flex align-items-center btn-lg px-4 rounded-pill mt-4">
            Get started 
            <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 

