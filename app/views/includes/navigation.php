<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
     <h1  class="logo me-auto "><a   href="<?php echo URLROOT; ?>"><img class="logo" src="<?php echo URLROOT ?>/public/assets/img/logo.png" alt=""></a></h1> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup" style="margin-right: 10%!important;">
      <div class="navbar-nav me-auto  ">  
        <a class="nav-link " href="<?php echo URLROOT; ?>/progetti/">Projects</a>
        <li class="dropdown"><a href="#"><span><?php echo $_SESSION['username'] ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?php echo URLROOT;?>/users/logout">LogOut</a></li>
              <li><a href="<?php echo URLROOT;?>/users/changePassword">Change password</a></li> 
              <li><a href="<?php echo URLROOT;?>/ultrasoundusers">Your ultrasounds</a></li> 
              <li><a href="<?php echo URLROOT;?>/users/changeQualifications">Change titles</a></li> 
              <li><a href="<?php echo URLROOT;?>/users/signature">Upload signature</a></li>   
            </ul>
        </li>
        
        <?php 
          if(isAdmin()){
        ?>
        <li class="dropdown"><a href="#"><span>Admin</span> <i class="bi bi-chevron-down"></i></a>
            <ul>  
              <li>
                <b class="nav-link " style="font-weight:bold!important;">Technicians</b>
              </li> 
              <li>
                <a class="nav-link " href="<?php echo URLROOT; ?>/users/register">Register new Technician</a> 
              <li>
                <a class="nav-link " href="<?php echo URLROOT; ?>/users/usersDashboard">Technicians dashboard</a>
              </li>     
            </ul>
        </li>
        
        <?php 
          }
        ?>
      </div>
    </div>
  </div>
</nav>
  <main id="main">  