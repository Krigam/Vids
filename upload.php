<?php 
require_once("includes/header.php"); 
require_once("includes/classes/VideoDetailsForm.php");
?>

<!-- Content Container -->
<div class="column">

<?php 
    // create Upload Form with functions from VideoDetailsForm class
    $formProvider= new VideoDetailsForm($con);
    echo $formProvider->createUploadForm();
?>

</div>

<script>
// check for loading Modal
$("form").submit(function(){
    $("#loadingModal").modal("show");
});
</script>

<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div style="color: #242424">Bitte warten. Der Upload kann etwas Zeit beanspruchen.</div>
        <img class="loadingModal" src="assets/images/icons/loading.gif" alt="loading...">    
      </div>
    </div>
  </div>
</div>


<?php require_once("includes/footer.php"); ?>
                