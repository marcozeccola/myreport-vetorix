<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';   
?>

<section id="portfolio" class="portfolio section-bg">

     <div class="container">
          <header class="section-header text-center">
               <h3><?php echo $data["user"]->name . " " .  $data["user"]->surname;?>'s ultrasounds </h3>
               <div class="row" style="max-width:60%!important;margin-left:20%!important;">
                    <div class="col-lg-12 col-sm-12">
                         <a class="btn btn-primary"
                              href="<?php echo URLROOT; ?>/ultrasoundusers/addUltrasound?idUser=<?php echo $data["user"]->idUser; ?>">
                              ADD ULTRASOUND INSTRUMENT
                              <i class="bi bi-plus-circle-dotted"></i>
                         </a>
                    </div>

               </div>

          </header>
          <br>

          <div class="text-center" style="width: 100%;">
               <div class="row">
                    <table class="table">
                         <thead>
                         <tr>
                              <th scope="col">Ultrasound</th>
                              <th scope="col">SN</th>
                              <th scope="col">Expiration</th>
                              <th scope="col">Probe</th> 
                         </tr>
                         </thead>
                         <tbody>
                              <?php if($data["ultrasound"]){?>
                         <tr>
                              <th scope="row"><?php echo $data["ultrasound"]->ultrasound; ?></th>
                              <td><?php echo $data["ultrasound"]->sn; ?></td>
                              <td><?php echo $data["ultrasound"]->expiration; ?></td>
                              <td><?php echo $data["ultrasound"]->probe; ?></td> 
                         </tr>
                         <?php } ?>
                          
                         </tbody>
                    </table>

               </div>
          </div>
</section>



<?php
   require APPROOT . '/views/includes/footer.php';
?>