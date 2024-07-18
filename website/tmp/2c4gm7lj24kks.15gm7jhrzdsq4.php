<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>



  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-5">Get in Touch with Us</h1>
        <p class="col-lg-10 fs-4">We'd love to hear from you! Whether you have a question about our features, settings or anything else, our team is ready to answer all your questions.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
          <div class="py-5 text-center">
            <h2><span class="">Sign up to </span>
                <img class="" src="images/Task-it-logo.svg" alt="" height="40">
            </h2>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingNameInput" placeholder="Your Name">
            <label for="floatingNameInput">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Comments</label>
          </div>
          <button class="btn btn-primary px-4 btn-lg rounded-pill my-4" type="submit">Send</button>
        </form>
      </div>
    </div>
  </div>

<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 
