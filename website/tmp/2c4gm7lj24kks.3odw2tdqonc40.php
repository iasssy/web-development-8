<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>

      
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-md-10 mx-auto col-lg-6">
             <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
              <div class="py-5 text-center">
                <h2><span class="">Log in to </span>
                    <img class="" src="public/images/Task-it-logo.svg" alt="" height="40">
                </h2>
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
                <p class="my-3">Forgot your password?</p>
              </div>
              <button class="btn btn-primary px-4 rounded-pill" type="submit">Log in</button>
              <hr class="my-5">
              <small class="text-body-secondary my-3">Don't have account?</small>
              <h5 class="">Create Account Now</h5>
            </form>
          </div>
        </div>
      </div>


<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 
