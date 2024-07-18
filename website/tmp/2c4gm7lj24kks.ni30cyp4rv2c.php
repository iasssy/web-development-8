<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>

      
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-md-10 mx-auto col-lg-6">
             <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
              <div class="py-5 text-center">
                <h2><span class="">Sign up to </span>
                    <img class="" src="images/Task-it-logo.svg" alt="" height="40">
                </h2>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNameInput" placeholder="Your Name">
                <label for="floatingNameInput">Name *</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email *</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password *</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
              </div>
              <button class="btn btn-primary px-4 rounded-pill" type="submit">Sign up</button>
              <hr class="my-5">
              <small class="text-body-secondary my-3">Have already account?</small>
              <h5 class=""><a class="text-decoration-none" href="<?= ($BASE) ?><?= (Base::instance()->alias('login')) ?>">Log in</a></h5>
            </form>
          </div>
        </div>
      </div>


<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 