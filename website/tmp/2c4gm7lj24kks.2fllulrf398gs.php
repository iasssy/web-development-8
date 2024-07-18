<?php echo $this->render('includes/header.html',NULL,get_defined_vars(),0); ?>



<div class="container-fluid">
  <div class="row flex-nowrap">
      <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">

          <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">

              <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
                  <span class="fs-5 d-none d-sm-inline">Menu</span>
              </a>

              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                  <li class="nav-item">
                      <a href="#" class="nav-link align-middle px-0">
                        <i class="bi bi-star"></i>
                        <span class="ms-1 d-none d-sm-inline">Important</span>
                      </a>
                  </li>
                  <li>
                      <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="bi bi-calendar-event"></i>
                        <span class="ms-1 d-none d-sm-inline">Dailies</span> 
                      </a>
                  </li>
                  <li>
                      <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="bi bi-briefcase"></i>
                        <span class="ms-1 d-none d-sm-inline">Weekdays</span> 
                      </a>
                  </li>
                  <li>
                      <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="bi bi-sun"></i>
                        <span class="ms-1 d-none d-sm-inline">Weekends</span> 
                      </a>
                  </li>  
                  <hr class="w-100 border border-secondary border-1 opacity-20">
                
                  <li>
                      <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="bi bi-music-note"></i>
                        <span class="ms-1 d-none d-sm-inline">Music</span> 
                      </a>
                  </li>  
                  
              </ul>
          </div>
      </div>
      <div class="col py-3">
          Content area...
      </div>
  </div>
</div>

<?php echo $this->render('includes/footer.html',NULL,get_defined_vars(),0); ?> 