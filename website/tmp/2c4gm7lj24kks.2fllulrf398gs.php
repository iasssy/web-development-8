<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>



<div class="container-fluid">
  <div class="row flex-nowrap">

    
      <!-- start of side bar-->
      <div class="col-auto bg-light col-md-3 col-xl-2 px-sm-2 px-0  mt-3 py-3 pb-5">

          <div class="d-flex flex-column align-items-center align-items-sm-start px-1 pt-2 min-vh-100">             

            <div class="dropdown">
              <?php echo $this->render('user/sidebar-user.html',NULL,get_defined_vars(),0); ?>
            </div>
                
              <small class="text-uppercase text-secondary mt-3 ms-lg-3 mx-auto mx-lg-0">Main menu</small>

              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                  <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                    <i class="bi bi-sun fs-5"></i>
                    <span class="ms-1 d-none d-sm-inline">Today</span> 
                  </a>
                </li> 
                <li class="nav-item">
                    <a href="#" class="nav-link align-middle">
                      <i class="bi bi-star fs-5"></i>
                      <span class="ms-1 d-none d-sm-inline">Important</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="collapse" class="nav-link align-middle">
                      <i class="bi bi-calendar-event fs-5"></i>
                      <span class="ms-1 d-none d-sm-inline">Completed</span> 
                    </a>
                </li> 
              <!----  <li>
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
                </li> --> 
                
                <hr class="w-100 border border-secondary border-1">
              
                <small class="text-uppercase text-secondary ms-lg-3 mx-auto mx-lg-0">My lists</small>
                <div id="listsContainer">
                  <?php echo $this->render('tasks/lists.html',NULL,get_defined_vars(),0); ?>
                </div>
                  
              </ul>
          </div>
      </div>
      <!-- end of side bar-->

      <!-- start of right side content -->
      <div class="col py-3">

        <!-- Heading and task list -->
        <div class="container-fluid bg-light border-0 py-2 ps-lg-5 px-auto px-lg-0">
            
            <!-- header part with Task list name and date-->
            <div class="row">
              <div class="col-md-8">
                <h3 class="text-secondary float-start lead pt-3">
                  <i class="bi bi-speedometer2 "></i>                
                  <span class="">Dashboard</span>
                  
                </h3>
              </div>
              <div class="col-md-4 text-center">
                <!-- Just date
                <p class=""><?= (Base::instance()->format('{0,date}' , time())) ?></p>
                -->

                <!-- showing in format Thu July 18, 2024, 12:10 pm              
                <p class=""><?= (date('D F j, Y, g:i a', time())) ?></p>
                -->

                <!-- showing in format July 19, 2024, 7:29 am
                <p class="lead"><?= (date('F j, Y, g:i a', time())) ?></p>-->
                <small class="lead fs-4 border-bottom border-secondary p-1"><?= (date('F j', time())) ?></small>
                <br>
                <small class="lead"><?= (date('Y', time())) ?></small>

                <!-- showing just tine
                <p id="selector"><?= (Base::instance()->format('{0,time} ',time())) ?></p>
                -->
              </div>
            </div>
        </div>
            
        <div id="dashboard-right-content">          
           <?php echo $this->render('tasks/due-today.html',NULL,get_defined_vars(),0); ?>
        </div>

        
      </div>      
      <!-- end of right side content -->

      </div>

      <!-- General Error Modal -->
      <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="errorModalLabel">Error message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Error messages will be displayed here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


</div>


<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 