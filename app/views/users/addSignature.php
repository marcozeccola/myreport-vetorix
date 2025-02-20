<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div class="d-flex justify-content-center" style="margin-top:10%!important;">
   <div class="row text-center  ">
      <h3>Upload you signature <b>image</b></h3>
      <form action="<?php echo URLROOT ?>/users/signature" method="POST" enctype="multipart/form-data"> 

         <input type="hidden" name="idUser" value="<?php echo $_GET["idUser"]; ?>">

         <!-- signature input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="signature"><b>Signature</b></label>
            <input type="file" id="signature" name="signature" class="form-control"  accept="image" required/>
         </div>

         <!-- Submit button -->
         <button type="submit" class="btn btn-primary btn-block mb-4">
         SAVE
         </button> 
      </form>
   </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>