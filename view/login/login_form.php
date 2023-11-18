<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");
	require_once("../../controller/bll_user.php");
	
	$session = new Session();
	$forms   = new Forms("login_process.php", "POST");
	// $session->admin_session();
	
	General::site_header();
	General::site_logo();
?>

	<!-- Main Container:Start -->
    <!-- <div class="container mt-5"> -->
    	<section class="vh-100" style="background-color: white;">
		  <div class="container py-5">
		    <div class="row d-flex justify-content-center align-items-center h-100">
		      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
		        <div class="card shadow-2-strong" style="border-radius: 1rem;">
		          	<div class="card-body p-5 text-center">
		          		<h3 class="mb-5">Admin Login</h3>

					    <?php
					    if(isset($_REQUEST['message'])){
					    ?>
					    <div class="row">
					    	<div class="col-md-12">
					    		<div class="alert alert-<?php echo $_REQUEST['class']??''; ?> alert-dismissible fade show" role="alert">
				  					<?php echo $_REQUEST['message']??"" ?>
				  					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  				</div>
							</div>
					    </div> 
						<?php } ?>
					    
					    <?php $forms->login_form(); ?>
					</div>
		        </div>
		      </div>
		    </div>
		  </div>
		</section>
    <!-- </div> -->
    <!-- Main Container:End -->
   
<?php 
	
	General::site_footer();

?>

  	