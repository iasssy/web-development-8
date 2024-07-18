<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>



<div class="container-fluid">
  <div class="row flex-nowrap">

    
      <!-- start of side bar-->
      <div class="col-auto bg-light col-md-3 col-xl-2 px-sm-2 px-0  mt-3 py-3">

          <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">             

            <div class="dropdown">
              <a href="#" class="d-flex align-items-center text-decoration-none  text-secondary dropdown-toggle ms-lg-3 mx-auto mx-lg-0" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images/how-many-grammys-harry-styles.jpg" alt="" height="50" class="rounded-circle">
                <span class=" text-secondary d-none d-sm-inline ms-3 me-1">Harry Styles</span>
              </a>
              <ul class="dropdown-menu py-3"  aria-labelledby="dropdownUser">
                <li>
                  <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                    <i class="bi bi-pen"></i>Edit name</a>
                <li>
                  <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                    <i class="bi bi-person"></i>
                    Change avatar
                  </a>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                    <i class="bi bi-box-arrow-right"></i>
                    Log out
                  </a>
                </li>
              </ul>
            </div>
                
              <small class="text-uppercase text-secondary mt-3 ms-lg-3 mx-auto mx-lg-0">Main menu</small>

              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                  <li class="nav-item">
                      <a href="#" class="nav-link align-middle">
                        <i class="bi bi-star"></i>
                        <span class="ms-1 d-none d-sm-inline">Important</span>
                      </a>
                  </li>
                 <!---- <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-calendar-event"></i>
                        <span class="ms-1 d-none d-sm-inline">Dailies or Completed</span> 
                      </a>
                  </li> -->
                  <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-briefcase"></i>
                        <span class="ms-1 d-none d-sm-inline">Weekdays</span> 
                      </a>
                  </li>
                  <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-sun"></i>
                        <span class="ms-1 d-none d-sm-inline">Weekends</span> 
                      </a>
                  </li>  
                  
                  <hr class="w-100 border border-secondary border-1">
                
                  <small class="text-uppercase text-secondary ms-lg-3 mx-auto mx-lg-0">My lists</small>
                  <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-music-note"></i>
                        <span class="ms-1 d-none d-sm-inline">Music</span> 
                      </a>
                  </li>  
                  <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-music-note"></i>
                        <span class="ms-1 d-none d-sm-inline">Music</span> 
                      </a>
                  </li>  
                  <li>
                      <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                        <i class="bi bi-music-note"></i>
                        <span class="ms-1 d-none d-sm-inline">Music</span> 
                      </a>
                  </li>  
                  
              </ul>
          </div>
      </div>
      <!-- end of side bar-->

      <!-- start of right side content -->
      <div class="col py-3">

        <!-- Heading and task list -->
        <div class="jumbotron jumbotron-fluid bg-light border-0 py-3 ps-lg-5 px-auto px-lg-0">
            
            <!-- header part with Task list name and date-->
            <div class="row mb-3">
              <div class="col-md-8">
                <h3 class="mb-2 text-secondary float-start">
                  <i class="bi bi-speedometer2"></i>                
                  <span class="lead">Dashboard</span>
                  
                </h3>
              </div>
              <div class="col-md-4">
                <!-- Just date
                <p class=""><?= (Base::instance()->format('{0,date}' , time())) ?></p>
                -->

                <!-- showing in format Thu July 18, 2024, 12:10 pm              
                <p class=""><?= (date('D F j, Y, g:i a', time())) ?></p>
                -->

                <p class="lead"><?= (date('F j, Y, g:i a', time())) ?></p>

                <!-- showing just tine
                <p id="selector"><?= (Base::instance()->format('{0,time} ',time())) ?></p>
                -->
              </div>
            </div>
            <small class="fw-light text-uppercase text-secondary">List name:</small>
            <h1 class="display-3 mb-2 ms-0">Music</h1>
            <p class="lead text-muted">Manage the tasks with ease</p>

          </div>
       
        
        <!-- tasks with checkboxes and stars-->
        <div class="container-fluid m-0 p-0 my-3">
          
          <div class="row mb-3">
            <div class="col-md-8 d-flex">
              

              <div class="list-group w-100">

              <h3 class="lead text-uppercase ms-3 my-3">Tasks</h3>
                
                
                <label class="list-group-item d-flex gap-3 bg-body-tertiary py-3">
                  <input class="form-check-input form-check-input-placeholder bg-body-tertiary flex-shrink-0 pe-none" disabled="" type="checkbox" value="" style="font-size: 1.375em;">
                  <span class="pt-1 form-checked-content">
                    <span class="w-100">Add new task...</span>
                  </span>
                </label>

                <label class="list-group-item d-flex gap-3 align-items-start py-3">
                  <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                  <div class="d-flex flex-column me-auto">
                    <strong>Compose lyrics and melody for upcoming album</strong>
                    <p>Work again on the new album's main track.</p>
                    <small class="text-body-secondary d-flex gap-3">
                      <i class="bi bi-calendar-event"></i>July 20, 2024<br>
                      <i class="bi bi-clock"></i> 1:00-2:00pm
                    </small>
                  </div>
                  <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star"></i></span>
                </label>
                
                <label class="list-group-item d-flex gap-3 align-items-start py-3">
                  <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                  <div class="d-flex flex-column me-auto">
                    <strong>Approve designs for the new album cover</strong>                    
                    <small class="text-body-secondary d-flex gap-3">
                      <i class="bi bi-calendar-event"></i>July 25, 2024<br>
                      <i class="bi bi-clock"></i> 2:00-2:30pm
                    </small>
                  </div>
                  <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star-fill"></i></span>
                </label>


                <label class="list-group-item d-flex gap-3 align-items-start py-3">
                  <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                  <div class="d-flex flex-column me-auto">
                    <strong>Photoshoot for magazine cover</strong>                   
                    <small class="text-body-secondary d-flex gap-3">
                      <i class="bi bi-calendar-event"></i>July 27, 2024<br>
                      <i class="bi bi-clock"></i> 4:00-5:30pm
                    </small>
                  </div>
                  <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star"></i></span>
                </label>

                <label class="list-group-item d-flex gap-3 align-items-start py-3">
                  <input class="form-check-input flex-shrink-0" type="checkbox" value="" style="font-size: 1.375em;">
                  <div class="d-flex flex-column me-auto">
                    <strong>Rehearsal with the band for upcoming tour</strong>                
                    <small class="text-body-secondary d-flex gap-3">
                      <i class="bi bi-calendar-event"></i>July 28, 2024<br>
                      <i class="bi bi-clock"></i> 8:00-11:30pm
                    </small>
                  </div>
                  <span class="important lead flex-shrink-0 align-self-start"><i class="bi bi-star"></i></span>
                </label>

              </div>
            </div>



            
            <div class="col-md-4">
              <h3 class="lead text-uppercase ms-3 my-3">Quick Stats</h3>
              <ol class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                  <div class="ms-2 me-auto">
                    <div class="">Total</div>
                  </div>
                  <span class="badge text-bg-secondary rounded-pill">12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                  <div class="ms-2 me-auto">
                    <div class="">Completed</div>
                  </div>
                  <span class="badge text-bg-secondary rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                  <div class="ms-2 me-auto">
                    <div class="">Important</div>
                  </div>
                  <span class="badge text-bg-secondary rounded-pill">5</span>
                </li>
              </ol>
            </div>

          </div>




        </div>


        
      </div>
      
      <!-- end of right side content -->

  </div>
</div>

<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 