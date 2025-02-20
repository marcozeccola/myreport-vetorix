<?php
   require APPROOT . '/views/includes/head.php'; 
?> 
<?php
     require APPROOT . '/views/includes/navigation.php'; 
?>
 <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0 "> 
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Register new specialist <br /> 
          </h1> 
          <p>Register new reader here: <a href="<?php echo URLROOT;?>/readers/register">new read-only</a></p>
         
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="<?php echo URLROOT;?>/users/register" method="POST">

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="name" name="name" class="form-control" value="<?php echo $data["name"]; ?>" required/>
                      <label class="form-label" for="name">Name</label>
                      <br>
                      <small class="text-danger"><?php echo $data["nameError"]; ?></small>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="surname" name="surname" class="form-control" value="<?php echo $data["surname"]; ?>" required />
                      <label class="form-label" for="surname">Surname</label>
                      <br>
                      <small class="text-danger"><?php echo $data["surnameError"]; ?></small>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control"  value="<?php echo $data["email"]; ?>"  required />
                  <label class="form-label" for="email">Email</label> 
                  <br>
                  <small class="text-danger"><?php echo $data["emailError"]; ?></small>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control" required/>
                  <label class="form-label" for="password">Password</label>
                  <br>
                  <small class="text-danger"><?php echo $data["passwordError"]; ?></small>
                </div> 
                
                <!-- confirm password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required/>
                  <label class="form-label" for="confirmPassword">Confirm password</label>
                  <br>
                  <small class="text-danger"><?php echo $data["confirmPasswordError"]; ?></small>
                </div> 
 
                <div class="form-outline mb-4">
                  <textarea name="qualifications" class="form-control"> <?php echo $data["qualifications"]; ?></textarea>
                  <label class="form-label" for="qualifications">Qualifications</label>
                </div>

                <!-- ruoli -->
                <div class="form-outline mb-4">
                  <select class="form-select" required  name="role">
                    <option value="restricted">Restricted</option> 
                    <option value="reviewer">Reviewer</option> 
                    <option value="admin">Administrator</option> 
                  </select>
                  <label class="form-label" for="role">Role</label>
                </div> 

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign up
                </button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<?php
  require APPROOT . '/views/includes/footer.php';  
?>