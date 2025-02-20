<?php
   require APPROOT . '/views/includes/head.php'; 
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<section id="pricing" class="pricing section-bg text-center">
     <div class="container">
          <header class="section-header">
               <h3>Specialists dashboard</h3>
               <a class="btn btn-primary" style="width: 70%; margin: auto"
                    href="<?php echo URLROOT; ?>/users/register">
                    REGISTER SPECIALIST
               </a>
          </header><br>


          <br><br>
          <table class="table">
               <thead>
                    <tr> 
                         <th scope="col">Email</th>
                         <th scope="col">Username</th> 
                         <th scope="col">Role</th>
                         <th scope="col">Ultrasound</th>
                         <th scope="col">Qualifications</th>
                         <th scope="col">Signature</th>
                         <th scope="col">Delete</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    if ($data["users"]) {
                         foreach ($data["users"] as $user) {
                              ?>
                    <tr> 
                         <td><?php echo $user->email; ?></td>
                         <td><?php echo $user->name. " ".  $user->surname;; ?></td> 
                         <td><?php echo $user->role; ?></td>  
                         <td>
                              <a
                                   href="<?php echo URLROOT; ?>/ultrasoundusers/addUltrasound?idUser=<?php echo $user->idUser; ?>">
                                   edit ultrasound
                              </a>
                         </td>
                         <td><?php echo $user->qualifications; ?> 
                              <a
                                   href="<?php echo URLROOT; ?>/users/changeQualifications?idUser=<?php echo $user->idUser; ?>">
                                   <i class="bi bi-pencil"></i>
                              </a>
                         </td>
                         <td>
                              <a
                                   href="<?php echo URLROOT; ?>/users/signature?idUser=<?php echo $user->idUser; ?>">
                                   edit signature
                              </a>
                         </td>
                         <td>
                              <a
                                   href="<?php echo URLROOT; ?>/users/deactivate?idUser=<?php echo $user->idUser; ?>">
                                   <i class="bi bi-trash"></i>
                              </a>
                         </td>
                    </tr>
                    <?php
                         }
                    }
                    ?>
               </tbody>
          </table>
     </div>
</section>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>