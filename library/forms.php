<?php

	class Forms
	{
		private $action 			= NULL;
		private $method 			= NULL;
		private $academic_degree 	= NULL;
		private $university 		= NULL;
		private $enrolled_year 		= NULL;

		public function __construct($action, $method)
		{
			$this->action = $action;
			$this->method = $method;
		}

		public function set_action($action)
		{
			$this->action = $action;
		}

		public function get_action()
		{
			return $this->action;
		}

		public function set_method($method)
		{
			$this->method = $method;
		}

		public function get_method()
		{
			return $this->method;
		}

		public function set_academic_degree($degree)
		{
			$this->academic_degree = $degree;
		}

		public function get_academic_degree()
		{
			return $this->academic_degree;
		}

		public function set_university($university)
		{
			$this->university = $university;
		}

		public function get_university()
		{
			return $this->university;
		}

		public function set_enrolled_year($enrolled_year)
		{
			$this->enrolled_year = $enrolled_year;
		}

		public function get_enrolled_year()
		{
			return $this->enrolled_year;
		}

		public function login_form()
		{
			?>
			<form action="<?php echo $this->get_action(); ?>" method="<?php echo $this->method; ?>">
				<div class="form-outline mb-4">
	              <input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" placeholder="Email" required="" />
	            </div>

	            <div class="form-outline mb-4">
	              <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" placeholder="Password" required="" />
	            </div>

	            <!-- <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button> -->
	            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg btn-block" />
			</form>

			<?php
		}

		/*Beneficiary Form :Start*/
		public function beneficiary_form()
		{

			
			?>
			<!-- Request To resubmit the form link:start -->
			<div class="row">
				<div class="col-sm-12">
					<p><a href="request_to_save_form.php?form=save_form" class="link-underline-light"><i class="bi bi-pencil-square"></i> Already saved, complete the submission process of the application.</a></p>
					<p><a href="request_to_resubmit_form.php" class="link-underline-light text-success"><i class="bi bi-pencil-square"></i> Already applied, request an admin to resubmit the application.</a></p>
				</div>
			</div>
			<!-- Request To resubmit the form link:end -->
			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			    <button class="nav-link active" id="nav-father-alive-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Applicant Father Information</button>
			    <button class="nav-link" id="nav-personal-info-tab" data-bs-toggle="tab" data-bs-target="#nav-personal-info" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" disabled>Applicant Information</button>
			  </div>
			</nav>
			<!-- <div class="container"> -->
				<!-- <div class="borde p-4 "> -->
					<div class="tab-content" id="nav-tabContent">

						<form class="row g-3" onsubmit="return validateForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">
							
							<!-- Tab 1 :Start -->
							<div class="tab-pane fade show active" id="nav-father-alive" role="tabpanel" aria-labelledby="nav-father-alive-tab" style="display:block;">

								<!-- Field: Applicant Is Father Alive:Start -->
									<!-- <div class="container"> -->
										<div class="row mt-3" id="first_tab">
										<label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
										<div class="col-sm-2 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input is_father_alive" type="radio" name="is_father_alive" value="Yes" <?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "Yes")?'checked':'';?>  >
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-2 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input is_father_alive" type="radio" name="is_father_alive" value="No" <?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-father-alive" style="display:<?php echo isset($_SESSION['error']['is_father_alive'])?'block':'none';  ?>">
									      	<?php echo $_SESSION['error']['is_father_alive']??''; ?>
									   	</div>
									   <!-- </div> -->
									<!-- Field: Applicant Is Father Alive:End -->

										   	 <!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):Start -->
										  		<div class="mt-3" id="death-certificate" style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
										  			<label class="form-label col-sm-12"><b>Scanned image of the father's death certificate issued by the authorized department <span class="text-danger">*</span></b></label>
											  		<div class="col-md-12 my-auto">
											  			<input type="file" name="applicant_father_death_certificate" id="death-certificate-file" class="form-control <?php echo isset($_SESSION['error']['death_certificate'])?'is-invalid':'';  ?>">
											  			<input type="hidden" name="hidden_father_death_certificate" value="<?php echo isset($father_death_certificate_image)?"1":"0"; ?>">
											  				<div  class="invalid-feedback col-sm-12" id="error-father-death-certificate">
											      			 
											   				</div>
											  		</div>
											  	</div>
										  	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):End -->


										  	<!-- Field: Applicant Father CNIC:Start -->
									  	  		<div class="mt-3" id="father_nationl_id_card" style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
									  	  		  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
									  	  		  	<div class="col-md-12 my-auto">
									  	  		    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['father_cnic'])?'is-invalid':'';  ?>" name="father_cnic" value="<?php echo $_SESSION['data']['father_cnic']??''; ?>" placeholder="Father National ID Card No">
									  	  			    <div class="invalid-feedback" id="error-father-cnic">
									  	  			      <?php echo $_SESSION['error']['father_cnic']??''; ?>
									  	  			    </div>
									  	  		  	</div>
									  	  		</div>
										  	<!-- Field: Applicant Father CNIC:End -->

										  	<!-- Field: Applicant Father Name:Start -->
										  		<label class="form-label col-sm-12" id="father_label" style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;"><b> Father Name <span class="text-danger">*</span></b></label>

								  			  	<div class="col-md-4 my-auto" id="father_first_name" style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
								  			    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_first_name'])?'is-invalid':'bottom-margin';  ?>" name="father_first_name" value="<?php echo $_SESSION['data']['father_first_name']??''; ?>" placeholder="First Name">
								  				    <div class="invalid-feedback" id="error-father-first-name">
								  				      <?php echo $_SESSION['error']['father_first_name']??''; ?>
								  				    </div>
								  			  	</div>

								  			  	<div class="col-md-4 my-auto" id="father_middle_name"style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
								  			    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_middle_name'])?'is-invalid':'bottom-margin';  ?>" name="father_middle_name" value="<?php echo $_SESSION['data']['father_middle_name']??''; ?>"  placeholder="Middle Name">
								  			    	<div class="invalid-feedback" id="error-father-middle-name">
								  			      	<?php echo $_SESSION['error']['father_middle_name']??''; ?>
								  			    	</div>
								  			  	</div>

								  			  	<div class="col-md-4 my-auto" id="father_last_name"style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
								  			    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_last_name'])?'is-invalid':'bottom-margin';  ?>" name="father_last_name" value="<?php echo $_SESSION['data']['father_last_name']??''; ?>"  placeholder="Last Name">
								  			    	<div class="invalid-feedback" id="error-father-last-name">
								  			      	<?php echo $_SESSION['error']['father_last_name']??''; ?>
								  			    	</div>
								  			  	</div>
											<!-- Field: Applicant Father Name:End -->

											<!-- Field: Applicant Father Occupation:Start -->
										  		<div class="" id="father_occupation" style="display:<?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
										  		  	<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
										  		  	<div class="col-md-12 my-auto">
										  		    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_occupation'])?'is-invalid':'';  ?>" name="father_occupation" value="<?php echo $_SESSION['data']['father_occupation']??''; ?>">
										  			    <div class="invalid-feedback" id="error-father-occupation">
										  			      	<?php echo $_SESSION['error']['father_occupation']??''; ?>
										  			    </div>
										  		  	</div>	
										  		</div>
											<!-- Field: Applicant Father Occupation:End -->


										  	<!-- Next Button :Start -->
										  	<div class="row mt-3">
										   		<div class="col-sm-10"></div>
						                        <div class="col-sm-2 text-right">
													<!--<button class="btn btn-prev myPrev border">
						                                <i class="ace-icon fa fa-arrow-left" disable></i>
						                                Prev
						                            </button> -->
						                            <button type="button" class="btn btn-success float-end" id="nextBtn" style="display:none;">
						                                Next
						                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
						                            </button>
						                        </div>
					                    	</div>
										  	<!-- Next Button :End -->

										  	<span class="invalid-feedback" id="" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;Note: To Submit Your Application, Please fill out the form appropriately</b></span>
										</div>
								<!-- </div> -->
							    <!-- Field: Applicant Is Father Alive:End -->
							</div>
							<!-- Tab 1 :End -->

							<!-- Tab 2 :Start -->
							<div class="tab-pane fade" id="nav-personal-info" role="tabpanel" aria-labelledby="nav-personal-info-tab">
							    <div class="row  mt-3" id="second_tab" style="display: none;" >
									<!-- Field: Name Of Applicant:Start -->
									  	<label class="form-label col-sm-12"><b>Name of Applicant <span class="text-danger">*</span></b></label>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['first_name'])?'is-invalid':'bottom-margin';  ?>" name="first_name" value="<?php echo $_SESSION['data']['first_name']??''; ?>" placeholder="First Name">
										    <div class="invalid-feedback" id="error-first-name">
										      <?php echo $_SESSION['error']['first_name']??''; ?>
										    </div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['middle_name'])?'is-invalid':'bottom-margin';  ?>" name="middle_name" value="<?php echo $_SESSION['data']['middle_name']??''; ?>" placeholder="Middle Name">
									    	<div class="invalid-feedback" id="error-middle-name">
									      	<?php echo $_SESSION['error']['middle_name']??''; ?>
									    	</div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['last_name'])?'is-invalid':'bottom-margin';  ?>" name="last_name" value="<?php echo $_SESSION['data']['last_name']??''; ?>" placeholder="Last Name">
									    	<div class="invalid-feedback" id="error-last-name">
									      	<?php echo $_SESSION['error']['last_name']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Name Of Applicant:End -->

								    <!-- Field: Applicant Gender:Start -->
								 		<label class="form-label col-sm-12"><b>Gender <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($_SESSION['data']['gender']) && $_SESSION['data']['gender'] == "Male")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Male
											  	</label>
												</div>
											</div>
										</div>
										<div class="col-sm-6 my-auto">
										    <div class="form-check">
											  <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($_SESSION['data']['gender']) && $_SESSION['data']['gender'] == "Female")?'checked':'';?>>
											  <label class="form-check-label">
											    Female
											  </label>
											</div>
										</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-gender" style="display:<?php echo isset($_SESSION['error']['gender'])?'block':'none';  ?>">
									      	<?php echo $_SESSION['error']['gender']??''; ?>
									   	</div>
								    <!-- Field: Applicant Gender:End -->

									<!-- Field: Applicant Contact Number:Start -->
									  	<label class="form-label col-sm-12"><b> Contact Number <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 923001234567)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['contact_number'])?'is-invalid':'';  ?>" name="contact_number" value="<?php echo $_SESSION['data']['contact_number']??''; ?>" placeholder="Phone Number">
									    	<div class="invalid-feedback" id="error-contact-number">
									      	<?php echo $_SESSION['error']['contact_number']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Contact Number:End -->

									<!-- Field: Applicant Contact Email:Start -->
									  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="email" class="form-control <?php echo isset($_SESSION['error']['email'])?'is-invalid':'';  ?>" id="email" name="email" value="<?php echo $_SESSION['data']['email']??''; ?>" placeholder="Email">
									    	<div class="invalid-feedback" id="error-email">
									      	<?php echo $_SESSION['error']['email']??''; ?>
									    	</div>
									    	<p id="email_already_exist" style="display:none"><a href="request_to_resubmit_form.php" class="link-underline-light"><i class="bi bi-pencil-square"></i> Already created an account, request an admin to resubmit the form.</a></p>
									    </div>
									<!-- Field: Applicant Contact Email:End -->

								    <!-- Field: Applicant Date of Birth:Start -->
									  	<label class="form-label col-sm-12"><b> Date of Birth <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="date" class="form-control <?php echo isset($_SESSION['error']['dob'])?'is-invalid':'';  ?>" name="date_of_birth" value="<?php echo $_SESSION['data']['date_of_birth']??''; ?>">
									    	<div class="invalid-feedback" id="error-dob">
									      	<?php echo $_SESSION['error']['dob']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Date of Birth:End -->

									<!-- Field: Applicant CNIC:Start -->
									  	<label class="form-label col-sm-12"><b> National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['app_cnic'])?'is-invalid':'';  ?>" name="applicant_cnic" value="<?php echo $_SESSION['data']['applicant_cnic']??''; ?>" placeholder="National ID Card No" id="cnic">
										    <div class="invalid-feedback" id="error-cnic">
										      <?php echo $_SESSION['error']['app_cnic']??''; ?>
										    </div>
									    	<p id="cnic_already_exist" style="display:none"><a href="request_to_resubmit_form.php" class="link-underline-light"><i class="bi bi-pencil-square"></i> Already created an account, request an admin to resubmit the form.</a></p>
										</div>
									<!-- Field: Applicant CNIC:End -->

									<!-- Field: Applicant CNIC Picture:Start -->
									  	<label class="form-label col-sm-12"><b>Scanned image of National ID Card No <span class="text-danger">*&nbsp;</span></b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_cnic_picture" class="form-control <?php echo isset($_SESSION['error']['applicant_cnic_picture'])?'is-invalid':'';  ?>">
										  	<input type="hidden" name="hidden_applicant_cnic_picture" value="<?php echo isset($applicant_cnic_image)?"1":"0"; ?>">
										  	<div class="invalid-feedback" id="error-applicant-cnic-picture">
										      <?php echo $_SESSION['error']['applicant_cnic_picture']??''; ?>
										    </div>
										  </div>
									<!-- Field: Applicant CNIC Picture:End -->



									<!-- Field: Applicant Current Address:Start -->
									  	<label class="form-label col-sm-12"><b> Current Address <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<textarea class="form-control <?php echo isset($_SESSION['error']['current_address'])?'is-invalid':'';  ?>" name="current_address"><?php echo $_SESSION['data']['current_address']??''; ?></textarea>
										    <div class="invalid-feedback" id="error-current-address">
										      <?php echo $_SESSION['error']['current_address']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Current Address:End -->

									<!-- Field: Applicant Permanent Address:Start -->
									  	<label class="form-label col-sm-12"><b> Permanent Address <span class="text-danger">*</span></b>

									  		<label class="form-check-label float-end"><span class="text-danger"> <input class="form-check-inputs" name="same_as_current_add" type="checkbox" <?php echo (isset($_SESSION['flag_for_address']) && $_SESSION['flag_for_address'] === true)?'checked':'';  ?>  value="Yes" >&nbsp;</span><b>Same As Current Address</b></label>

									  	</label>
									  	<div class="col-md-12 my-auto">
									    	<textarea class="form-control <?php echo isset($_SESSION['error']['permanent_address'])?'is-invalid':'';  ?>" name="permanent_address"  <?php echo (isset($_SESSION['flag_for_address']) && $_SESSION['flag_for_address'] === true)?'readonly':'';  ?>   ><?php echo $_SESSION['data']['permanent_address']??''; ?></textarea>
										    <div class="invalid-feedback" id="error-permanent-address">
										      <?php echo $_SESSION['error']['permanent_address']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Permanent Address:End -->

									<!-- Field: Applicant Picture:Start -->
									  	<label class="form-label col-sm-12"><b> Picture <span class="text-danger">*</span></b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_picture" class="form-control <?php echo isset($_SESSION['error']['applicant_picture'])?'is-invalid':'';  ?>">
										  	<input type="hidden" name="hidden_applicant_picture" value="<?php echo isset($applicant_picture)?"1":"0"; ?>">
										  	<div class="invalid-feedback" id="error-applicant-picture">
										      <?php echo $_SESSION['error']['applicant_picture']??''; ?>
										    </div>
										  </div>
									<!-- Field: Applicant Picture:End -->

									<!-- Field: Applicant Student ID Card Image:Start -->
									  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card <span class="text-danger">*</span></b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_student_id_card_image" class="form-control <?php echo isset($_SESSION['error']['applicant_student_id_card_image'])?'is-invalid':'';  ?>">
										  	<input type="hidden" name="hidden_student_id_card_image" value="<?php echo isset($applicant_student_id_card_image)?"1":"0"; ?>">
										  	<div class="invalid-feedback" id="error-applicant-student-id-card-image">
										      <?php echo $_SESSION['error']['applicant_student_id_card_image']??''; ?>
										    </div>
										  </div>
									<!-- Field: Applicant Student ID Card Image:End -->

									<!-- Field: Applicant Highest Academic Degree:Start -->
									  	<label class="form-label col-sm-12"><b> Highest Academic Degree <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									  		<select class="form-select <?php echo isset($_SESSION['error']['highest_degree'])?'is-invalid':'';  ?>" name="applicant_highest_academic_degree">
									      	<option value="">--Please Select--</option>
									      	<?php foreach($this->get_academic_degree() as $key => $degree){
									      	?>
									      		<option value="<?php echo $degree['academic_degree_id']; ?>" <?php echo (isset($_SESSION['data']['applicant_highest_academic_degree']) && $_SESSION['data']['applicant_highest_academic_degree'] == $degree['academic_degree_id'])?'selected':'';?> ><?php echo $degree['degree_title']; ?></option>
									      	<?php	
									      	}?>
									      	</select>
										    <div class="invalid-feedback" id="error-highest-degree">
										      <?php echo $_SESSION['error']['highest_degree']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Highest Academic Degree:End -->

									<!-- Field: Applicant Marksheet Image:Start -->
									  	<label class="form-label col-sm-12"><b>Scanned image of the last 2 academic records</b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_marksheet_images[]" class="form-control <?php echo isset($_SESSION['error']['applicant_marksheet_images'])?'is-invalid':'';  ?>" id="applicant-marksheet-images" multiple="">
										  	<div class="invalid-feedback" id="error-marksheet-images">
										      <?php echo $_SESSION['error']['applicant_marksheet_images']??''; ?>
										    </div>
										  </div>
									<!-- Field: Applicant Marksheet Image:End -->


									<!-- Field: Applicant Stipend For Non Muslim:Start -->
										<label  class="form-label col-sm-12" style="display: none" ><b>(Non-Muslim Only) I would like to apply for stipend</b></label>
										<div class="col-sm-6 my-auto" style="display: none">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
												  <input checked class="form-check-input" type="radio" name="stipend_for_non_muslim" value="Yes" <?php echo (isset($_SESSION['data']['stipend_for_non_muslim']) && $_SESSION['data']['stipend_for_non_muslim'] == "Yes")?'checked':'';?>>
												  <label class="form-check-label">
												    Yes
												  </label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto" style="display: none">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="stipend_for_non_muslim" value="No" <?php echo (isset($_SESSION['data']['stipend_for_non_muslim']) && $_SESSION['data']['stipend_for_non_muslim'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									<!-- Field: Applicant Stipend For Non Muslim:End -->


									<!-- Field: Applicant Eligible For Zakat:Start -->
										<label class="form-label col-sm-12"><b>(Muslim Only) Is the applicant eligible to receive zakat?</b></label>
										<div class="col-sm-6  my-auto">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
												  <input class="form-check-input" type="radio" name="eligible_for_zakat" value="Yes" <?php echo (isset($_SESSION['data']['eligible_for_zakat']) && $_SESSION['data']['eligible_for_zakat'] == "Yes")?'checked':'';?>>
												  <label class="form-check-label">
												    Yes
												  </label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="eligible_for_zakat" value="No" <?php echo (isset($_SESSION['data']['eligible_for_zakat']) && $_SESSION['data']['eligible_for_zakat'] == "No")?'checked':'';?> >
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									<!-- Field: Applicant Eligible For Zakat:End -->

									<!-- Field 1: Applicant Eligible For Zakat (If Yes):Start -->
									  	<div id="zakat-reason-box" style="display:<?php echo (isset($_SESSION['data']['eligible_for_zakat']) && $_SESSION['data']['eligible_for_zakat'] == "Yes")?'block':'none';?>;">
									  		<label  class="form-label col-sm-12 zakat-dependent-class"><b>Why <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['reason_for_zakat'])?'is-invalid':'';  ?>" name="reason_for_zakat" value="<?php echo $_SESSION['data']['reason_for_zakat']??''; ?>">
										    	<div class="invalid-feedback" id="error-reason-zakat">
										      	<?php echo $_SESSION['error']['reason_for_zakat']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 1: Applicant Eligible For Zakat (If Yes):End -->

									<!-- Field: Is Applicant Current Enrolled In University:Start -->
										<label  class="form-label col-sm-12"><b>Currently enrolled at university? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6  my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="Yes" <?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6  my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="No" <?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-currently-enrolled-uni" style="display:<?php echo isset($_SESSION['error']['is_currently_enrolled_in_uni'])?'block':'none';  ?>;">
									      	<?php echo $_SESSION['error']['is_currently_enrolled_in_uni']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Current Enrolled In University:End -->

									

									<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>In which university? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<select class="form-select <?php echo isset($_SESSION['error']['univerity'])?'is-invalid':'';  ?>" name="univerity">
									      			<option value="">--Please Select--</option>
									      			<?php foreach($this->get_university() as $key => $univerity){?>
												      		<option value="<?php echo $univerity['university_id']; ?>" <?php echo (isset($_SESSION['data']['univerity']) && $_SESSION['data']['univerity'] == $univerity['university_id'])?'selected':'';?> >
												      			<?php echo $univerity['university_name']; ?>
												      		</option>
												    <?php } ?>
									    		</select>
									    		<div class="invalid-feedback" id="error-university">
										      	<?php echo $_SESSION['error']['univerity']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):End -->

									<!-- Field 2: In Which Year (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>In which year currently studying? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<select class="form-select <?php echo isset($_SESSION['error']['univerity_year'])?'is-invalid':'';  ?>" name="univerity_year">
									      		<option value="">--Please Select--</option>
									      		<?php foreach($this->get_enrolled_year() as $key => $year){?>
									      			<option value="<?php echo $year['current_enrolled_year_id']; ?>" <?php echo (isset($_SESSION['data']['univerity_year']) && $_SESSION['data']['univerity_year'] == $year['current_enrolled_year_id'])?'selected':'';?> > 
									      				<?php echo $year['enrolled_year']; ?>
									      			</option>
									      		<?php } ?>	
									    		</select>
									    		<div class="invalid-feedback" id="error-university-year">
										      	<?php echo $_SESSION['error']['univerity_year']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 2: Which Uiversity Enrolled (If Current Enrolled Uni Yes):End -->

									<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>In which month and year the current degree will be completed? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" data-date-format="MM yyyy" id='txtDate' class="form-control <?php echo isset($_SESSION['error']['degree_completed_year'])?'is-invalid':'';  ?>" name="degree_completed_year" value="<?php echo $_SESSION['data']['degree_completed_year']??''; ?>">
									    		<div class="invalid-feedback" id="error-degree-year">
									      		<?php echo $_SESSION['error']['degree_completed_year']??''; ?>
									    		</div>
									  		</div>
									  		
									  	</div>
									<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):End -->

									<!-- Field 4: Degree Yearly Expenses (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['data']['is_currently_enrolled_in_uni']) && $_SESSION['data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>Total yearly educational expenses</b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control" name="degree_yearly_expenses" value="<?php echo $_SESSION['data']['degree_yearly_expenses']??''; ?>" />
									    	</div>
									  	</div>
									<!-- Field 4: Yearly Expenses (If Currently Enrolled Uni Yes):End -->

									<!-- Field: Applicant Univeristy Admission:Start -->
										<label class="form-label col-sm-12"><b> University Admission <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="applicant_university_admission" value="Merit" <?php echo (isset($_SESSION['data']['applicant_university_admission']) && $_SESSION['data']['applicant_university_admission'] == "Merit")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Merit-Based
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="applicant_university_admission" value="Self" <?php echo (isset($_SESSION['data']['applicant_university_admission']) && $_SESSION['data']['applicant_university_admission'] == "Self")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Self-Support
											  	</label>
												</div>
									  	</div>
									  	<div class="invalid-feedback col-sm-12" id="error-uni-admission" style="display:<?php echo isset($_SESSION['error']['applicant_university_admission'])?'block':'none';  ?>;">
									      	<?php echo $_SESSION['error']['applicant_university_admission']??''; ?>
									   	</div>
									<!-- Field: Applicant Univeristy Admission:End -->


									<!-- Field: Is Applicant Current Working:Start -->
										<label class="form-label col-sm-12"><b>Currently working? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="is_currently_working" value="Yes" <?php echo (isset($_SESSION['data']['is_currently_working']) && $_SESSION['data']['is_currently_working'] == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	 <div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="is_currently_working" value="No" <?php echo (isset($_SESSION['data']['is_currently_working']) && $_SESSION['data']['is_currently_working'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	 </div>
									  	 <div  class="invalid-feedback col-sm-12" id="error-currently-working" style="display:<?php echo (isset($_SESSION['error']['is_currently_working']))?'block':'none';?>;">
									      	<?php echo $_SESSION['error']['is_currently_working']??''; ?>
									   	 </div>
									<!-- Field: Is Applicant Current Working:End -->			  

									<!-- Field 1: How Much (If Currently Working Uni Yes):Start -->
									  	<div id="current-working-box" style="display:<?php echo (isset($_SESSION['data']['is_currently_working']) && $_SESSION['data']['is_currently_working'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>If yes, how much money earn per month <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['how_much_earning'])?'is-invalid':'';  ?>" name="how_much_earning" value="<?php echo $_SESSION['data']['how_much_earning']??''; ?>">
									    		<div class="invalid-feedback" id="error-how-much-earning">
									      		<?php echo $_SESSION['error']['how_much_earning']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: How Much (If Currently Working Uni Yes):End -->

									<!-- Field: Is Applicant Have Any Skill Or Training:Start -->
										<label class="form-label col-sm-12"><b>Have any skills or completed any skilful training? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="applicant_skill" value="Yes" <?php echo (isset($_SESSION['data']['applicant_skill']) && $_SESSION['data']['applicant_skill'] == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="applicant_skill" value="No" <?php echo (isset($_SESSION['data']['applicant_skill']) && $_SESSION['data']['applicant_skill'] == "No")?'checked':'';?> >
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-skill" style="display:<?php echo (isset($_SESSION['error']['applicant_skill']))?'block':'none';?>;">
									      	<?php echo $_SESSION['error']['applicant_skill']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Have Any Skill Or Training:End -->

									<!-- Field 1: What Skill (If Applicant Skill Yes):Start -->
									  	<div id="skill-box" style="display:<?php echo (isset($_SESSION['data']['applicant_skill']) && $_SESSION['data']['applicant_skill'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>If yes, what? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['what_skill'])?'is-invalid':'';  ?>" name="what_skill" value="<?php echo $_SESSION['data']['what_skill']??''; ?>">
									    		<div class="invalid-feedback" id="error-what-skill">
									      		<?php echo $_SESSION['error']['what_skill']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: What Skill (If Applicant Skill Yes):End -->

									<!-- Field: Is Applicant Recieved Any Financial Help:Start -->
										<label class="form-label col-sm-12"><b>Received any financial help from other sources besides parents such as government or university, in last 2 years? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="financial_help" value="Yes" <?php echo (isset($_SESSION['data']['financial_help']) && $_SESSION['data']['financial_help'] == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="financial_help" value="No" <?php echo (isset($_SESSION['data']['financial_help']) && $_SESSION['data']['financial_help'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-financial-help" style="display:<?php echo (isset($_SESSION['error']['financial_help']))?'block':'none';?>">
									      	<?php echo $_SESSION['error']['financial_help']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Recieved Any Financial Help:End -->

									<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):Start -->
									  	<div class="financial-box" style="display:<?php echo (isset($_SESSION['data']['financial_help']) && $_SESSION['data']['financial_help'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>If yes, how much? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['how_much_financial_help'])?'is-invalid':'';  ?>" name="how_much_financial_help" value="<?php echo $_SESSION['data']['how_much_financial_help']??''; ?>">
									    		<div class="invalid-feedback" id="error-how-much-financial-help">
									      		<?php echo $_SESSION['error']['how_much_financial_help']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):End -->
									  
									<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):Start -->
									  	<div class="financial-box" style="display:<?php echo (isset($_SESSION['data']['financial_help']) && $_SESSION['data']['financial_help'] == "Yes")?'block':'none';?>;">
									  		<label class="form-label col-sm-12"><b>From where? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['from_where_financial_help'])?'is-invalid':'';  ?>" name="from_where_financial_help" value="<?php echo $_SESSION['data']['from_where_financial_help']??''; ?>">
									    		<div class="invalid-feedback" id="error-from-where-financial-help">
									      		<?php echo $_SESSION['error']['from_where_financial_help']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):End -->

									<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):Start -->
										  	<div class="financial-box" style="display:<?php echo (isset($_SESSION['data']['financial_help']) && $_SESSION['data']['financial_help'] == "Yes")?'block':'none';?>;">
										  		<label class="form-label col-sm-12"><b>Scanned image of the notification of financial help <span class="text-danger">*</span></b></label>
										  		<div class="col-md-12 my-auto">
										    		<input type="file" class="form-control <?php echo isset($_SESSION['error']['financial_help_image'])?'is-invalid':'';  ?>" name="financial_help_image">
										    		<input type="hidden" name="hidden_financial_image_help" value="<?php echo isset($financial_help_image)?"1":"0"; ?>">
										    		<div class="invalid-feedback" id="error-financial-help-image">
										      		<?php echo $_SESSION['error']['financial_help_image']??''; ?>
										    		</div>
										  		</div>
										  	</div>
									<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):End -->			  

									<!-- Field: Total Number Of Family Members:Start -->
										  	<label class="form-label col-sm-12"><b>Total Number of Family Members <span class="text-danger">*</span></b></label>
										  	<div class="col-md-4 my-auto">
										    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['adult'])?'is-invalid':'bottom-margin';  ?>" name="adult" value="<?php echo $_SESSION['data']['adult']??''; ?>" placeholder="Adults" min="" id="adult_member">
										    	<div class="invalid-feedback" id="error-adult">
										      	<?php echo $_SESSION['error']['adult']??''; ?>
										    	</div>
										  	</div>
										  	<div class="col-md-4 my-auto">
										    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['children_under_age'])?'is-invalid':'bottom-margin';  ?>" name="children_under_age" value="<?php echo $_SESSION['data']['children_under_age']??''; ?>" placeholder="Children Under 18" min="" id="under_18_member">
										    	<div class="invalid-feedback" id="error-children-under-age">
										      	<?php echo $_SESSION['error']['children_under_age']??''; ?>
										    	</div>
										  	</div>

										  	<div class="col-md-4 my-auto">
										    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['total_family_member'])?'is-invalid':'bottom-margin';  ?>" name="total_family_member" value="<?php echo $_SESSION['data']['total_family_member']??''; ?>" placeholder="Total" id="total_family_member" disabled>
											    <div class="invalid-feedback" id="error-total-family-members">
											     <?php echo $_SESSION['error']['total_family_member']??''; ?>
											    </div>
										  	</div>
									<!-- Field: Total Number Of Family Members:End -->

									<!-- Field: Total Monthly Family Income:Start -->
										  	<label class="form-label col-sm-12"><b>Total Monthly Family Income <span class="text-danger">*</span></b></label>
										  	<div class="col-md-12 my-auto">
										    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['total_family_monthly_income'])?'is-invalid':'bottom-margin';  ?>" name="total_family_monthly_income" value="<?php echo $_SESSION['data']['total_family_monthly_income']??''; ?>" placeholder="Total Amount">
											    <div class="invalid-feedback" id="error-total-family-monthly-income">
											      <?php echo $_SESSION['error']['total_family_monthly_income']??''; ?>
											    </div>
										  	</div>
										  	
									<!-- Field: Total Monthly Family Income:End -->



									<!-- Field: How many earning members in the family:Start -->
										<label class="form-label col-sm-12"><b>How many earning members in the family? <span class="text-danger">*</span></b></label>
										<div class="col-md-12">
									  	<input type="text" class="form-control <?php echo isset($_SESSION['error']['how_many_earning_members'])?'is-invalid':'bottom-margin';  ?>" name="how_many_earning_members" value="<?php echo $_SESSION['data']['how_many_earning_members']??''; ?>" placeholder="Total earning members in the family">
									  	<div class="invalid-feedback" id="error-how-many-earning-members">
									    	<?php echo $_SESSION['error']['how_many_earning_members']??''; ?>
									  	</div>
										</div>
									<!-- Field: How many earning members in the family:End -->

									<!-- Field 1: Applicant Family Registration Certificate:Start -->
										<div class="" id="nadra-family-registration-certificate">
								  			<label class="form-label col-sm-12"><b>Scanned image of the nadra family registration certificate <span class="text-danger">*</span></b></label>
								  			<div class="col-md-12 my-auto">
									  			<input type="file" name="nadra_family_registration_certificate" id="nadra-frc-file" class="form-control <?php echo isset($nadra_family_registration_certificate)?'':'';  ?>">
									  			<input type="hidden" name="hidden_nadra_family_registration_certificate" value="<?php echo isset($nadra_family_registration_certificate)?"1":"0"; ?>">
									  			<div  class="invalid-feedback col-sm-12" id="error-frc" style="display:<?php echo isset($_SESSION['error']['nadra_family_registration_certificate'])?'block':'none';  ?>"> <?php echo $_SESSION['error']['nadra_family_registration_certificate']??''; ?> 
									  			</div>
									  		</div>
										</div>
									<!-- Field 1: Applicant Family Registration Certificate:End -->

									<!-- Field 2: Applicant Income Document:Start -->
								  		<div class="" id="income-certificate">
								  			<label class="form-label col-sm-12"><b>Scanned image of the income document <span class="text-danger">*</span></b></label>
								  			<div class="col-md-12 my-auto">
									  			<input type="file" name="income_document" id="income-file" class="form-control <?php echo isset($income_document)?'':'';  ?>">
									  			<input type="hidden" name="hidden_income_document" value="<?php echo isset($income_document)?"1":"0"; ?>">
									  			<div  class="invalid-feedback col-sm-12" id="error-income"style="display:<?php echo isset($_SESSION['error']['income_document'])?'block':'none';?>"> <?php echo $_SESSION['error']['income_document']??''; ?>
									  			</div>
									  		</div>
									  	</div>
							  		<!-- Field 2: Applicant Income Document:End -->

							  		<!-- Field 3: Applicant Father NIC:Start -->
					  		  	  		<div class="" id="father-nic">
					  		  	  			<label class="form-label col-sm-12"><b>Scanned image of the father national id card <span class="text-danger">*</span></b></label>
					  		  	  			<div class="col-md-12 my-auto">
					  		  		  			<input type="file" name="father_national_id_card" id="father-nic-file" class="form-control <?php echo isset($father_national_id_card)?'':'';  ?>">
					  		  		  			<input type="hidden" name="hidden_father_national_id_card" value="<?php echo isset($father_national_id_card)?"1":"0"; ?>">
					  		  		  			<div  class="invalid-feedback col-sm-12" 
					  		  		  			id="error-father-cnic-card"style="display:<?php echo isset($_SESSION['error']['father_national_id_card'])?'block':'none';  ?>"><?php echo $_SESSION['error']['father_national_id_card']??''; ?>
					  		  		  			</div>
					  		  		  		</div>
					  		  		  	</div>
					  		  		<!-- Field 3: Applicant Father NIC:End -->

					  		  		<!-- Bank Account Info :Start -->
					  		  			<h4 class="text-success fw-bolder mt-5">Bank Account Info</h4>
						  		  		<!-- Field Bank Name:Start -->
						  		  			<div class="" id="">
						  		  	  			<label class="form-label col-sm-12" ><b>Bank Name<span class="text-danger"></span></b></label>
						  		  	  			<div class="col-md-12 my-auto">
						  		  		  			<input type="text" name="bank_name" id="bank-name" placeholder='Bank Name' value="<?php echo $_SESSION['data']['bank_name']??''; ?>" class="form-control" >
						  		  		  			<div  class="invalid-feedback col-sm-12" id="error-">
						  		  		  			</div>
						  		  		  		</div>
						  		  		  	</div>
						  		  		<!-- Field Bank Name :End -->

						  		  		<!-- Field Bank Branch Name:Start -->
						  		  			<div class="" id="">
						  		  	  			<label class="form-label col-sm-12"><b>Bank Branch Name<span class="text-danger"></span></b></label>
						  		  	  			<div class="col-md-12 my-auto">
						  		  		  			<input type="text" name="bank_branch_name" id="bank-branch-name" placeholder='Branch Name' class="form-control" value="<?php echo $_SESSION['data']['bank_branch_name']??''; ?>" class="form-control">
						
						  		  		  			<div  class="invalid-feedback col-sm-12" id="error-">
						  		  		  			</div>
						  		  		  		</div>
						  		  		  	</div>
						  		  		<!-- Field Bank Branch Name :End -->

						  		  		<!-- Field Bank Account Title :Start -->
						  		  			<div class="" id="">
						  		  	  			<label class="form-label col-sm-12"><b>Bank Account Title<span class="text-danger"></span></b></label>
						  		  	  			<div class="col-md-12 my-auto">
						  		  		  			<input type="text" name="bank_account_title" id="bank-account-title" placeholder='Account Title' class="form-control" value="<?php echo $_SESSION['data']['bank_account_title']??''; ?>">
						
						  		  		  			<div  class="invalid-feedback col-sm-12" id="error-">
						  		  		  			</div>
						  		  		  		</div>
						  		  		  	</div>
						  		  		<!-- Field Bank Account Title :End -->

						  		  		<!-- Field Bank Account Number :Start -->
						  		  			<div class="" id="">
						  		  	  			<label class="form-label col-sm-12"><b>Bank Account Number<span class="text-danger"></span></b></label>
						  		  	  			<div class="col-md-12 my-auto">
						  		  		  			<input type="text" name="bank_account_number" id="bank-account-number" placeholder='Account Number' class="form-control" value="<?php echo $_SESSION['data']['bank_account_number']??''; ?>">
						
						  		  		  			<div  class="invalid-feedback col-sm-12" id="error-">
						  		  		  			</div>
						  		  		  		</div>
						  		  		  	</div>
						  		  		<!-- Field Bank Account Number :End -->
					  		  		<!-- Bank Account Info :Start -->

					  		  		<!-- Field Hidden For Validation Check :Start -->
					  		  			  	<div class="hidden">
					  		  			  		<div class="col-md-12">
					  		  			  			<input type="hidden" name="hidden_value" value="0">
					  		  			  		</div>
					  		  			  	</div>
					  		  		<!-- Field Hidden For Validation Check :End -->

									<!-- MOU:Start -->
										  	<div class="col-md-12 mt-5">
										  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
										  	<ol>
													<li class="text-black">Applicant should be an orphan.</li>
													<li class="text-black">Must be taking classes full-time.</li>
													<li class="text-black">If doing a full-time or part-time job must declare the details to Hidaya.</li>
													<li class="text-black">In case of getting any scholarship or stipend from other sources, monthly or one-time, must declare to Hidaya.</li>
													<li class="text-black">In case of failure to inform Hidaya, Hidaya reserves the right to stop supporting or blacklist the applicant.</li>
													<li class="text-black">Any incorrect information provided by the applicant will be the reason for the rejection of the application.</li>
												</ol>
										  	</div>
									<!-- MOU:End -->

									<!-- Agree Checkbox:Start -->
									  	<label class="form-label col-sm-12 ms-4"><b>Memorandum of Understanding (MOU) Terms Agreement <span class="text-danger">*</span></b></label>
										  <div class="col-md-12 my-auto ms-4">
										    <div class="form-check">
										      <input class="form-check-input <?php echo (isset($_SESSION['data']['agreement']) && $_SESSION['data']['agreement'] == "Yes")?'is-valid':'is-invalid';  ?>" name="agreement" type="checkbox" value="Yes" <?php echo (isset($_SESSION['data']['agreement']) && $_SESSION['data']['agreement'] == "Yes")?'checked':'';?>>
										      <label class="form-check-label">
										        I state that I have read and understood the terms and conditions.
										      </label>
										      <div class="invalid-feedback" style="display:<?php echo (isset($_SESSION['error']['agreement']))?'block':'none';?>;" id="error-agreement">
										        You must agree before submitting.
										      </div>
										    </div>
										  </div>
									<!-- Agree Checkbox:End -->

								  	<!-- Buttons Start -->
									  	<div class="col-md-12 ms-4 mb-5 mt-4">
										    <button class="btn btn-success" type="submit" name="submit" value="submit" id="submit-btn">Submit</button>
										    <button class="btn btn-primary" id="save-btn" style="display:<?php echo (isset($_SESSION['data']['email']))?'inline;':'none';?>;" 
										     type="submit" name="save" value="save">Save</button>
										    <span class="invalid-feedback" id="error-appropriate" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;To Submit Your Application, Please fill out the form appropriately</b></span>
										    <!-- <input type="submit" class="btn btn-primary" name="submit" value="Submit"> -->
								  		</div>
									<!-- Buttons End -->


								</div>
							</div>
							<!-- Tab 2 :End -->

						</form>
					</div>
				<!-- </div> -->
			<!-- </div> -->
			<?php
		}
		/*Beneficiary Form :End*/


		public function request_to_resubmit_form()
		{
			?>
				<form class="row g-3" onsubmit="return validateRequestToResubmitForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>">

					<!-- Field: Applicant Contact Email:Start -->
					  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
					  	<div class="col-md-12 my-auto">
					    	<input type="email" class="form-control <?php echo isset($_SESSION['error']['email'])?'is-invalid':'';  ?>" id="email" name="email" value="<?php echo $_SESSION['data']['email']??''; ?>" placeholder="Email">
					    	<div class="invalid-feedback" id="error-email">
					      	<?php echo $_SESSION['error']['email']??''; ?>
					    	</div>
					    </div>
					<!-- Field: Applicant Contact Email:End -->

					<!-- Field: Applicant CNIC:Start -->
					  	<label class="form-label col-sm-12"><b> National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
					  	<div class="col-md-12 my-auto">
					    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['app_cnic'])?'is-invalid':'';  ?>" name="applicant_cnic" value="<?php echo $_SESSION['data']['applicant_cnic']??''; ?>" placeholder="National ID Card No" id="cnic">
						    <div class="invalid-feedback" id="error-cnic">
						      <?php echo $_SESSION['error']['app_cnic']??''; ?>
						    </div>
					    </div>
					<!-- Field: Applicant CNIC:End -->

					<!-- Submit Button:Start -->
					  	<div class="col-md-12 mb-5 mt-4 text-center">
					    	<button class="btn btn-primary" type="submit" name="submit">Submit</button>
					    	<a  href="index.php" class="btn btn-secondary" >Cancel</a>
					    </div>
					<!-- Submit Button:End -->

				</form>
			<?php
		}

		/*Beneficiary Edit Form :Start*/
		public function beneficiary_edit_form($data = null)
		{
			if(is_array($data)){
				extract($data);
			}
			?>
			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			    <button class="nav-link active" id="nav-father-alive-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Applicant Father Information</button>
			    <button class="nav-link" id="nav-personal-info-tab-edit" data-bs-toggle="tab" data-bs-target="#nav-personal-info-edit" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Applicant Information</button>
			  </div>
			</nav>
			
			<div class="tab-content" id="nav-tabContent">

				<form class="row g-3" onsubmit="return validateBeneficiaryEditForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">
					
					<!-- Tab 1 :Start -->
					<div class="tab-pane fade show active" id="nav-father-alive" role="tabpanel" aria-labelledby="nav-father-alive-tab" style="display:block;">

						<div class="row mt-3" id="first_tab">
							<!-- Field: Applicant Is Father Alive:Start -->
								<label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
								<div class="col-sm-2 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input id="edit_father_alive" class="form-check-input is_father_alive_edit" type="radio" name="is_father_alive" value="Yes" <?php echo (isset($is_father_alive) && $is_father_alive == "Yes")?'checked':'';?>  >
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-2 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input is_father_alive_edit" type="radio" name="is_father_alive" value="No" <?php echo (isset($is_father_alive) && $is_father_alive == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-father-alive" style="display:block ;">
							  		Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.
							    </div>
							<!-- Field: Applicant Is Father Alive:End -->

						   	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):Start -->
							  		<div class="mt-3" id="father-death-certificate-file" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
							  			<label class="form-label col-sm-12"><b>Scanned image of the father's death certificate issued by the authorized department <span class="text-danger">*</span></b>  <span> 
							  				<?php if((pathinfo($father_death_certificate_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>	
							  				<img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class=" border border-dark rounded border border-dark" alt="No Image" width="40px" height="40px" /> </span> 
							  				<?php else: ?>
                                            	<a target="_blank" href="<?php echo $father_death_certificate_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                            <?php endif; ?>
							  			</label>
							  			<div class="col-md-12 my-auto">
								  			<input type="file" name="applicant_father_death_certificate" id="f-death-certificate-file" class="form-control <?php echo isset($father_death_certificate_image)?'':'is-invalid';  ?>">
								  				<div  class="invalid-feedback col-sm-12" id="error-father-death-certificate"></div>
								  		</div>
								  	</div>
						  	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):End -->

							<!-- Field: Applicant Father CNIC:Start -->
							  	<div class="mt-3" id="father_nic" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
							  	  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
							  	  	<div class="col-md-12 my-auto">
							  	    	<input type="number" class="form-control" name="father_cnic" value="<?php echo $father_cnic??''; ?>" placeholder="Father National ID Card No">
							  		    <div class="invalid-feedback" id="error-father-cnic">
							  		    </div>
							  	  	</div>
							  	</div>
						  	<!-- Field: Applicant Father CNIC:End -->

						  	<!-- Field: Applicant Father Name:Start -->
						  	  	<label class="form-label col-sm-12" id="father_label"><b> Father Name <span class="text-danger">*</span></b></label>
						  	  	<div class="col-md-4 my-auto" id="f_first_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_first_name" value="<?php echo $father_first_name??''; ?>" placeholder="First Name">
						  		    <div class="invalid-feedback" id="error-father-first-name">
						  		    </div>
						  	  	</div>
						  	  	<div class="col-md-4 my-auto" id="f_middle_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_middle_name" value="<?php echo $father_middle_name??''; ?>"  placeholder="Middle Name">
						  	    	<div class="invalid-feedback" id="error-father-middle-name">
						  	      	</div>
						  	  	</div>
						  	  	<div class="col-md-4 my-auto" id="f_last_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_last_name" value="<?php echo $father_last_name??''; ?>"  placeholder="Last Name">
						  	    	<div class="invalid-feedback" id="error-father-last-name">
						  	      	</div>
						  	  	</div>
						  	<!-- Field: Applicant Father Name:End -->

						  	<!-- Field: Applicant Father Occupation:Start -->
						  		<div class="mt-3" id="father_occupations" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	  		<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
						  	  		<div class="col-md-12 my-auto">
						  	    		<input type="text" class="form-control" name="father_occupation" value="<?php echo $father_occupation??''; ?>">
						  		    	<div class="invalid-feedback" id="error-father-occupation">
						  		      	</div>
						  	  		</div>
						  	  	</div>
						  	<!-- Field: Applicant Father Occupation:End -->

							<!-- Next Button :Start -->
						  	<div class="row mt-3">
						   		<div class="col-sm-10"></div>
		                        <div class="col-sm-2 text-right">
									<button type="button" class="btn btn-success float-end" id="nextBtn-edit" style="display:<?php?>">
		                                Next
		                            </button>
		                        </div>
	                    	</div>
						  	<!-- Next Button :End -->

							<span class="invalid-feedback" id="" style="display:none;"><b>&nbsp;&nbsp;Note: To Submit Your Application, Please fill out the form appropriately</b></span>
						</div>
					</div>
					<!-- Tab 1 :End -->

					<!-- Tab 2 :Start -->
					<div class="tab-pane fade" id="nav-personal-info-edit" role="tabpanel" aria-labelledby="nav-personal-info-tab-edit">
					    <div class="row  mt-3">
							<!-- Field: Name Of Applicant:Start -->
							  	<label class="form-label col-sm-12"><b>Name of Applicant <span class="text-danger">*</span></b></label>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['first_name'])?'is-invalid':'bottom-margin';  ?>" name="first_name" value="<?php echo $applicant_first_name??''; ?>" placeholder="First Name">
								    <div class="invalid-feedback" id="error-first-name">
								    	<?php echo $_SESSION['error']['first_name']??''; ?>
								    </div>
							  	</div>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['middle_name'])?'is-invalid':'bottom-margin';  ?>" name="middle_name" value="<?php echo $applicant_middle_name??''; ?>" placeholder="Middle Name">
							    	<div class="invalid-feedback" id="error-middle-name">
							    		<?php echo $_SESSION['error']['middle_name']??''; ?>
							      	</div>
							  	</div>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['last_name'])?'is-invalid':'bottom-margin';  ?>" name="last_name" value="<?php echo $applicant_last_name??''; ?>" placeholder="Last Name">
							    	<div class="invalid-feedback" id="error-last-name">
							    		<?php echo $_SESSION['error']['last_name']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Name Of Applicant:End -->

						    <!-- Field: Applicant Gender:Start -->
						 		<label class="form-label col-sm-12"><b>Gender <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($applicant_gender) && $applicant_gender == "Male")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Male
									  	</label>
										</div>
									</div>
								</div>
								<div class="col-sm-6 my-auto">
								    <div class="form-check">
									  <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($applicant_gender) && $applicant_gender == "Female")?'checked':'';?>>
									  <label class="form-check-label">
									    Female
									  </label>
									</div>
								</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-gender" style="display:none;">

							    </div>
						    <!-- Field: Applicant Gender:End -->

							<!-- Field: Applicant Contact Number:Start -->
							  	<label class="form-label col-sm-12"><b> Contact Number <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 923001234567)</span></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="number" class="form-control" name="contact_number" value="<?php echo $applicant_contact_number??''; ?>" placeholder="Phone Number">
							    	<div class="invalid-feedback" id="error-contact-number">
							    		<?php echo $_SESSION['error']['contact_number']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Applicant Contact Number:End -->

							<!-- Field: Applicant Contact Email:Start -->
							  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="email" class="form-control" id="email" name="email" value="<?php echo $applicant_email??''; ?>" placeholder="Email">
							    	<div class="invalid-feedback" id="error-email">
							    		<?php echo $_SESSION['error']['email']??''; ?>
							      	</div>
							    </div>
							<!-- Field: Applicant Contact Email:End -->

						    <!-- Field: Applicant Date of Birth:Start -->
							  	<label class="form-label col-sm-12"><b> Date of Birth <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="date" class="form-control" name="date_of_birth" value="<?php echo $applicant_date_of_birth??''; ?>">
							    	<div class="invalid-feedback" id="error-dob">
							    		<?php echo $_SESSION['error']['dob']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Applicant Date of Birth:End -->

							<!-- Field: Applicant CNIC:Start -->
							  	<label class="form-label col-sm-12"><b> National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="number" class="form-control" name="applicant_cnic" value="<?php echo $applicant_cnic??''; ?>" placeholder="National ID Card No" id="cnic">
								    <div class="invalid-feedback" id="error-cnic">
								    	<?php echo  $_SESSION['error']['app_cnic']??''; ?>
								    </div>
								</div>
							<!-- Field: Applicant CNIC:End -->

							<!-- Field: Applicant CNIC Picture:Start -->
							  	<label class="form-label col-sm-12"><b>Scanned image of National ID Card No <span class="text-danger">*&nbsp;</span></b> <span> 
							  		<?php if((pathinfo($applicant_cnic_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  		<img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded border border-dark" width="40px" height="40px" />
									<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_cnic_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?> 
							  	</span>  
							  	</label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_cnic_picture" class="form-control">
								  	<div class="invalid-feedback" id="error-applicant-cnic-picture" style="display:<?php echo isset($_SESSION['error']['applicant_cnic_picture'])?'block':'';  ?>;">
								  		<?php echo  $_SESSION['error']['applicant_cnic_picture']??''; ?>
								    </div>
								  </div>
							<!-- Field: Applicant CNIC Picture:End -->

							<!-- Field: Applicant Current Address:Start -->
							  	<label class="form-label col-sm-12"><b> Current Address <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<textarea class="form-control" name="current_address" <?php echo ($applicant_permanent_address === $applicant_current_address)?'readonly':'';  ?>><?php echo $applicant_current_address??''; ?></textarea>
								    <div class="invalid-feedback" id="error-current-address">
								    	<?php echo  $_SESSION['error']['current_address']??''; ?>
								    </div>
							  	</div>
							<!-- Field: Applicant Current Address:End -->

							<!-- Field: Applicant Permanent Address:Start -->
							  	<label class="form-label col-sm-12"><b> Permanent Address <span class="text-danger">*</span></b>

							  		<label class="form-check-label float-end"><span class="text-danger"> <input class="form-check-inputs" name="same_as_current_add" type="checkbox" <?php echo ($applicant_permanent_address === $applicant_current_address)?'checked':'';  ?>  value="Yes" >&nbsp;</span><b>Same As Current Address</b></label>

							  	</label>
							  	<div class="col-md-12 my-auto">
							    	<textarea class="form-control" name="permanent_address"  <?php echo ($applicant_permanent_address === $applicant_current_address)?'readonly':'';  ?>   ><?php echo $applicant_permanent_address??''; ?></textarea>
								    <div class="invalid-feedback" id="error-permanent-address">
								    	<?php echo $_SESSION['error']['permanent_address']??''; ?>
								    </div>
							  	</div>
							<!-- Field: Applicant Permanent Address:End -->

							<!-- Field: Applicant Picture:Start -->
							  	<label class="form-label col-sm-12"><b> Picture <span class="text-danger">*</span></b> <span> 
							  		<?php if((pathinfo($applicant_picture,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  		<img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5" onerror="this.src='../assets/user_default.png'" alt="No Image" width="50px" height="50px" /> 
							  		<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_picture ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?> 
							  	</span> 
							  	</label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_picture" class="form-control">
								  	<div class="invalid-feedback" id="error-applicant-picture" style="display:<?php echo isset($_SESSION['error']['applicant_picture'])?'block':'';  ?>;">
								  		<?php echo $_SESSION['error']['applicant_picture']??''; ?>
								    </div>
								  </div>
							<!-- Field: Applicant Picture:End -->
							
							<!-- Field: Applicant Student ID Card Image:Start -->
							  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card <span class="text-danger">*</span></b> <span>	<?php if((pathinfo($applicant_student_id_card_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>	 
							  		<img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded border border-dark" width="40px" height="40px" />  
							  		<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_student_id_card_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?>
							  	</span>  </label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_student_id_card_image" class="form-control">
								  	<div class="invalid-feedback" id="error-applicant-student-id-card-image" style="display:<?php echo isset($_SESSION['error']['applicant_student_id_card_image'])?'block':'';  ?>;">
								  		<?php echo $_SESSION['error']['applicant_student_id_card_image'];?>
								  	</div>
								  </div>
							<!-- Field: Applicant Student ID Card Image:End -->

							<!-- Field: Applicant Highest Academic Degree:Start -->
							  	<label class="form-label col-sm-12"><b> Highest Academic Degree <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							  		<select class="form-select <?php echo isset($_SESSION['error']['highest_degree'])?'is-invalid':'';  ?>" name="applicant_highest_academic_degree">
							      	<option value="">--Please Select--</option>
							      	<?php foreach($this->get_academic_degree() as $key => $degree){
							      	?>
							      		<option value="<?php echo $degree['academic_degree_id']; ?>" <?php echo (isset($academic_degree_id) && $academic_degree_id == $degree['academic_degree_id'])?'selected':'';?> ><?php echo $degree['degree_title']; ?></option>
							      	<?php	
							      	}?>
							      	</select>
								    <div class="invalid-feedback" id="error-highest-degree">
								    	<?php echo $_SESSION['error']['highest_degree']??'';?>
								    </div>
							  	</div>
							<!-- Field: Applicant Highest Academic Degree:End -->

							<!-- Field: Applicant Marksheet Image:Start -->
							  	<label class="form-label col-sm-12"><b>Scanned image of the last 2 academic records</b>  <?php if(isset($marksheet)){
							  		foreach($marksheet as $file){?>   
							  			<span class="ms-1">
							  				<?php if((pathinfo($file,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  				<img src="<?php echo $file; ?>" class="rounded border border-dark mb-3" alt="No Image" width="40px" height="40px" onerror="this.src='../assets/default.jpg'" />
									  		<?php else: ?>
		                                    	<a target="_blank" href="<?php echo $file ?>" class="text-decoration-none"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
		                                    <?php endif; ?>
							  			</span>

							  		<?php }  }  ?>  </label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_marksheet_images[]" class="form-control" id="applicant-marksheet-images" multiple="">
								  	<div class="invalid-feedback" id="error-marksheet-images"  style="display:<?php echo isset($_SESSION['error']['applicant_marksheet_images'])?'block':'';  ?>;">
								  		<?php echo $_SESSION['error']['applicant_marksheet_images']??'';?>
								    </div>
								  </div>
							<!-- Field: Applicant Marksheet Image:End -->

							<!-- Field: Applicant Stipend For Non Muslim:Start -->
								<label  class="form-label col-sm-12" style="display: none" ><b>(Non-Muslim Only) I would like to apply for stipend</b></label>
								<div class="col-sm-6 my-auto" style="display: none">
								  	<div class="input-group has-validation">
								  		<div class="form-check">
										  <input checked class="form-check-input" type="radio" name="stipend_for_non_muslim" value="Yes" <?php echo (isset($applicant_apply_for_stipend) && $applicant_apply_for_stipend == "Yes")?'checked':'';?>>
										  <label class="form-check-label">
										    Yes
										  </label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto" style="display: none">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="stipend_for_non_muslim" value="No" <?php echo (isset($applicant_apply_for_stipend) && $applicant_apply_for_stipend == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							<!-- Field: Applicant Stipend For Non Muslim:End -->

							<!-- Field: Applicant Eligible For Zakat:Start -->
								<label class="form-label col-sm-12"><b>(Muslim Only) Is the applicant eligible to receive zakat?</b></label>
								<div class="col-sm-6  my-auto">
								  	<div class="input-group has-validation">
								  		<div class="form-check">
										  <input class="form-check-input" type="radio" name="eligible_for_zakat" value="Yes" <?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'checked':'';?>>
										  <label class="form-check-label">
										    Yes
										  </label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="eligible_for_zakat" value="No" <?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "No")?'checked':'';?> >
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							<!-- Field: Applicant Eligible For Zakat:End -->

							<!-- Field 1: Applicant Eligible For Zakat (If Yes):Start -->
							  	<div id="zakat-reason-box" style="display:<?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'block':'none';?>;">
							  		<label  class="form-label col-sm-12 zakat-dependent-class"><b>Why <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<input type="text" class="form-control" name="reason_for_zakat" value="<?php echo $applicant_reason_receive_zakat??''; ?>">
								    	<div class="invalid-feedback" id="error-reason-zakat">
								    		<?php echo $_SESSION['error']['reason_for_zakat']??''; ?>
								      	</div>
							  		</div>
							  	</div>
							<!-- Field 1: Applicant Eligible For Zakat (If Yes):End -->

							<!-- Field: Is Applicant Current Enrolled In University:Start -->
								<label  class="form-label col-sm-12"><b>Currently enrolled at university? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6  my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="Yes" <?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6  my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="No" <?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-currently-enrolled-uni" style="display:none;">
							  		<?php echo $_SESSION['error']['is_currently_enrolled_in_uni']??''; ?>
							   	</div>
							<!-- Field: Is Applicant Current Enrolled In University:End -->

							<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which university? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<select class="form-select" name="univerity">
							      			<option value="">--Please Select--</option>
							      			<?php foreach($this->get_university() as $key => $univerity){?>
										      		<option value="<?php echo $univerity['university_id']; ?>" <?php echo (isset($unversity_id) && $unversity_id == $univerity['university_id'])?'selected':'';?> >
										      			<?php echo $univerity['university_name']; ?>
										      		</option>
										    <?php } ?>
							    		</select>
							    		<div class="invalid-feedback" id="error-university">
							    			<?php echo $_SESSION['error']['univerity']??''; ?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):End -->

							<!-- Field 2: In Which Year (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which year currently studying? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<select class="form-select" name="univerity_year">
							      		<option value="">--Please Select--</option>
							      		<?php foreach($this->get_enrolled_year() as $key => $year){?>
							      			<option value="<?php echo $year['current_enrolled_year_id']; ?>" <?php echo (isset($current_enrolled_year_id) && $current_enrolled_year_id == $year['current_enrolled_year_id'])?'selected':'';?> > 
							      				<?php echo $year['enrolled_year']; ?>
							      			</option>
							      		<?php } ?>	
							    		</select>
							    		<div class="invalid-feedback" id="error-university-year">
							    			<?php echo $_SESSION['error']['univerity_year']??''; ?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 2: Which Uiversity Enrolled (If Current Enrolled Uni Yes):End -->

							<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which month and year the current degree will be completed? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" data-date-format="MM yyyy" id='txtDate' class="form-control" name="degree_completed_year" value="<?php echo $passing_degree_year??''; ?>">
							    		<div class="invalid-feedback" id="error-degree-year">
							    			<?php echo $_SESSION['error']['degree_completed_year'];?>
							    		</div>
							  		</div>
							  		
							  	</div>
							<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):End -->

							<!-- Field 4: Degree Yearly Expenses (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>Total yearly educational expenses</b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="degree_yearly_expenses" value="<?php echo $expense_Of_education??''; ?>" />
							    	</div>
							  	</div>
							<!-- Field 4: Yearly Expenses (If Currently Enrolled Uni Yes):End -->

							<!-- Field: Applicant Univeristy Admission:Start -->
								<label class="form-label col-sm-12"><b> University Admission <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="applicant_university_admission" value="Merit" <?php echo (isset($applicant_university_admission_type) && $applicant_university_admission_type == "Merit")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Merit-Based
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="applicant_university_admission" value="Self" <?php echo (isset($applicant_university_admission_type) && $applicant_university_admission_type == "Self")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Self-Support
									  	</label>
										</div>
							  	</div>
							  	<div class="invalid-feedback col-sm-12" id="error-uni-admission" style="display:none">
							  		<?php echo $_SESSION['error']['applicant_university_admission'];?>
							  	</div>
							<!-- Field: Applicant Univeristy Admission:End -->

							<!-- Field: Is Applicant Current Working:Start -->
								<label class="form-label col-sm-12"><b>Currently working? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="is_currently_working" value="Yes" <?php echo (isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	 <div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="is_currently_working" value="No" <?php echo (isset($applicant_currently_working) && $applicant_currently_working == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	 </div>
							  	 <div  class="invalid-feedback col-sm-12" id="error-currently-working" style="display:none;">
							  	 	<?php echo $_SESSION['error']['is_currently_working'];?>
							  	 </div>
							<!-- Field: Is Applicant Current Working:End -->			  

							<!-- Field 1: How Much (If Currently Working Uni Yes):Start -->
							  	<div id="current-working-box" style="display:<?php echo (isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, how much money earn per month <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="how_much_earning" value="<?php echo $applicant_how_much_earn_per_month??''; ?>">
							    		<div class="invalid-feedback" id="error-how-much-earning">
							    			<?php echo $_SESSION['error']['how_much_earning'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 1: How Much (If Currently Working Uni Yes):End -->

							<!-- Field: Is Applicant Have Any Skill Or Training:Start -->
								<label class="form-label col-sm-12"><b>Have any skills or completed any skilful training? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="applicant_skill" value="Yes" <?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="applicant_skill" value="No" <?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "No")?'checked':'';?> >
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div class="invalid-feedback col-sm-12" id="error-skill" style="display:none;">
							  		<?php echo $_SESSION['error']['applicant_skill'];?>
							  	</div>
							<!-- Field: Is Applicant Have Any Skill Or Training:End -->

							<!-- Field 1: What Skill (If Applicant Skill Yes):Start -->
							  	<div id="skill-box" style="display:<?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, what? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="what_skill" value="<?php echo $what_applicant_skills??''; ?>">
							    		<div class="invalid-feedback" id="error-what-skill">
							      		<?php echo $_what_applicant_skills??''; ?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 1: What Skill (If Applicant Skill Yes):End -->

							<!-- Field: Is Applicant Recieved Any Financial Help:Start -->
								<label class="form-label col-sm-12"><b>Received any financial help from other sources besides parents such as government or university, in last 2 years? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="financial_help" value="Yes" <?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="financial_help" value="No" <?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-financial-help" style="display:none;">
							  		<?php echo $_SESSION['error']['financial_help'];?>
							  	</div>
							<!-- Field: Is Applicant Recieved Any Financial Help:End -->

							<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):Start -->
							  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, how much? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="how_much_financial_help" value="<?php echo $how_much_applicant_received_financial_help??''; ?>">
							    		<div class="invalid-feedback" id="error-how-much-financial-help">
							    			<?php echo $_SESSION['error']['how_much_financial_help'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):End -->
							  
							<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):Start -->
							  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>From where? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="from_where_financial_help" value="<?php echo $from_where??''; ?>">
							    		<div class="invalid-feedback" id="error-from-where-financial-help">
							    			<?php echo $_SESSION['error']['from_where_financial_help'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):End -->

							<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):Start -->
								  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
								  		<label class="form-label col-sm-12"><b>Scanned image of the notification of financial help <span class="text-danger">*</span></b> <span> 
								  			<?php if((pathinfo($financial_help_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
								  				<img src="<?php echo $financial_help_image;  ?>" class="rounded border border-dark" onerror="this.src='../assets/default.jpg'" alt="No Image" width="40px" height="40px" />  
								  				<?php else: ?>
		                                    	<a target="_blank" href="<?php echo $financial_help_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
		                                    <?php endif; ?>
								  		</span> </label>
								  		<div class="col-md-12 my-auto">
								    		<input type="file" class="form-control" name="financial_help_image">
								    		<div class="invalid-feedback" id="error-financial-help-image" style="display:<?php echo isset($_SESSION['error']['financial_help_image'])?'block':'';  ?>;">
								    			<?php echo $_SESSION['error']['financial_help_image']??"";?>
								      		</div>
								  		</div>
								  	</div>
							<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):End -->	

							<!-- Field: Total Number Of Family Members:Start -->
								  	<label class="form-label col-sm-12"><b>Total Number of Family Members <span class="text-danger">*</span></b></label>
								  	<div class="col-md-4 my-auto">
								    	<input type="number" class="form-control bottom-margin" name="adult" value="<?php echo $total_adults??''; ?>" placeholder="Adults" min="" id="adult_member">
								    	<div class="invalid-feedback" id="error-adult">
								    		<?php echo $_SESSION['error']['adult'];?>
								    	</div>
								  	</div>
								  	<div class="col-md-4 my-auto">
								    	<input type="number" class="form-control bottom-margin" name="children_under_age" value="<?php echo $total_childrens??''; ?>" placeholder="Children Under 18" min="" id="under_18_member">
								    	<div class="invalid-feedback" id="error-children-under-age">
								    		 <?php echo $_SESSION['error']['children_under_age'];?>
								    	</div>
								  	</div>

								  	<div class="col-md-4 my-auto">
								    	<input type="text" class="form-control bottom-margin" name="total_family_member" value="<?php echo $total_number_of_family_member??''; ?>" placeholder="Total" id="total_family_member" disabled>
									    <div class="invalid-feedback" id="error-total-family-members">
									    	 <?php echo $_SESSION['error']['total_family_member'];?>
									    </div>
								  	</div>
							<!-- Field: Total Number Of Family Members:End -->

							<!-- Field: Total Monthly Family Income:Start -->
								  	<label class="form-label col-sm-12"><b>Total Monthly Family Income <span class="text-danger">*</span></b></label>
								  	<div class="col-md-12 my-auto">
								    	<input type="text" class="form-control bottom-margin" name="total_family_monthly_income" value="<?php echo $total_monthly_family_income??''; ?>" placeholder="Total Amount">
									    <div class="invalid-feedback" id="error-total-family-monthly-income">
									    	<?php echo $_SESSION['error']['total_family_monthly_income'];?>
									    </div>
								  	</div>
								  	
							<!-- Field: Total Monthly Family Income:End -->

							<!-- Field: How many earning members in the family:Start -->
							<label class="form-label col-sm-12"><b>How many earning members in the family? <span class="text-danger">*</span></b></label>
								<div class="col-md-12">
							  	<input type="text" class="form-control bottom-margin" name="how_many_earning_members" value="<?php echo $how_many_earning_family_members??''; ?>" placeholder="Total earning members in the family">
							  	<div class="invalid-feedback" id="error-how-many-earning-members">
							  		<?php echo $_SESSION['error']['how_many_earning_members'];?>
							    </div>
								</div>
							<!-- Field: How many earning members in the family:End -->

							<!-- Field 1: Applicant Family Registration Certificate:Start -->
							  	<div class="" id="nadra-family-registration-certificate">
						  			<label class="form-label col-sm-12"><b>Scanned image of the nadra family registration certificate <span class="text-danger">*</span></b><span> 
									  		<?php if((pathinfo($nadra_family_registration_certificate,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
									  		<img src="<?php echo $nadra_family_registration_certificate;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
									  		<?php else: ?>
				                            	<a target="_blank" href="<?php echo $nadra_family_registration_certificate ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
				                            <?php endif; ?> 
									  	</span> 
						  			</label>
						  			<div class="col-md-12 my-auto">
							  			<input type="file" name="nadra_family_registration_certificate" id="nadra-frc-file" class="form-control <?php echo isset($nadra_family_registration_certificate)?'':'';  ?>">
							  			<div  class="invalid-feedback col-sm-12" id="error-frc" style="display:<?php echo isset($_SESSION['error']['nadra_family_registration_certificate'])?'block':'none';  ?>;"> 
							  				<?php echo $_SESSION['error']['nadra_family_registration_certificate']??''; ?>

							  			</div>
							  		</div>
								</div>
							<!-- Field 1: Applicant Family Registration Certificate:End -->

							<!-- Field 2: Applicant Income Document:Start -->
					  	  		<div class="" id="income-certificate">
					  	  			<label class="form-label col-sm-12"><b>Scanned image of the income document <span class="text-danger">*</span></b>
					  	  					<span> 
										  		<?php if((pathinfo($income_document,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  		<img src="<?php echo $income_document;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
										  		<?php else: ?>
					                            	<a target="_blank" href="<?php echo $income_document ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
					                            <?php endif; ?> 
										  	</span> 
					  	  			</label>
					  	  			<div class="col-md-12 my-auto">
					  		  			<input type="file" name="income_document" id="income-file" class="form-control <?php echo isset($income_document)?'':'';  ?>">
					  		  			<div  class="invalid-feedback col-sm-12" id="error-income" style="display:<?php echo isset($_SESSION['error']['income_document'])?'block':'none';  ?>;">
					  		  			 <?php echo $_SESSION['error']['income_document']??''; ?>
					  		  			</div>
					  		  		</div>
					  		  	</div>
						  	<!-- Field 2: Applicant Income Document:End -->

						  	<!-- Field 3: Applicant Father NIC:Start -->
			  		  	  		<div class="" id="father-nic">
			  		  	  			<label class="form-label col-sm-12"><b>Scanned image of the father national id card <span class="text-danger">*</span></b><span> 
			  						  		<?php if((pathinfo($father_national_id_card,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
			  						  		<img src="<?php echo $father_national_id_card;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
			  						  		<?php else: ?>
			  	                            	<a target="_blank" href="<?php echo $father_national_id_card ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
			  	                            <?php endif; ?> 
			  						  	</span>
			  		  	  			</label>
			  		  	  			<div class="col-md-12 my-auto">
			  		  		  			<input type="file" name="father_national_id_card" id="father-nic-file" class="form-control <?php echo isset($father_national_id_card)?'':'';  ?>">
			  		  		  			<div  class="invalid-feedback col-sm-12" 
			  		  		  			id="error-father-cnic_card" style="display:<?php echo isset($_SESSION['error']['father_national_id_card'])?'block':'none';  ?>;" >
			  		  		  			<?php echo $_SESSION['error']['father_national_id_card']??''; ?>
			  		  		  			</div>
			  		  		  		</div>
			  		  		  	</div>
			  		  		<!-- Field 3: Applicant Father NIC:End -->

			  		  				<h4 class="text-success fw-bolder mt-5">Bank Account Info</h4>
			  		  			<!-- Field Bank Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12" ><b>Bank Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_name" id="bank-name" placeholder='Bank Name' class="form-control" 
			  		  			  			value="<?php echo $_SESSION['data']['bank_name']??$bank_name; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Name :End -->

			  		  			<!-- Field Bank Branch Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Branch Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_branch_name" id="bank-branch-name" placeholder='Branch Name' class="form-control" value="<?php echo $_SESSION['data']['bank_branch_name']??$bank_branch_name; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Branch Name :End -->

			  		  			<!-- Field Bank Account Title :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Title<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_title" id="bank-account-title" placeholder='Account Title' class="form-control" value="<?php echo $_SESSION['data']['bank_account_title']??$bank_account_title; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Title :End -->

			  		  			<!-- Field Bank Account Number :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Number<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_number" id="bank-account-number" placeholder='Account Number' class="form-control" value="<?php echo $_SESSION['data']['bank_account_number']??$bank_account_number; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Number :End -->

			  		  		<!-- Field Hidden For Validation Check :Start -->
		  		  			  	<div class="hidden">
		  		  			  		<div class="col-md-12">
		  		  			  			<input type="hidden" name="hidden_value" value="0">
		  		  			  		</div>
		  		  			  	</div>
		  		  			<!-- Field Hidden For Validation Check :End -->



							<!-- MOU:Start -->
								  	<div class="col-md-12 mt-5">
								  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
								  	<ol>
											<li class="text-black">Applicant should be an orphan.</li>
											<li class="text-black">Must be taking classes full-time.</li>
											<li class="text-black">If doing a full-time or part-time job must declare the details to Hidaya.</li>
											<li class="text-black">In case of getting any scholarship or stipend from other sources, monthly or one-time, must declare to Hidaya.</li>
											<li class="text-black">In case of failure to inform Hidaya, Hidaya reserves the right to stop supporting or blacklist the applicant.</li>
											<li class="text-black">Any incorrect information provided by the applicant will be the reason for the rejection of the application.</li>
										</ol>
								  	</div>
							<!-- MOU:End -->

							<!-- Agree Checkbox:Start -->
							  	<label class="form-label col-sm-12 ms-4"><b>Memorandum of Understanding (MOU) Terms Agreement <span class="text-danger">*</span></b></label>
								  <div class="col-md-12 my-auto ms-4">
								    <div class="form-check">
								      <input class="form-check-input" name="agreement" type="checkbox" value="Yes">
								      <label class="form-check-label">
								        I state that I have read and understood the terms and conditions.
								      </label>
								      <div class="invalid-feedback" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;" id="error-agreement">
								        You must agree before submitting.
								      </div>
								    </div>
								  </div>
							<!-- Agree Checkbox:End -->

							<!-- Submit Button :Start -->
						  	<div class="col-md-12 ms-4 mb-5 mt-4">
						    	<input type="hidden" name="beneficiary_id" value="<?php echo $beneficiary_id??null; ?>" />
						    	<input type="hidden" name="action" value="edit" />
						    	<button class="btn btn-primary" type="submit" name="submit">Update</button><span class="invalid-feedback" id="error-appropriate" style="display:none;"><b>&nbsp;&nbsp;To Submit Your Application, Please fill out the form appropriately</b></span>
						    </div>
							<!-- Submit Button :End -->

						</div>
					</div>
					<!-- Tab 2 :End -->

				</form>
			</div>
			
			<?php
		}
		/*Beneficiary Edit Form :End*/

		/*Beneficiary Update Beneficiary Form Admin Side :Start*/
		public function update_beneficiary_form($beneficiary_record,$beneficiary_degree_attachment,$beneficiary_id)
		{
			extract($beneficiary_record);
			?>

			<div class="container mt-5">
				<?php 
					if(isset($_REQUEST['msg'])){
				    ?>
				    <div class="row">
				    	<div class="col-md-12">
				    		<div class="alert alert-<?php echo $_REQUEST['class']??''; ?> alert-dismissible fade show" role="alert">
									<?php echo $_REQUEST['msg']??"" ?>
				    			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						</div>
				    </div>
		 		 <?php } ?>
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
					    <button class="nav-link active" id="nav-father-alive-update-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive-update" type="button" role="tab" aria-controls="nav-father" aria-selected="true">Applicant Father Information</button>

					    <button class="nav-link second_link" id="nav-personal-info-update-tab" data-bs-toggle="tab" data-bs-target="#nav-personal-info-update" type="button" role="tab" aria-controls="nav-applicant" aria-selected="false"  
					    		<?php 
					    			echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'Yes')?'disabled':'';
					    			echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'Yes')?'disabled':''; 
					    		?> > Applicant Information</button>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">

						<form class="row g-3" onsubmit="return validateUpdateForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">
							<div class="tab-pane fade show active" id="nav-father-alive-update" role="tabpanel" aria-labelledby="nav-father-alive-update-tab">

								<!-- Field: Applicant Is Father Alive:Start -->
									<div class="row mt-3" id="first_tab">
										<label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
										<div class="col-sm-2 my-auto">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
												  	<input class="form-check-input is_father_alive" type="radio" name="is_father_alive" value="Yes" 
												  	<?php echo ( (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == "Yes") OR (!isset($_SESSION['update-data']) && isset($is_father_alive) && $is_father_alive == 'Yes'))?'checked':'';?>>
												  	<label class="form-check-label">
												    	Yes
												  	</label>
													</div>
											</div>
										</div>
										  
									  	<div class="col-sm-2 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input is_father_alive" type="radio" name="is_father_alive" value="No" <?php  echo ( (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == "No") OR (!isset($_SESSION['update-data']) && isset($is_father_alive) && $is_father_alive == 'No'))?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-father-alive" style="display:<?php echo isset($_SESSION['update-error']['is_father_alive'])?'block':'none';  ?>">
									      	<?php echo $_SESSION['update-error']['is_father_alive']??''; ?>
									   	</div>

	                                    <div class="row mt-3 death-certificate-image" style="display:<?php 
										    			echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';
										    			echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
										    		?>">
									   		<div class="col-sm-6">
							                     <?php if((pathinfo($father_death_certificate_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>   
											    <a class="<?php echo isset($father_death_certificate_image)?'elem2':'' ?>" 
			                                        <?php echo isset($father_death_certificate_image)?"href=$father_death_certificate_image":''; ?>
			                                        title="Father`s Death Certificate" 
			                                        data-lcl-txt="<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> " 
			                                        style="text-decoration: none;">
			                                        <img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class="rounded shadow" alt="No Image" width="300px" height="250px" />
        											<?php else: ?>
                                                    	<a target="_blank" href="<?php echo $father_death_certificate_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                                    <?php endif; ?> 
			                                    </a>
	                                    	</div>
				                    	</div>

				                    	
				                    	<!-- Field: Applicant Father CNIC:Start -->
			                    		  	<div class="mt-3" id="father_nic" style="display:<?php 
			                    				    echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';
			                    				    echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
			                    				    		?>" >
			                    			  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
			                    			  	<div class="col-md-12 my-auto">
			                    			    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['father_cnic'])?'is-invalid':'';  ?>" name="father_cnic" value="<?php echo $_SESSION['update-data']['father_cnic']??$father_cnic; ?>" placeholder="Father National ID Card No">
			                    				    <div class="invalid-feedback" id="error-father-cnic">
			                    				      <?php echo $_SESSION['update-error']['father_cnic']??''; ?>
			                    				    </div>
			                    			  	</div>
			                    			</div>
				                    	<!-- Field: Applicant Father CNIC:End -->

				                    	<!-- Field: Applicant Father Name:Start -->
				                    		  	<label class="form-label col-sm-12" id="f_name_label"><b> Father Name <span class="text-danger">*</span></b></label>
				                    			  	<div class="col-md-4 my-auto" id="f_first_name"style="display:<?php echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
				                    			    		?>">
				                    		    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_first_name'])?'is-invalid':'bottom-margin';  ?>" name="father_first_name" value="<?php echo $_SESSION['update-data']['father_first_name']??$father_first_name; ?>" placeholder="First Name">
				                    			    <div class="invalid-feedback" id="error-father-first-name">
				                    			      <?php echo $_SESSION['update-error']['father_first_name']??''; ?>
				                    			    </div>
				                    		  	</div>
				                    		  	<div class="col-md-4 my-auto" id="f_middle_name"
				                    			  	style="display:<?php echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
				                    			    		?>">
				                    		    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_middle_name'])?'is-invalid':'bottom-margin';  ?>" name="father_middle_name" value="<?php echo $_SESSION['update-data']['father_middle_name']??$father_middle_name;?>"  placeholder="Middle Name">
				                    		    	<div class="invalid-feedback" id="error-father-middle-name">
				                    		      	<?php echo $_SESSION['update-error']['father_middle_name']??''; ?>
				                    		    	</div>
				                    		  	</div>
				                    		  	<div class="col-md-4 my-auto" id="f_last_name"
				                    			  	style="display:<?php echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
				                    			    		?>">
				                    		    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_last_name'])?'is-invalid':'bottom-margin';  ?>" name="father_last_name" value="<?php echo $_SESSION['update-data']['father_last_name']??$father_last_name; ?>"  placeholder="Last Name">
				                    		    	<div class="invalid-feedback" id="error-father-last-name">
				                    		      	<?php echo $_SESSION['update-error']['father_last_name']??''; ?>
				                    		    	</div>
				                    		  	</div>
				                    	<!-- Field: Applicant Father Name:End -->

				                    	<!-- Field: Applicant Father Occupation:Start -->
				                    			<div class="mt-3" id="father_occupations">
				                    		  		<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
				                    		  		<div class="col-md-12 my-auto">
				                    		    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_occupation'])?'is-invalid':'';  ?>" name="father_occupation" value="<?php echo $_SESSION['update-data']['father_occupation']??$father_occupation; ?>">
				                    			    	<div class="invalid-feedback" id="error-father-occupation">
				                    			      	<?php echo $_SESSION['update-error']['father_occupation']??''; ?>
				                    			    	</div>
				                    		  		</div>
				                    		  	</div>
				                    		<!-- Field: Applicant Father Occupation:End -->


				                    	<div class="invalid-feedback mt-3" id="" style="display:<?php echo (isset($_SESSION['update-error']['appropriate']))?'block;':'none';?>;">
						                	 <b>Note: To Submit Your Application, Please fill out the form appropriately.</b>
						                </div>


						                <div class="row mt-3">
									   		<div class="col-sm-10"></div>
					                        <div class="col-sm-2 text-right">
											   <button type="button" class="btn btn-success float-end" id="nextBtn-update" style="display: 
											   		<?php 
										    			echo (isset($_SESSION['update-data']['is_father_alive']) && $_SESSION['update-data']['is_father_alive'] == 'No')?'block':'none';
										    			echo (!isset($_SESSION['update-data']['is_father_alive']) && isset($is_father_alive) && $is_father_alive == 'No')?'block':''; 
										    		?>">
					                                Next
					                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					                            </button>
					                        </div>
				                    	</div>
									</div>
							    <!-- Field: Applicant Is Father Alive:End -->
							</div>

							<div class="tab-pane fade" id="nav-personal-info-update" role="tabpanel" aria-labelledby="nav-personal-info-update-tab">
							    <div class="row  mt-3" id="second_tab" style="display:none;">
									<!-- Field: Name Of Applicant:Start -->
									  	<label class="form-label col-sm-12"><b>Name of Applicant <span class="text-danger">*</span></b></label>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['first_name'])?'is-invalid':'bottom-margin';  ?>" name="first_name" value="<?php echo $_SESSION['update-data']['first_name']??$applicant_first_name; ?>" placeholder="First Name">
										    <div class="invalid-feedback" id="error-first-name">
										      <?php echo $_SESSION['update-error']['first_name']??''; ?>
										    </div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['middle_name'])?'is-invalid':'bottom-margin';  ?>" name="middle_name" value="<?php echo $_SESSION['update-data']['middle_name']??$applicant_middle_name; ?>" placeholder="Middle Name">
									    	<div class="invalid-feedback" id="error-middle-name">
									      	<?php echo $_SESSION['update-error']['middle_name']??''; ?>
									    	</div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['last_name'])?'is-invalid':'bottom-margin';  ?>" name="last_name" value="<?php echo $_SESSION['update-data']['last_name']??$applicant_last_name; ?>" placeholder="Last Name">
									    	<div class="invalid-feedback" id="error-last-name">
									      	<?php echo $_SESSION['update-error']['last_name']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Name Of Applicant:End -->

								    <!-- Field: Applicant Gender:Start -->
								 		<label class="form-label col-sm-12"><b>Gender <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($_SESSION['update-data']['gender']) && $_SESSION['update-data']['gender'] == "Male")?'checked':'';
											  		echo (!isset($_SESSION['update-data']) && isset($applicant_gender) && $applicant_gender == "Male")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Male
											  	</label>
												</div>
											</div>
										</div>
										<div class="col-sm-6 my-auto">
										    <div class="form-check">
											  <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($_SESSION['update-data']['gender']) && $_SESSION['update-data']['gender'] == "Female")?'checked':'';
													echo (!isset($_SESSION['update-data']) && isset($applicant_gender) && $applicant_gender == "Female")?'checked':'';?>>
											  <label class="form-check-label">
											    Female
											  </label>
											</div>
										</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-gender" style="display:<?php echo isset($_SESSION['update-error']['gender'])?'block':'none';  ?>">
									      	<?php echo $_SESSION['update-error']['gender']??''; ?>
									   	</div>
								    <!-- Field: Applicant Gender:End -->

									<!-- Field: Applicant Contact Number:Start -->
									  	<label class="form-label col-sm-12"><b> Contact Number <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 923001234567)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['contact_number'])?'is-invalid':'';  ?>" name="contact_number" value="<?php echo $_SESSION['update-data']['contact_number']??$applicant_contact_number; ?>" placeholder="Phone Number">
									    	<div class="invalid-feedback" id="error-contact-number">
									      	<?php echo $_SESSION['update-error']['contact_number']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Contact Number:End -->

									<!-- Field: Applicant Contact Email:Start -->
									  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="email" class="form-control <?php echo isset($_SESSION['update-error']['email'])?'is-invalid':'';  ?>" id="email" name="email" value="<?php echo $_SESSION['update-data']['email']??$applicant_email; ?>" placeholder="Email">
									    	<div class="invalid-feedback" id="error-email">
									      	<?php echo $_SESSION['update-error']['email']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Contact Email:End -->

								    <!-- Field: Applicant Date of Birth:Start -->
									  	<label class="form-label col-sm-12"><b> Date of Birth <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="date" class="form-control <?php echo isset($_SESSION['update-error']['dob'])?'is-invalid':'';  ?>" name="date_of_birth" value="<?php echo $_SESSION['update-data']['date_of_birth']??$applicant_date_of_birth; ?>">
									    	<div class="invalid-feedback" id="error-dob">
									      	<?php echo $_SESSION['update-error']['dob']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Date of Birth:End -->

									<!-- Field: Applicant CNIC:Start -->
									  	<label class="form-label col-sm-12"><b> National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['app_cnic'])?'is-invalid':'';  ?>" name="applicant_cnic" value="<?php echo $_SESSION['update-data']['applicant_cnic']??$applicant_cnic;  ?>" placeholder="National ID Card No" id="cnic">
										    <div class="invalid-feedback" id="error-cnic">
										      <?php echo $_SESSION['update-error']['app_cnic']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant CNIC:End -->


									<!-- Field: Applicant CNIC Picture:Start -->
									  	<label class="form-label col-sm-12"><b>Scanned image of National ID Card No</b></label>
									  	<div class="row">
									   		<div class="col-sm-6">
										  	<?php if((pathinfo($applicant_cnic_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  	<a class="<?php echo isset($applicant_cnic_image)?'elem3':'' ?>" 
                                                <?php echo isset($applicant_cnic_image)?"href=$applicant_cnic_image":''; ?>
                                                title="National ID Card" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                              <img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
                                            </a>
											<?php else: ?>
                                            	<a target="_blank" href="<?php echo $applicant_cnic_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>
										  </div>
										</div>
									<!-- Field: Applicant CNIC Picture:End -->

									<!-- Field: Applicant Current Address:Start -->
									  	<label class="form-label col-sm-12"><b> Current Address <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									    	<textarea class="form-control <?php echo isset($_SESSION['update-error']['current_address'])?'is-invalid':'';  ?>" name="current_address"><?php echo $_SESSION['update-data']['current_address']??$applicant_current_address;?></textarea>
										    <div class="invalid-feedback" id="error-current-address">
										      <?php echo $_SESSION['update-error']['current_address']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Current Address:End -->

									<!-- Field: Applicant Permanent Address:Start -->
									  	<label class="form-label col-sm-12"><b> Permanent Address <span class="text-danger">*</span></b>

									  		<label class="form-check-label float-end"><span class="text-danger"> <input class="form-check-inputs" name="same_as_current_add" type="checkbox" 
									  			<?php 
									  				echo (isset($_SESSION['flag_for_address']) && $_SESSION['flag_for_address'] == true)?'checked':'';
									  				echo (!isset($_SESSION['flag_for_address']) && isset($applicant_current_address) && isset($applicant_permanent_address) && ($applicant_current_address == $applicant_permanent_address)?'checked':'');
									  				 ?> 
									  				value="Yes">&nbsp;</span><b>Same As Current Address</b></label>
									  	</label>
									  	<div class="col-md-12 my-auto">
									    	<textarea class="form-control <?php echo isset($_SESSION['update-error']['permanent_address'])?'is-invalid':'';  ?>" name="permanent_address"><?php echo $_SESSION['update-data']['permanent_address']??$applicant_permanent_address; ?></textarea>
										    <div class="invalid-feedback" id="error-permanent-address">
										      <?php echo $_SESSION['update-error']['permanent_address']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Permanent Address:End -->

									<!-- Field: Applicant Picture:Start -->
									  	<label class="form-label col-sm-12"><b>Profile Picture</b></label>
										  <div class="row">
									   		<div class="col-sm-6">
										      <?php echo $_SESSION['update-error']['applicant_picture']??''; ?>
											    <?php if((pathinfo($applicant_picture,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											    <a class="elem3" 
	                                                href="<?php echo $applicant_picture; ?>"
	                                                title="Profile Picture" 
	                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
	                                                style="text-decoration: none;">
	                                                <img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5 light-box shadow" onerror="this.src='../assets/user_default.png'" alt="No Image" width="150px" height="150px" />
	                                            </a>
	                                            <?php else: ?>
                                            	<a target="_blank" href="<?php echo $applicant_picture ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>
										    </div>
                                        	</div>
										  <!-- </div> -->
									<!-- Field: Applicant Picture:End -->

									<!-- Field: Applicant Student ID Card Image:Start -->
									  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card </b></label>
										  <div class="col-md-6 my-auto">
										  	<?php if((pathinfo($applicant_student_id_card_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  	<a class="<?php echo isset($applicant_student_id_card_image)?'elem3':''; ?>" 
                                                <?php echo isset($applicant_student_id_card_image)?"href=$applicant_student_id_card_image":''; ?>
                                                title="Student ID Card" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
                                            </a>
                                            <?php else: ?>
                                            	<a target="_blank" href="<?php echo $applicant_student_id_card_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>
										  </div>
									<!-- Field: Applicant Student ID Card Image:End -->

									<!-- Field: Applicant Highest Academic Degree:Start -->
									  	<label class="form-label col-sm-12"><b> Highest Academic Degree <span class="text-danger">*</span></b></label>
									  	<div class="col-md-12 my-auto">
									  		<select class="form-select <?php echo isset($_SESSION['update-error']['highest_degree'])?'is-invalid':'';  ?>" name="applicant_highest_academic_degree">
									      	<option value="">--Please Select--</option>
									      	<?php foreach($this->get_academic_degree() as $key => $degree){
									      	?>
									      		<option value="<?php echo $degree['academic_degree_id']; ?>" <?php echo (isset($_SESSION['update-data']['applicant_highest_academic_degree']) && $_SESSION['update-data']['applicant_highest_academic_degree'] == $degree['academic_degree_id'])?'selected':''; 
									      			echo (!isset($_SESSION['update-data']['applicant_highest_academic_degree']) && isset($academic_degree_id) && $academic_degree_id == $degree['academic_degree_id'])?'selected':'';
									      			?> ><?php echo $degree['degree_title']; ?></option>
									      	<?php	
									      	}?>
									      	</select>
										    <div class="invalid-feedback" id="error-highest-degree">
										      <?php echo $_SESSION['update-error']['highest_degree']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Highest Academic Degree:End -->

									<!-- Field: Applicant Marksheet Image:Start -->
									  	<label class="form-label col-sm-12"><b>Scanned image of the last 2 academic records</b></label>
										  <div class="col-md-12 my-auto">
										    <?php
											   	if ($beneficiary_degree_attachment->num_rows>0) {
											   		while ($attachment = mysqli_fetch_assoc($beneficiary_degree_attachment)) {
											   	     		extract($attachment);
										    		 	if((pathinfo($academic_degree_attachment,PATHINFO_EXTENSION)) != 'pdf'  ): 
										    ?>
													 	<a class="<?php echo  isset($academic_degree_attachment)?'elem3':''?>" 
			                                                href="<?php echo $academic_degree_attachment??"#"; ?>"
			                                                title="Degree Attachment" 
			                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
			                                                style="text-decoration: none;">

			                                               <img src="<?php echo $academic_degree_attachment;  ?>" class="rounded shadow " alt="No Image" width="150px" height="150px" onerror="this.src='../assets/default.jpg'" /> 
			                                            </a>
			                                            <?php else: ?>
			                                            	<a target="_blank" href="<?php echo $academic_degree_attachment ?>" class="ms-2 text-decoration-none fw-normal"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="text-danger bi bi-filetype-pdf" viewBox="0 0 16 16">
															  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
															</svg></a>
			                                            <?php endif; ?>
													
											<?php
											   	    }
											   	}else{
											   	        echo "No Attachment";
											    }
											?>
										  </div>
									<!-- Field: Applicant Marksheet Image:End -->


									<!-- Field: Applicant Stipend For Non Muslim:Start -->
										<label  class="form-label col-sm-12" style="display: none" ><b>(Non-Muslim Only) I would like to apply for stipend</b></label>
										<div class="col-sm-6 my-auto" style="display: none">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
												  <input checked class="form-check-input" type="radio" name="stipend_for_non_muslim" value="Yes" <?php echo (isset($_SESSION['data']['stipend_for_non_muslim']) && $_SESSION['data']['stipend_for_non_muslim'] == "Yes")?'checked':''; 
												  
													?>>
												  <label class="form-check-label">
												    Yes
												  </label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto" style="display: none">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="stipend_for_non_muslim" value="No" <?php echo (isset($_SESSION['data']['stipend_for_non_muslim']) && $_SESSION['data']['stipend_for_non_muslim'] == "No")?'checked':'';
										  			
										  			?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									<!-- Field: Applicant Stipend For Non Muslim:End -->


									<!-- Field: Applicant Eligible For Zakat:Start -->
										<label class="form-label col-sm-12"><b>(Muslim Only) Is the applicant eligible to receive zakat?</b></label>
										<div class="col-sm-6  my-auto">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
												  <input class="form-check-input" type="radio" name="eligible_for_zakat" value="Yes" <?php echo (isset($_SESSION['update-data']['eligible_for_zakat']) && $_SESSION['update-data']['eligible_for_zakat'] == "Yes")?'checked':'';
													   echo (!isset($_SESSION['update-data']) && isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'checked':'';?>>
												  <label class="form-check-label">
												    Yes
												  </label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="eligible_for_zakat" value="No" <?php echo (isset($_SESSION['update-data']['eligible_for_zakat']) && $_SESSION['update-data']['eligible_for_zakat'] == "No")?'checked':'';
										  			echo (!isset($_SESSION['update-data']) && isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "No")?'checked':'';?> >
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									<!-- Field: Applicant Eligible For Zakat:End -->

									<!-- Field 1: Applicant Eligible For Zakat (If Yes):Start -->
									  	<div id="zakat-reason-box" style="display:<?php echo (isset($_SESSION['update-data']['eligible_for_zakat']) && $_SESSION['update-data']['eligible_for_zakat'] == "Yes")?'block':'none'; echo ( !isset($_SESSION['update-data']) && isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'block':'';?>;">

									  		<label  class="form-label col-sm-12 zakat-dependent-class"><b>Why <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['reason_for_zakat'])?'is-invalid':'';  ?>" name="reason_for_zakat" value="<?php echo $_SESSION['update-data']['reason_for_zakat']??$applicant_reason_receive_zakat; ?>">
										    	<div class="invalid-feedback" id="error-reason-zakat">
										      	<?php echo $_SESSION['update-error']['reason_for_zakat']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 1: Applicant Eligible For Zakat (If Yes):End -->

								  	<!-- Field: Is Applicant Current Enrolled In University:Start -->
										<label  class="form-label col-sm-12"><b>Currently enrolled at university? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6  my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="Yes" <?php echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "Yes")?'checked':'';
											  	echo ( !isset($_SESSION['update-data']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6  my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="No" <?php echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "No")?'checked':'';
										  		echo (!isset($_SESSION['update-data']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-currently-enrolled-uni" style="display:<?php echo isset($_SESSION['update-error']['is_currently_enrolled_in_uni'])?'block':'none';  ?>;">
									      	<?php echo $_SESSION['update-error']['is_currently_enrolled_in_uni']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Current Enrolled In University:End -->

									

									<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';echo (!isset($_SESSION['update-data']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'';?>;">
									  		
									  		<label class="form-label col-sm-12"><b>In which university? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<select class="form-select <?php echo isset($_SESSION['update-error']['university'])?'is-invalid':'';  ?>" name="university">
									      			<option value="">--Please Select--</option>
									      			<?php foreach($this->get_university() as $key => $univerity){?>
												      		<option value="<?php echo $univerity['university_id']; ?>" 
												      			<?php
												      			echo (isset($_SESSION['update-data']['university']) && $_SESSION['update-data']['university'] == $univerity['university_id'])?'selected':'';
												      			echo (!isset($_SESSION['update-data']['university']) && isset($unversity_id) && $unversity_id == $univerity['university_id'])?'selected':'';	?> >
												      			<?php echo $univerity['university_name']; ?>
												      		</option>
												    <?php } ?>
									    		</select>
									    		<div class="invalid-feedback" id="error-university">
										      	<?php echo $_SESSION['update-error']['university']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):End -->

									<!-- Field 2: In Which Year (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';echo (!isset($_SESSION['update-data']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'';?>;">
									  		<label class="form-label col-sm-12"><b>In which year currently studying? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 zakat-dependent-class my-auto">
									    		<select class="form-select <?php echo isset($_SESSION['update-error']['university_year'])?'is-invalid':'';  ?>" name="university_year">
									      		<option value="">--Please Select--</option>
									      		<?php foreach($this->get_enrolled_year() as $key => $year){?>
									      			<option value="<?php echo $year['current_enrolled_year_id']; ?>" 
									      				<?php echo (isset($_SESSION['update-data']['university_year']) && $_SESSION['update-data']['university_year'] == $year['current_enrolled_year_id'])?'selected':''; 
									      				echo (!isset($_SESSION['update-data']['university_year']) && isset($current_enrolled_year_id) && $current_enrolled_year_id == $year['current_enrolled_year_id'])?'selected':'';?> > 
									      				<?php echo $year['enrolled_year']; ?>
									      			</option>
									      		<?php } ?>	
									    		</select>
									    		<div class="invalid-feedback" id="error-university-year">
										      	<?php echo $_SESSION['update-error']['university_year']??''; ?>
										    	</div>
									  		</div>
									  	</div>
									<!-- Field 2: Which Uiversity Enrolled (If Current Enrolled Uni Yes):End -->

									<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';echo (!isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'';?>;">

									  		<label class="form-label col-sm-12"><b>In which month and year the current degree will be completed? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" data-date-format="MM yyyy" id='txtDate' class="form-control <?php echo isset($_SESSION['update-error']['degree_completed_year'])?'is-invalid':'';  ?>" name="degree_completed_year" value="<?php echo $_SESSION['update-data']['degree_completed_year']??$passing_degree_year; ?>">
									    		<div class="invalid-feedback" id="error-degree-year">
									      		<?php echo $_SESSION['update-error']['degree_completed_year']??''; ?>
									    		</div>
									  		</div>
									  		
									  	</div>
									<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):End -->

									<!-- Field 4: Degree Yearly Expenses (If Currently Enrolled Uni Yes):Start -->
									  	<div class="university-box" style="display:<?php 
									  		echo (isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && $_SESSION['update-data']['is_currently_enrolled_in_uni'] == "Yes")?'block':'none';
									  		echo ( !isset($_SESSION['update-data']['is_currently_enrolled_in_uni']) && isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'';?>;">

									  		<label class="form-label col-sm-12"><b>Total yearly educational expenses</b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control" name="degree_yearly_expenses" value="<?php echo $_SESSION['update-data']['degree_yearly_expenses']??$expense_Of_education; ?>" />
									    	</div>
									  	</div>
									<!-- Field 4: Yearly Expenses (If Currently Enrolled Uni Yes):End -->

									<!-- Field: Applicant Univeristy Admission:Start -->
										<label class="form-label col-sm-12"><b> University Admission <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="applicant_university_admission" value="Merit" <?php echo (isset($_SESSION['update-data']['applicant_university_admission']) && $_SESSION['update-data']['applicant_university_admission'] == "Merit")?'checked':'';
											  		echo (!isset($_SESSION['update-data']['applicant_university_admission']) && isset($applicant_university_admission_type) && $applicant_university_admission_type == "Merit")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Merit-Based
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="applicant_university_admission" value="Self" <?php echo (isset($_SESSION['update-data']['applicant_university_admission']) && $_SESSION['update-data']['applicant_university_admission'] == "Self")?'checked':'';
										  			echo (!isset($_SESSION['update-data']['applicant_university_admission']) && isset($applicant_university_admission_type) && $applicant_university_admission_type == "Self")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Self-Support
											  	</label>
												</div>
									  	</div>
									  	<div class="invalid-feedback col-sm-12" id="error-uni-admission" style="display:<?php echo isset($_SESSION['update-error']['applicant_university_admission'])?'block':'none';  ?>;">
									      	<?php echo $_SESSION['update-error']['applicant_university_admission']??''; ?>
									   	</div>
									<!-- Field: Applicant Univeristy Admission:End -->


									<!-- Field: Is Applicant Current Working:Start -->
										<label class="form-label col-sm-12"><b>Currently working? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="is_currently_working" value="Yes" <?php echo (isset($_SESSION['update-data']['is_currently_working']) && $_SESSION['update-data']['is_currently_working'] == "Yes")?'checked':'';
											  		echo (!isset($_SESSION['update-data']['is_currently_working']) && isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	 <div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="is_currently_working" value="No" <?php echo (isset($_SESSION['update-data']['is_currently_working']) && $_SESSION['update-data']['is_currently_working'] == "No")?'checked':'';
										  			echo (!isset($_SESSION['update-data']['is_currently_working']) && isset($applicant_currently_working) && $applicant_currently_working == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	 </div>
									  	 <div  class="invalid-feedback col-sm-12" id="error-currently-working" style="display:<?php echo (isset($_SESSION['update-error']['is_currently_working']))?'block':'none';?>;">
									      	<?php echo $_SESSION['update-error']['is_currently_working']??''; ?>
									   	 </div>
									<!-- Field: Is Applicant Current Working:End -->			  

									<!-- Field 1: How Much (If Currently Working Uni Yes):Start -->
									  	<div id="current-working-box" style="display:<?php echo (isset($_SESSION['update-data']['is_currently_working']) && $_SESSION['update-data']['is_currently_working'] == "Yes")?'block':'none';
									  		echo (!isset($_SESSION['update-data']['is_currently_working']) && isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'block':'';?>;">

									  		<label class="form-label col-sm-12"><b>If yes, how much money earn per month <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['how_much_earning'])?'is-invalid':'';  ?>" name="how_much_earning" value="<?php echo $_SESSION['update-data']['how_much_earning']??$applicant_how_much_earn_per_month; ?>">
									    		<div class="invalid-feedback" id="error-how-much-earning">
									      		<?php echo $_SESSION['update-error']['how_much_earning']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: How Much (If Currently Working Uni Yes):End -->

									<!-- Field: Is Applicant Have Any Skill Or Training:Start -->
										<label class="form-label col-sm-12"><b>Have any skills or completed any skilful training? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="applicant_skill" value="Yes" 
											  	<?php echo (isset($_SESSION['update-data']['applicant_skill']) && $_SESSION['update-data']['applicant_skill'] == "Yes")?'checked':'';
											  	     echo (!isset($_SESSION['update-data']['applicant_skill']) && isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="applicant_skill" value="No" 
										  		<?php echo (isset($_SESSION['update-data']['applicant_skill']) && $_SESSION['update-data']['applicant_skill'] == "No")?'checked':'';
										  		    echo (!isset($_SESSION['update-data']['applicant_skill']) && isset($does_applicant_have_skills) && $does_applicant_have_skills == "No")?'checked':'';?> >
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-skill" style="display:<?php echo (isset($_SESSION['update-error']['applicant_skill']))?'block':'none';?>;">
									      	<?php echo $_SESSION['update-error']['applicant_skill']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Have Any Skill Or Training:End -->

									<!-- Field 1: What Skill (If Applicant Skill Yes):Start -->
									  	<div id="skill-box" style="display:
									  		<?php echo (isset($_SESSION['update-data']['applicant_skill']) && $_SESSION['update-data']['applicant_skill'] == "Yes")?'block':'none';
									  		     echo (!isset($_SESSION['update-data']['applicant_skill']) && isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'block':'';?>;">

									  		<label class="form-label col-sm-12"><b>If yes, what? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['what_skill'])?'is-invalid':'';  ?>" name="what_skill" value="<?php echo $_SESSION['update-data']['what_skill']??$what_applicant_skills; ?>">
									    		<div class="invalid-feedback" id="error-what-skill">
									      		<?php echo $_SESSION['update-error']['what_skill']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: What Skill (If Applicant Skill Yes):End -->

									<!-- Field: Is Applicant Recieved Any Financial Help:Start -->
										<label class="form-label col-sm-12"><b>Received any financial help from other sources besides parents such as government or university, in last 2 years? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="financial_help" value="Yes" 
											  	<?php echo (isset($_SESSION['update-data']['financial_help']) && $_SESSION['update-data']['financial_help'] == "Yes")?'checked':'';
											  		 echo (!isset($_SESSION['update-data']['financial_help']) && isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="financial_help" value="No" <?php echo (isset($_SESSION['update-data']['financial_help']) && $_SESSION['update-data']['financial_help'] == "No")?'checked':'';echo (!isset($_SESSION['update-data']['financial_help']) && isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-financial-help" style="display:<?php echo (isset($_SESSION['error']['financial_help']))?'block':'none';?>">
									      	<?php echo $_SESSION['update-error']['financial_help']??''; ?>
									   	</div>
									<!-- Field: Is Applicant Recieved Any Financial Help:End -->

									<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):Start -->
									  	<div class="financial-box" style="display:
									  		<?php echo (isset($_SESSION['update-data']['financial_help']) && $_SESSION['update-data']['financial_help'] == "Yes")?'block':'none';
									  		echo (!isset($_SESSION['update-data']['financial_help']) && isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'';?>;">

									  		<label class="form-label col-sm-12"><b>If yes, how much? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['how_much_financial_help'])?'is-invalid':'';  ?>" name="how_much_financial_help" value="<?php echo $_SESSION['update-data']['how_much_financial_help']??$how_much_applicant_received_financial_help; ?>">
									    		<div class="invalid-feedback" id="error-how-much-financial-help">
									      		<?php echo $_SESSION['update-error']['how_much_financial_help']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):End -->
									  
									<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):Start -->
									  	<div class="financial-box" style="display:<?php echo (isset($_SESSION['update-data']['financial_help']) && $_SESSION['update-data']['financial_help'] == "Yes")?'block':'none';
									  		echo (!isset($_SESSION['update-data']['financial_help']) && isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'';?>;?>;">
									  		<label class="form-label col-sm-12"><b>From where? <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['from_where_financial_help'])?'is-invalid':'';  ?>" name="from_where_financial_help" value="<?php echo $_SESSION['update-data']['from_where_financial_help']??$from_where; ?>">
									    		<div class="invalid-feedback" id="error-from-where-financial-help">
									      		<?php echo $_SESSION['update-error']['from_where_financial_help']??''; ?>
									    		</div>
									  		</div>
									  	</div>
									<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):End -->

									<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):Start -->
										  	<div class="financial-box" 
										  			style="display:<?php 
										  			 	echo (isset($_SESSION['update-data']['financial_help']) && $_SESSION['update-data']['financial_help'] == "Yes")?'block':'none';
										  		    	echo (!isset($_SESSION['update-data']['financial_help']) && isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'';?>;">
										  		<label class="form-label col-sm-12"><b>Scanned image of the notification of financial help <span class="text-danger">*</span></b></label>
										  		<div class="col-md-12 my-auto">
												    <?php if((pathinfo($financial_help_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
												    <a class="<?php echo  isset($financial_help_image)?'elem3':''?>" 
		                                               <?php echo isset($financial_help_image)?"href=$financial_help_image":''; ?>
		                                                title="Financial Help Notification" 
		                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
		                                                style="text-decoration: none;">

		                                              <img src="<?php echo $financial_help_image;  ?>" class="rounded shadow" onerror="this.src='../assets/default.jpg'" alt="No Image" width="150px" height="150px" />
		                                            </a>
		                                            <?php else: ?>
		                                            	<a target="_blank" href="<?php echo $financial_help_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
		                                            <?php endif; ?>
										  		</div>
										  	</div>
									<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):End -->			  

									<!-- Field: Total Number Of Family Members:Start -->
										  	<label class="form-label col-sm-12"><b>Total Number of Family Members <span class="text-danger">*</span></b></label>
										  	<div class="col-md-4 my-auto">
										    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['adult'])?'is-invalid':'bottom-margin';  ?>" name="adult" value="<?php echo $_SESSION['update-data']['adult']??$total_adults; ?>" placeholder="Adults" min="" id="adult_member">
										    	<div class="invalid-feedback" id="error-adult">
										      	<?php echo $_SESSION['update-error']['adult']??''; ?>
										    	</div>
										  	</div>
										  	<div class="col-md-4 my-auto">
										    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['children_under_age'])?'is-invalid':'bottom-margin';  ?>" name="children_under_age" value="<?php echo $_SESSION['update-data']['children_under_age']??$total_childrens; ?>" placeholder="Children Under 18" min="" id="under_18_member">
										    	<div class="invalid-feedback" id="error-children-under-age">
										      	<?php echo $_SESSION['update-error']['children_under_age']??''; ?>
										    	</div>
										  	</div>

										  	<div class="col-md-4 my-auto">
										    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['total_family_member'])?'is-invalid':'bottom-margin';  ?>" name="total_family_member" value="<?php echo $_SESSION['update-data']['total_family_member']??$total_number_of_family_member; ?>" placeholder="Total" id="total_family_member" disabled>
											    <div class="invalid-feedback" id="error-total-family-members">
											     <?php echo $_SESSION['update-error']['total_family_member']??''; ?>
											    </div>
										  	</div>
									<!-- Field: Total Number Of Family Members:End -->

									<!-- Field: Total Monthly Family Income:Start -->
										  	<label class="form-label col-sm-12"><b>Total Monthly Family Income <span class="text-danger">*</span></b></label>
										  	<div class="col-md-12 my-auto">
										    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['total_family_monthly_income'])?'is-invalid':'bottom-margin';  ?>" name="total_family_monthly_income" value="<?php echo $_SESSION['update-data']['total_family_monthly_income']??$total_monthly_family_income; ?>" placeholder="Total Amount">
											    <div class="invalid-feedback" id="error-total-family-monthly-income">
											      <?php echo $_SESSION['update-error']['total_family_monthly_income']??''; ?>
											    </div>
										  	</div>
										  	
									<!-- Field: Total Monthly Family Income:End -->



									<!-- Field: How many earning members in the family:Start -->
										<label class="form-label col-sm-12"><b>How many earning members in the family? <span class="text-danger">*</span></b></label>
											<div class="col-md-12">
									  	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['how_many_earning_members'])?'is-invalid':'bottom-margin';  ?>" name="how_many_earning_members" value="<?php echo $_SESSION['update-data']['how_many_earning_members']??$how_many_earning_family_members; ?>" placeholder="Total earning members in the family">
									  	<div class="invalid-feedback" id="error-how-many-earning-members">
									    	<?php echo $_SESSION['update-error']['how_many_earning_members']??''; ?>
									  	</div>
										</div>
									<!-- Field: How many earning members in the family:End -->

									<!-- Field 1: Applicant Family Registration Certificate:Start -->
										<label class="form-label col-sm-12"><b> Scanned image of the nadra family registration certificate </b></label>
										  <div class="col-md-6 my-auto">
										  	<?php 
										  	if((pathinfo($nadra_family_registration_certificate,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  	<a class="<?php echo isset($nadra_family_registration_certificate)?'elem3':''; ?>" 
								                <?php echo isset($nadra_family_registration_certificate)?"href=$nadra_family_registration_certificate":''; ?>
								                title="Nadra Family Registration Certificate" 
								                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
								                style="text-decoration: none;">
								                <img src="<?php echo $nadra_family_registration_certificate;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
								            </a>
								            <?php else: ?>
								            	<a target="_blank" href="<?php echo $nadra_family_registration_certificate ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
								            <?php endif; ?>
										  </div>
									<!-- Field 1: Applicant Family Registration Certificate:End -->

									<!-- Field 2: Applicant Income Document:Start -->
										<label class="form-label col-sm-12"><b> Scanned image of the income document  </b></label>
										  <div class="col-md-6 my-auto">
										  	<?php 
										  	if((pathinfo($income_document,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  	<a class="<?php echo isset($income_document)?'elem3':''; ?>" 
								                <?php echo isset($income_document)?"href=$income_document":''; ?>
								                title="Income Document" 
								                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
								                style="text-decoration: none;">
								                <img src="<?php echo $income_document;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
								            </a>
								            <?php else: ?>
								            	<a target="_blank" href="<?php echo $income_document ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
								            <?php endif; ?>
										  </div>
									<!-- Field 2: Applicant Income Document:End -->

									<!-- Field 3: Applicant Father NIC:Start -->
								  	  	<label class="form-label col-sm-12"><b> Scanned image of the father national id card </b></label>
										  <div class="col-md-6 my-auto">
										  	<?php 
										  	if((pathinfo($father_national_id_card,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  	<a class="<?php echo isset($father_national_id_card)?'elem3':''; ?>" 
								                <?php echo isset($father_national_id_card)?"href=$father_national_id_card":''; ?>
								                title="Father National ID Card" 
								                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
								                style="text-decoration: none;">
								                <img src="<?php echo $father_national_id_card;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
								            </a>
								            <?php else: ?>
								            	<a target="_blank" href="<?php echo $father_national_id_card ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
								            <?php endif; ?>
										  </div>
								  	<!-- Field 3: Applicant Father NIC:End -->

								  	<h4 class="text-success fw-bolder mt-5">Bank Account Info</h4>
			  		  			<!-- Field Bank Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12" ><b>Bank Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_name" id="bank-name" placeholder='Bank Name' class="form-control" value="<?php echo $bank_name??'';  ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Name :End -->

			  		  			<!-- Field Bank Branch Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Branch Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_branch_name" id="bank-branch-name" placeholder='Branch Name' class="form-control" value="<?php echo $bank_branch_name??'';  ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Branch Name :End -->
			  		  			<!-- Field Bank Account Title :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Title<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_title" id="bank-account-title" placeholder='Account Title' class="form-control" value="<?php echo $bank_account_title??'';  ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Title :End -->

			  		  			<!-- Field Bank Account Number :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Number<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_number" id="bank-account-number" placeholder='Account Number' class="form-control" value="<?php echo $bank_account_number??'';  ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Number :End -->





									<!-- MOU:Start -->
										  	<div class="col-md-12 mt-5">
											  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
											  	<ol>
													<li class="text-black">Applicant should be an orphan.</li>
													<li class="text-black">Must be taking classes full-time.</li>
													<li class="text-black">If doing a full-time or part-time job must declare the details to Hidaya.</li>
													<li class="text-black">In case of getting any scholarship or stipend from other sources, monthly or one-time, must declare to Hidaya.</li>
													<li class="text-black">In case of failure to inform Hidaya, Hidaya reserves the right to stop supporting or blacklist the applicant.</li>
													<li class="text-black">Any incorrect information provided by the applicant will be the reason for the rejection of the application.</li>
												</ol>
										  	</div>
									<!-- MOU:End -->
											<input type="hidden" name="beneficiary_id" value="<?php echo $beneficiary_id; ?>">
										  	<div class="col-md-12 ms-4 mb-5">
										    <button class="btn btn-primary" type="submit" name="update">Update</button><span class="invalid-feedback" id="error-appropriate" style="display:<?php echo (isset($_SESSION['update-error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;To Submit Your Application, Please fill out the form appropriately</b></span>
										    <!-- <input type="submit" class="btn btn-primary" name="submit" value="Submit"> -->
									  		</div>
								</div>
							</div>
						</form>
				</div>
			</div>
	<?php
		}
		/*Beneficiary Update Beneficiary Form Admin Side :End*/


		/*Beneficiary Update Beneficiary Essential Doc's Status Status Form Admin Side :Start*/
		public function beneficiary_essential_doc_form($beneficiary_record,$applicant_id)
		{
			extract($beneficiary_record);
		?>

			<form class="row g-3" onsubmit="return validateEssentialDocForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">

								<div class="row mt-3" id="first_tab">
									<!-- Beneficiary Doc CheckList :Start -->
									    <div class="col-md-12  p-3 mt-3">
									    	<h3 class="text-success fw-bolder">Essential Document's List</h3>
									    	<div class="col-md-12 my-auto table-responsive">
												    <table class="table">
												    	<tr class="text-start">
												    		<th>1. Applicant CNIC</th> <th class="text-start"><i class="bi <?php echo ($applicant_cnic_image != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
												    	</tr>	
													    <tr>
													    	<th>2. Applicant Profile Image</th> <th><i class="bi <?php echo ($applicant_picture != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													    <tr>
													    	<th>3. Applicant Marksheets/Transcript - Last 2 Years</th> <th><i class="bi <?php echo ($marksheet != 0)?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													    <tr>
													    	<th>4. Father's/Guardian's CNIC</th> <th><i class="bi <?php echo ($father_national_id_card != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													    <tr>
													    	<th>5. Father's/Guardian's Income Statement/Pension</th> <th><i class="bi <?php echo ($income_document != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													    <tr>
													    	<th>6. Father's Death Certificate</th> <th><i class="bi <?php echo ($father_death_certificate_image != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													    <tr>
													    	<th>7. Family Registration Certificate (FRC Nadra)</th> <th><i class="bi <?php echo ($nadra_family_registration_certificate != "")?'bi-check2-circle text-success':'bi-x-circle text-danger' ?> fs-5"></i></th>
													    </tr>
													</table>	    
											</div>
									    </div>
						    		<!-- Beneficiary Doc CheckList :End -->
						    	</div>
						    	
						    	<!-- Next Button :Start -->
							  	<div class="row mt-3">
							   		<div class="col-sm-8"></div>
			                        <div class="col-sm-4 text-right">
										<input type="hidden" name="beneficiary_id" value="<?php echo $applicant_id; ?>">
										<input type="hidden" name="b_first_name" value="<?php echo $applicant_first_name; ?>">
										<input type="hidden" name="b_last_name" value="<?php echo $applicant_last_name; ?>">
										<input type="hidden" name="action" value="essential_doc">
										<div class="float-end">
					    	    			<!-- <button class="btn btn-primary" type="submit" name="save">Save</button> -->
											<button type="button" class="btn btn-success" id="nextBtn">Next</button>
										</div>
									</div>
		                    	</div>
						  		<!-- Next Button :End -->
			</form>
		<?php
		}
		/*Beneficiary Update Beneficiary Essential Doc's Status Form Admin Side :End*/


		/*Beneficiary Support Status Form :Start*/
		public function beneficiary_support_status_form($beneficiary_record,$applicant_id){
			extract($_GET);
			extract($beneficiary_record);
		?>
			<form class="row g-3" onsubmit="return validateApplicantStatus()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">

									<div class="col-md-<?php echo ($applicant_support_record->num_rows == 0)?'12':'6' ?>"> <!-- col-md-6 (data exist in support start) Or col-md-12 (data not exist in support start) -->
										

										<!-- Field: Applicant Status:Start -->
											<div class="row mt-3">
												<label class="form-label col-sm-12"><b>Applicant Status <span class="text-danger">*</span></b></label>
												<div class="col-sm-3 my-auto">
												  	<div class="input-group has-validation">
												  		<div class="form-check">
														  	<input class="form-check-input" type="radio" name="applicant_status" value="1" <?php echo ($application_status === '1' || $application_status === '2' || $application_status === '3')?'checked':'' ?> >
														  	<label class="form-check-label">
														    	Approve
														  	</label>
															</div>
													</div>
												</div>
												  <!--  -->
											  	<div class="col-sm-3 my-auto">
											    	<div class="form-check">
												  		<input class="form-check-input" type="radio" name="applicant_status" value="0" <?php echo ($application_status === '0')?'checked':'' ?> <?php echo ($application_status == '1' || $application_status == '2' || $application_status == '3' )?'disabled':''; ?> >
													  	<label class="form-check-label">
													    	Reject
													  	</label>
														</div>
											  	</div>
											  	<div class="invalid-feedback" id="error-applicant-status"></div>

									            <div class="row mt-2">
											   		<div class="col-sm-12">
									                  	<label class="form-label"><b>Comment <span class="text-danger">*</span></b></label>      
												  		<textarea class="form-control"  name="comment"><?php  echo $application_comments??''; ?></textarea>
													 	 <div class="invalid-feedback" id="error-applicant-status-comment"></div>
									            	</div>
												</div>

												 <div class="row mt-2">
											   		<div class="col-sm-12">
									                  	<label class="form-label"><b>Written Test Marks<span class="text-danger">*</span></b></label>      
												  		<input type="number"  class="form-control" name="written_test_marks" value="<?php  echo $written_test_marks??''; ?>">
													 	 <div class="invalid-feedback" id="error-written-test-marks"></div>
									            	</div>
												</div>
											</div>	
									    <!-- Field: Applicant Status:End -->
									    	
											<div class="row mt-2" id="applicant-support-box" style="display:<?php echo ($application_status === '1' || $application_status === '2' || $application_status === '3')?'':'none' ?>;">
											    
												<!-- Fianancial support heading :Start -->
													<div class="col-md-12">
														<h3 class="text-success fw-bolder mt-3">Financial Support</h3>
													</div>
												<!-- Fianancial support heading :End -->

											    <!-- Field: Applicant Start Support:Start -->
												  	<div class="col-md-4"> 
												  		<label class="form-label"><b>Start Support <span class="text-danger">*</span></b></label>
												    	<input type="date" class="form-control" name="support_start" value="<?php if(($last_applicant_support_record != '0')){  echo  (date( 'Y-m-d' ,strtotime($last_applicant_support_record['support_start_date']))) ??'';   }  ?>">
												    	<div class="invalid-feedback" id="error-support-start" style="display:<?php echo isset($start)?'block':''; ?>;" ><?php echo ($start)??''; ?></div>
												  	</div>
												<!-- Field: Applicant Start Support:End -->

												<!-- Field: Applicant Stop Support:Start -->
												  	<div class="col-md-4">
												  		<label class="form-label"><b>Stop Support</b></label>
												    	<input type="date" class="form-control" name="support_stop" value="<?php  if(isset($last_applicant_support_record['support_end_date'])){  echo date( 'Y-m-d' ,strtotime($last_applicant_support_record['support_end_date']));  }  ?>" <?php 

												    	echo (isset($last_applicant_support_record['support_status']) && $last_applicant_support_record['support_status']  == '0' ) || (!isset($last_applicant_support_record['support_status']))?'disabled':'' ?>>
												  	</div>

												<!-- Field: Applicant Stop Support:End -->

												<!-- Field: Applicant Support Amount:Start -->
												  	<div class="col-md-4">
												  		<label class="form-label"><b>Support Amount <span class="text-danger">*</span></b></label>
												    	<input type="number" class="form-control" name="support_amount" value="<?php  echo $last_applicant_support_record['support_amount']??''; ?>">
												  		<div class="invalid-feedback" id="error-support-amount" style="display:<?php echo isset($amount)?'block':''; ?>; "><?php echo ($amount)??''; ?></div>
												  	</div>
												<!-- Field: Applicant Support Amount:End -->
												<div class="invalid-feedback" id="error-support-stop" style="display:<?php echo isset($stop)?'block':''; ?>;" >
													<?php echo $stop??'';?>
												</div>
											</div>
									
											<!-- Next Button :Start -->
										  	<div class="row mt-3 mb-3">
										   		<div class="col-sm-8"></div>
						                        <div class="col-sm-4 text-right">
													<input type="hidden" name="beneficiary_id" value="<?php echo $applicant_id; ?>">
													<input type="hidden" name="action" value="applicant_status">
													<input type="hidden" name="beneficiary_application_status_id" 
														   value="<?php echo $last_applicant_support_record['beneficiary_application_status_id']??'' ?>">
					
													<div class="float-end">
								    	    			<button class="btn btn-success" type="submit" name="save_status">Save</button>
														<!-- <button type="button" class="btn btn-success" id="nextBtn">Next</button> -->
													</div>
												</div>
					                    	</div>
									  		<!-- Next Button :End -->
									</div>
									
									<?php 
										if(isset($applicant_support_record) && $applicant_support_record->num_rows > 0){
									?>
									
									<!-- Application Support History:Start -->											
									<div class="border-start col-md-<?php echo ($applicant_support_record->num_rows == 0)?'12':'6' ?> p-3"> <!-- col-md-6 (data exist in support start) Or col-md-12 (data not exist in support start) -->
								    	<h3 class="text-success fw-bolder text-center">Applicant Support History</h3>
								    	<div class="col-md-12 my-auto table-responsive">
											    <table class="table">
											    	<thead>
												    	<tr class="text-start">
												    		<th>Support Start</th>
												    		<th>Support End</th>
												    		<th>Support Amount</th>
												    		<th>Support Status</th>
												    	</tr>
												    </thead>
											    	<tbody>
											    		<?php 
											    		while ($row = mysqli_fetch_assoc($applicant_support_record)) {
											    		?>
											    			<tr>
											    				<td><?php echo date("d M Y", strtotime($row['support_start_date'])); ?></td>
											    				<td><?php echo ($row['support_end_date'] != '')?date("d M Y", strtotime($row['support_end_date'])):''; ?>
											    				</td>
											    				<td><?php echo $row['support_amount'];?></td>
											    				<td> <span  class="badge text-bg-<?php echo ($row['support_status'] == 1)?'success':'danger'; ?>" ><?php echo ($row['support_status'] == 0)?'Stop':'Start';?></span></td>
											    			</tr>
											    			<?php
											    		}
											    		?>
											    	</tbody>	
												</table>
										</div>	
									</div>	
									<!-- Application Support History:End -->											
									<?php 
										}
									?>
									
			</form>
		<?php	
		}
		/*Beneficiary Support Status Form :End*/

		/*Beneficiary Save Request Form:Start*/
		public function request_to_save_form()
		{
			?>
				<form class="row g-3" onsubmit=""  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>">

					<!-- Field: Applicant Contact Email:Start -->
					  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
					  	<div class="col-md-12 my-auto">
					    	<input type="email" class="form-control <?php echo isset($_SESSION['error']['email'])?'is-invalid':'';  ?>" id="email" name="email" value="<?php echo $_SESSION['data']['email']??''; ?>" placeholder="Email" required ="">
					    	<div class="invalid-feedback" id="error-email">
					      	<?php echo $_SESSION['error']['email']??''; ?>
					    	</div>
					    </div>
					<!-- Field: Applicant Contact Email:End -->


					<!-- Submit Button:Start -->
					  	<div class="col-md-12 mb-5 mt-4 text-center">
					    	<button class="btn btn-primary" type="submit" name="submit">Submit</button>
					    	<a  href="index.php" class="btn btn-secondary" >Cancel</a>
					    </div>
					<!-- Submit Button:End -->

				</form>
			<?php
		}
		/*Beneficiary Save Request Form:End*/

		/*Beneficiary save data submit form:Start*/		
		public function BeneficiarySaveDataForm($data = null)
		{
			if(is_array($data)){
				extract($data);
			}

			?>
			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			    <button class="nav-link active" id="nav-father-alive-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Applicant Father Information</button>
			    <button class="nav-link" id="nav-personal-info-tab-edit" data-bs-toggle="tab" data-bs-target="#nav-personal-info-edit" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Applicant Information</button>
			  </div>
			</nav>
			
			<div class="tab-content" id="nav-tabContent">

				<form class="row g-3" onsubmit="return validateBeneficiarySaveDataForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">
					<!-- Tab 1 :Start -->
					<div class="tab-pane fade show active" id="nav-father-alive" role="tabpanel" aria-labelledby="nav-father-alive-tab" style="display:block;">

						<div class="row mt-3" id="first_tab">
							<!-- Field: Applicant Is Father Alive:Start -->
								<label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
								<div class="col-sm-2 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input id="edit_father_alive" class="form-check-input is_father_alive_edit" type="radio" name="is_father_alive" value="Yes" <?php echo (isset($is_father_alive) && $is_father_alive == "Yes")?'checked':'';?>  >
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-2 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input is_father_alive_edit" type="radio" name="is_father_alive" value="No" <?php echo (isset($is_father_alive) && $is_father_alive == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-father-alive" style="display:block ;">
							  		Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.
							    </div>
							<!-- Field: Applicant Is Father Alive:End -->

						   	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):Start -->
							  		<div class="mt-3" id="father-death-certificate-file" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
							  			<label class="form-label col-sm-12"><b>Scanned image of the father's death certificate issued by the authorized department <span class="text-danger">*</span></b>  <span> 
							  				<?php if((pathinfo($father_death_certificate_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>	
							  				<img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class=" border border-dark rounded border border-dark" alt="No Image" width="40px" height="40px" /> </span> 
							  				<?php else: ?>
                                            	<a target="_blank" href="<?php echo $father_death_certificate_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                            <?php endif; ?>
							  			</label>
							  			<div class="col-md-12 my-auto">
								  			<input type="file" name="applicant_father_death_certificate" id="f-death-certificate-file" class="form-control <?php echo isset($father_death_certificate_image)?'':'is-invalid';  ?>">
								  			<input type="hidden" name="hidden_father_death_certificate" value="<?php echo isset($father_death_certificate_image)?"1":"0"; ?>">
								  				<div  class="invalid-feedback col-sm-12" id="error-father-death-certificate"></div>
								  		</div>
								  	</div>
						  	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):End -->

							<!-- Field: Applicant Father CNIC:Start -->
							  	<div class="mt-3" id="father_nic" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
							  	  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
							  	  	<div class="col-md-12 my-auto">
							  	    	<input type="number" class="form-control" name="father_cnic" value="<?php echo $father_cnic??''; ?>" placeholder="Father National ID Card No">
							  		    <div class="invalid-feedback" id="error-father-cnic">
							  		    </div>
							  	  	</div>
							  	</div>
						  	<!-- Field: Applicant Father CNIC:End -->

						  	<!-- Field: Applicant Father Name:Start -->
						  	  	<label class="form-label col-sm-12" id="father_label"><b> Father Name <span class="text-danger">*</span></b></label>
						  	  	<div class="col-md-4 my-auto" id="f_first_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_first_name" value="<?php echo $father_first_name??''; ?>" placeholder="First Name">
						  		    <div class="invalid-feedback" id="error-father-first-name">
						  		    </div>
						  	  	</div>
						  	  	<div class="col-md-4 my-auto" id="f_middle_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_middle_name" value="<?php echo $father_middle_name??''; ?>"  placeholder="Middle Name">
						  	    	<div class="invalid-feedback" id="error-father-middle-name">
						  	      	</div>
						  	  	</div>
						  	  	<div class="col-md-4 my-auto" id="f_last_name" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	    	<input type="text" class="form-control bottom-margin" name="father_last_name" value="<?php echo $father_last_name??''; ?>"  placeholder="Last Name">
						  	    	<div class="invalid-feedback" id="error-father-last-name">
						  	      	</div>
						  	  	</div>
						  	<!-- Field: Applicant Father Name:End -->

						  	<!-- Field: Applicant Father Occupation:Start -->
						  		<div class="mt-3" id="father_occupations" style="display:<?php echo (isset($is_father_alive) && $is_father_alive == "No")?'block':'none';?>">
						  	  		<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
						  	  		<div class="col-md-12 my-auto">
						  	    		<input type="text" class="form-control" name="father_occupation" value="<?php echo $father_occupation??''; ?>">
						  		    	<div class="invalid-feedback" id="error-father-occupation">
						  		      	</div>
						  	  		</div>
						  	  	</div>
						  	<!-- Field: Applicant Father Occupation:End -->

							<!-- Next Button :Start -->
						  	<div class="row mt-3">
						   		<div class="col-sm-10"></div>
		                        <div class="col-sm-2 text-right">
									<button type="button" class="btn btn-success float-end" id="nextBtn-edit" style="display:<?php echo isset($father_death_certificate_image)?'block':'none';  ?>;">
		                                Next
		                            </button>
		                        </div>
	                    	</div>
						  	<!-- Next Button :End -->

							<span class="invalid-feedback" id="" style="display:none;"><b>&nbsp;&nbsp;Note: To Submit Your Application, Please fill out the form appropriately</b></span>
						</div>
					</div>
					<!-- Tab 1 :End -->

					<!-- Tab 2 :Start -->
					<div class="tab-pane fade" id="nav-personal-info-edit" role="tabpanel" aria-labelledby="nav-personal-info-tab-edit">
					    <div class="row  mt-3">
							<!-- Field: Name Of Applicant:Start -->
							  	<label class="form-label col-sm-12"><b>Name of Applicant <span class="text-danger">*</span></b></label>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['first_name'])?'is-invalid':'bottom-margin';  ?>" name="first_name" value="<?php echo $applicant_first_name??''; ?>" placeholder="First Name">
								    <div class="invalid-feedback" id="error-first-name">
								    	<?php echo $_SESSION['error']['first_name']??''; ?>
								    </div>
							  	</div>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['middle_name'])?'is-invalid':'bottom-margin';  ?>" name="middle_name" value="<?php echo $applicant_middle_name??''; ?>" placeholder="Middle Name">
							    	<div class="invalid-feedback" id="error-middle-name">
							    		<?php echo $_SESSION['error']['middle_name']??''; ?>
							      	</div>
							  	</div>
							  	<div class="col-md-4 my-auto">
							    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['last_name'])?'is-invalid':'bottom-margin';  ?>" name="last_name" value="<?php echo $applicant_last_name??''; ?>" placeholder="Last Name">
							    	<div class="invalid-feedback" id="error-last-name">
							    		<?php echo $_SESSION['error']['last_name']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Name Of Applicant:End -->

						    <!-- Field: Applicant Gender:Start -->
						 		<label class="form-label col-sm-12"><b>Gender <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($applicant_gender) && $applicant_gender == "Male")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Male
									  	</label>
										</div>
									</div>
								</div>
								<div class="col-sm-6 my-auto">
								    <div class="form-check">
									  <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($applicant_gender) && $applicant_gender == "Female")?'checked':'';?>>
									  <label class="form-check-label">
									    Female
									  </label>
									</div>
								</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-gender" style="display:none;">
							    </div>
						    <!-- Field: Applicant Gender:End -->

							<!-- Field: Applicant Contact Number:Start -->
							  	<label class="form-label col-sm-12"><b> Contact Number <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 923001234567)</span></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="number" class="form-control" name="contact_number" value="<?php echo $applicant_contact_number??''; ?>" placeholder="Phone Number">
							    	<div class="invalid-feedback" id="error-contact-number" style="display: <?php echo isset($_SESSION['error']['contact_number'])?"block":"none";?>;">
							    		<?php echo $_SESSION['error']['contact_number']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Applicant Contact Number:End -->

							<!-- Field: Applicant Contact Email:Start -->
							  	<label class="form-label col-sm-12"><b> Contact Email <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="email" class="form-control" id="email" name="email" value="<?php echo $applicant_email??''; ?>" placeholder="Email">
							    	<div class="invalid-feedback" id="error-email">
							    		<?php echo $_SESSION['error']['email']??''; ?>
							      	</div>
							    </div>
							<!-- Field: Applicant Contact Email:End -->

						    <!-- Field: Applicant Date of Birth:Start -->
							  	<label class="form-label col-sm-12"><b> Date of Birth <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="date" class="form-control" name="date_of_birth" value="<?php echo $applicant_date_of_birth??''; ?>">
							    	<div class="invalid-feedback" id="error-dob">
							    		<?php echo $_SESSION['error']['dob']??''; ?>
							      	</div>
							  	</div>
							<!-- Field: Applicant Date of Birth:End -->

							<!-- Field: Applicant CNIC:Start -->
							  	<label class="form-label col-sm-12"><b> National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
							  	<div class="col-md-12 my-auto">
							    	<input type="number" class="form-control" name="applicant_cnic" value="<?php echo $applicant_cnic??''; ?>" placeholder="National ID Card No" id="cnic">
								    <div class="invalid-feedback" id="error-cnic">
								    	<?php echo  $_SESSION['error']['app_cnic']??''; ?>
								    </div>
								</div>
							<!-- Field: Applicant CNIC:End -->

							<!-- Field: Applicant CNIC Picture:Start -->
							  	<label class="form-label col-sm-12"><b>Scanned image of National ID Card No <span class="text-danger">*&nbsp;</span></b> <span> 
							  		<?php if((pathinfo($applicant_cnic_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  		<img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded border border-dark" width="40px" height="40px" />
									<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_cnic_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?> 
							  	</span>  
							  	</label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_cnic_picture" class="form-control">
								  	<input type="hidden" name="hidden_applicant_cnic_picture" value="<?php echo isset($applicant_cnic_image)?"1":"0"; ?>">
								  	<div class="invalid-feedback" id="error-applicant-cnic-picture" style="display:<?php echo isset($_SESSION['error']['applicant_cnic_picture'])?'block':'';?>">
								  		<?php echo  $_SESSION['error']['applicant_cnic_picture']??''; ?>
								    </div>
								  </div>
							<!-- Field: Applicant CNIC Picture:End -->

							<!-- Field: Applicant Current Address:Start -->
							  	<label class="form-label col-sm-12"><b> Current Address <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							    	<textarea class="form-control" name="current_address" <?php echo ($applicant_permanent_address === $applicant_current_address)?'readonly':'';  ?>><?php echo $applicant_current_address??''; ?></textarea>
								    <div class="invalid-feedback" id="error-current-address"style="display:<?php echo isset($_SESSION['error']['current_address'])?'block':'none';  ?>;">
								    	<?php echo  $_SESSION['error']['current_address']??''; ?>
								    </div>
							  	</div>
							<!-- Field: Applicant Current Address:End -->

							<!-- Field: Applicant Permanent Address:Start -->
							  	<label class="form-label col-sm-12"><b> Permanent Address <span class="text-danger">*</span></b>

							  		<label class="form-check-label float-end"><span class="text-danger"> <input class="form-check-inputs" name="same_as_current_add" type="checkbox" <?php echo ($applicant_permanent_address === $applicant_current_address)?'checked':'';  ?>  value="Yes" >&nbsp;</span><b>Same As Current Address</b></label>

							  	</label>
							  	<div class="col-md-12 my-auto">
							    	<textarea class="form-control" name="permanent_address"  <?php echo ($applicant_permanent_address === $applicant_current_address)?'readonly':'';  ?>   ><?php echo $applicant_permanent_address??''; ?></textarea>
								    <div class="invalid-feedback" id="error-permanent-address"style="display:<?php echo isset($_SESSION['error']['permanent_address'])?'block':'none';  ?>;">
								    	<?php echo $_SESSION['error']['permanent_address']??''; ?>
								    </div>
							  	</div>
							<!-- Field: Applicant Permanent Address:End -->

							<!-- Field: Applicant Picture:Start -->
							  	<label class="form-label col-sm-12"><b> Picture <span class="text-danger">*</span></b> <span> 
							  		<?php if((pathinfo($applicant_picture,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  		<img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5" onerror="this.src='../assets/user_default.png'" alt="No Image" width="50px" height="50px" /> 
							  		<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_picture ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?> 
							  	</span> 
							  	</label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_picture" class="form-control">
								  	<input type="hidden" name="hidden_applicant_picture" value="<?php echo isset($applicant_picture)?"1":"0"; ?>">
								  	<div class="invalid-feedback" id="error-applicant-picture" style="display:<?php echo isset($_SESSION['error']['applicant_picture'])?'block':'';?>" >
								  		<?php echo $_SESSION['error']['applicant_picture']??'';?>
								    </div>
								  </div>
							<!-- Field: Applicant Picture:End -->
							
							<!-- Field: Applicant Student ID Card Image:Start -->
							  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card <span class="text-danger">*</span></b> <span>	<?php if((pathinfo($applicant_student_id_card_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>	 
							  		<img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded border border-dark" width="40px" height="40px" />  
							  		<?php else: ?>
                                    	<a target="_blank" href="<?php echo $applicant_student_id_card_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
                                    <?php endif; ?>
							  	</span>  </label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_student_id_card_image" class="form-control">
								  	<input type="hidden" name="hidden_student_id_card_image" value="<?php echo isset($applicant_student_id_card_image)?"1":"0"; ?>">
								  	<div class="invalid-feedback" id="error-applicant-student-id-card-image" style="display:<?php echo isset($_SESSION['error']['applicant_student_id_card_image'])?'block':'';?>" >
								  		<?php echo $_SESSION['error']['applicant_student_id_card_image'];?>
								  	</div>
								  </div>
							<!-- Field: Applicant Student ID Card Image:End -->

							<!-- Field: Applicant Highest Academic Degree:Start -->
							  	<label class="form-label col-sm-12"><b> Highest Academic Degree <span class="text-danger">*</span></b></label>
							  	<div class="col-md-12 my-auto">
							  		<select class="form-select <?php echo isset($_SESSION['error']['highest_degree'])?'is-invalid':'';  ?>" name="applicant_highest_academic_degree">
							      	<option value="">--Please Select--</option>
							      	<?php foreach($this->get_academic_degree() as $key => $degree){
							      	?>
							      		<option value="<?php echo $degree['academic_degree_id']; ?>" <?php echo (isset($academic_degree_id) && $academic_degree_id == $degree['academic_degree_id'])?'selected':'';?> ><?php echo $degree['degree_title']; ?></option>
							      	<?php	
							      	}?>
							      	</select>
								    <div class="invalid-feedback" id="error-highest-degree">
								    	<?php echo $_SESSION['error']['highest_degree']??'';?>
								    </div>
							  	</div>
							<!-- Field: Applicant Highest Academic Degree:End -->

							<!-- Field: Applicant Marksheet Image:Start -->
							  	<label class="form-label col-sm-12"><b>Scanned image of the last 2 academic records</b>  <?php if(isset($marksheet)){
							  		foreach($marksheet as $file){?>   
							  			<span class="ms-1">
							  				<?php if((pathinfo($file,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
							  				<img src="<?php echo $file; ?>" class="rounded border border-dark mb-3" alt="No Image" width="40px" height="40px" onerror="this.src='../assets/default.jpg'" />
									  		<?php else: ?>
		                                    	<a target="_blank" href="<?php echo $file ?>" class="text-decoration-none"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
		                                    <?php endif; ?>
							  			</span>

							  		<?php }  }  ?>  </label>
								  <div class="col-md-12 my-auto">
								  	<input type="file" name="applicant_marksheet_images[]" class="form-control" id="applicant-marksheet-images" multiple="">
								  	<div class="invalid-feedback" id="error-marksheet-images"style="display:<?php echo isset($_SESSION['error']['applicant_marksheet_images'])?'block':'';?>">
								  		<?php echo $_SESSION['error']['applicant_marksheet_images']??'';?>
								    </div>
								  </div>
							<!-- Field: Applicant Marksheet Image:End -->

							<!-- Field: Applicant Stipend For Non Muslim:Start -->
								<label  class="form-label col-sm-12" style="display: none" ><b>(Non-Muslim Only) I would like to apply for stipend</b></label>
								<div class="col-sm-6 my-auto" style="display: none">
								  	<div class="input-group has-validation">
								  		<div class="form-check">
										  <input checked class="form-check-input" type="radio" name="stipend_for_non_muslim" value="Yes" <?php echo (isset($applicant_apply_for_stipend) && $applicant_apply_for_stipend == "Yes")?'checked':'';?>>
										  <label class="form-check-label">
										    Yes
										  </label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto" style="display: none">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="stipend_for_non_muslim" value="No" <?php echo (isset($applicant_apply_for_stipend) && $applicant_apply_for_stipend == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							<!-- Field: Applicant Stipend For Non Muslim:End -->

							<!-- Field: Applicant Eligible For Zakat:Start -->
								<label class="form-label col-sm-12"><b>(Muslim Only) Is the applicant eligible to receive zakat?</b></label>
								<div class="col-sm-6  my-auto">
								  	<div class="input-group has-validation">
								  		<div class="form-check">
										  <input class="form-check-input" type="radio" name="eligible_for_zakat" value="Yes" <?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'checked':'';?>>
										  <label class="form-check-label">
										    Yes
										  </label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="eligible_for_zakat" value="No" <?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "No")?'checked':'';?> >
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							<!-- Field: Applicant Eligible For Zakat:End -->

							<!-- Field 1: Applicant Eligible For Zakat (If Yes):Start -->
							  	<div id="zakat-reason-box" style="display:<?php echo (isset($applicant_eligible_receive_zakat) && $applicant_eligible_receive_zakat == "Yes")?'block':'none';?>;">
							  		<label  class="form-label col-sm-12 zakat-dependent-class"><b>Why <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<input type="text" class="form-control" name="reason_for_zakat" value="<?php echo $applicant_reason_receive_zakat??''; ?>">
								    	<div class="invalid-feedback" id="error-reason-zakat">
								    		<?php echo $_SESSION['error']['reason_for_zakat']??''; ?>
								      	</div>
							  		</div>
							  	</div>
							<!-- Field 1: Applicant Eligible For Zakat (If Yes):End -->

							<!-- Field: Is Applicant Current Enrolled In University:Start -->
								<label  class="form-label col-sm-12"><b>Currently enrolled at university? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6  my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="Yes" <?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6  my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="is_currently_enrolled_in_uni" value="No" <?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-currently-enrolled-uni" style="display:<?php echo isset($_SESSION['error']['is_currently_enrolled_in_uni'])?'block':'none';  ?>;">
							  		<?php echo $_SESSION['error']['is_currently_enrolled_in_uni']??''; ?>
							   	</div>
							<!-- Field: Is Applicant Current Enrolled In University:End -->

							<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which university? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<select class="form-select" name="univerity">
							      			<option value="">--Please Select--</option>
							      			<?php foreach($this->get_university() as $key => $univerity){?>
										      		<option value="<?php echo $univerity['university_id']; ?>" <?php echo (isset($unversity_id) && $unversity_id == $univerity['university_id'])?'selected':'';?> >
										      			<?php echo $univerity['university_name']; ?>
										      		</option>
										    <?php } ?>
							    		</select>
							    		<div class="invalid-feedback" id="error-university"style="display:<?php echo isset($_SESSION['error']['univerity'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['univerity'];?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 1: Which Uiversity Enrolled (If Currently Enrolled Uni Yes):End -->

							<!-- Field 2: In Which Year (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which year currently studying? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 zakat-dependent-class my-auto">
							    		<select class="form-select" name="univerity_year">
							      		<option value="">--Please Select--</option>
							      		<?php foreach($this->get_enrolled_year() as $key => $year){?>
							      			<option value="<?php echo $year['current_enrolled_year_id']; ?>" <?php echo (isset($current_enrolled_year_id) && $current_enrolled_year_id == $year['current_enrolled_year_id'])?'selected':'';?> > 
							      				<?php echo $year['enrolled_year']; ?>
							      			</option>
							      		<?php } ?>	
							    		</select>
							    		<div class="invalid-feedback" id="error-university-year" style="display:<?php echo isset($_SESSION['error']['univerity_year'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['univerity_year'];?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 2: Which Uiversity Enrolled (If Current Enrolled Uni Yes):End -->

							<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>In which month and year the current degree will be completed? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" data-date-format="MM yyyy" id='txtDate' class="form-control" name="degree_completed_year" value="<?php echo $passing_degree_year??''; ?>">
							    		<div class="invalid-feedback" id="error-degree-year" 
							    		style="display:<?php echo isset($_SESSION['error']['degree_completed_year'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['degree_completed_year'];?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 3: Complete Degree In Which Year (If Currently Enrolled Uni Yes):End -->

							<!-- Field 4: Degree Yearly Expenses (If Currently Enrolled Uni Yes):Start -->
							  	<div class="university-box" style="display:<?php echo (isset($applicant_currently_enrolled) && $applicant_currently_enrolled == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>Total yearly educational expenses</b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="degree_yearly_expenses" value="<?php echo $expense_Of_education??''; ?>" />
							    	</div>
							  	</div>
							<!-- Field 4: Yearly Expenses (If Currently Enrolled Uni Yes):End -->

							<!-- Field: Applicant Univeristy Admission:Start -->
								<label class="form-label col-sm-12"><b> University Admission <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="applicant_university_admission" value="Merit" <?php echo (isset($applicant_university_admission_type) && $applicant_university_admission_type == "Merit")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Merit-Based
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="applicant_university_admission" value="Self" <?php echo (isset($applicant_university_admission_type) && $applicant_university_admission_type == "Self")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Self-Support
									  	</label>
										</div>
							  	</div>
							  	<div class="invalid-feedback col-sm-12" id="error-uni-admission" style="display:<?php echo isset($_SESSION['error']['applicant_university_admission'])?'block':'none';  ?>;">
							  		<?php echo $_SESSION['error']['applicant_university_admission'];?>
							  	</div>
							<!-- Field: Applicant Univeristy Admission:End -->

							<!-- Field: Is Applicant Current Working:Start -->
								<label class="form-label col-sm-12"><b>Currently working? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="is_currently_working" value="Yes" <?php echo (isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	 <div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="is_currently_working" value="No" <?php echo (isset($applicant_currently_working) && $applicant_currently_working == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	 </div>
							  	 <div  class="invalid-feedback col-sm-12" id="error-currently-working" style="display:<?php echo isset($_SESSION['error']['is_currently_working'])?'block':'none';  ?>;">
							  	 	<?php echo $_SESSION['error']['is_currently_working'];?>
							  	 </div>
							<!-- Field: Is Applicant Current Working:End -->			  

							<!-- Field 1: How Much (If Currently Working Uni Yes):Start -->
							  	<div id="current-working-box" style="display:<?php echo (isset($applicant_currently_working) && $applicant_currently_working == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, how much money earn per month <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="how_much_earning" value="<?php echo $applicant_how_much_earn_per_month??''; ?>">
							    		<div class="invalid-feedback" id="error-how-much-earning"style="display:<?php echo isset($_SESSION['error']['how_much_earning'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['how_much_earning'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 1: How Much (If Currently Working Uni Yes):End -->

							<!-- Field: Is Applicant Have Any Skill Or Training:Start -->
								<label class="form-label col-sm-12"><b>Have any skills or completed any skilful training? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="applicant_skill" value="Yes" <?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="applicant_skill" value="No" <?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "No")?'checked':'';?> >
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div class="invalid-feedback col-sm-12" id="error-skill" style="display:<?php echo isset($_SESSION['error']['applicant_skill'])?'block':'none';  ?>;">
							  		<?php echo $_SESSION['error']['applicant_skill'];?>
							  	</div>
							<!-- Field: Is Applicant Have Any Skill Or Training:End -->

							<!-- Field 1: What Skill (If Applicant Skill Yes):Start -->
							  	<div id="skill-box" style="display:<?php echo (isset($does_applicant_have_skills) && $does_applicant_have_skills == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, what? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="what_skill" value="<?php echo $what_applicant_skills??''; ?>">
							    		<div class="invalid-feedback" id="error-what-skill" style="display:<?php echo isset($_SESSION['error']['what_skill'])?'block':'none';  ?>;">
							      		<?php echo $_SESSION['error']['what_skill'];?>
							    		</div>
							  		</div>
							  	</div>
							<!-- Field 1: What Skill (If Applicant Skill Yes):End -->

							<!-- Field: Is Applicant Recieved Any Financial Help:Start -->
								<label class="form-label col-sm-12"><b>Received any financial help from other sources besides parents such as government or university, in last 2 years? <span class="text-danger">*</span></b></label>
								<div class="col-sm-6 my-auto">
							  	<div class="input-group has-validation">
							  		<div class="form-check">
									  	<input class="form-check-input" type="radio" name="financial_help" value="Yes" <?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'checked':'';?>>
									  	<label class="form-check-label">
									    	Yes
									  	</label>
										</div>
									</div>
								</div>
							  
							  	<div class="col-sm-6 my-auto">
							    	<div class="form-check">
								  		<input class="form-check-input" type="radio" name="financial_help" value="No" <?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "No")?'checked':'';?>>
									  	<label class="form-check-label">
									    	No
									  	</label>
										</div>
							  	</div>
							  	<div  class="invalid-feedback col-sm-12" id="error-financial-help" style="display:<?php echo isset($_SESSION['error']['financial_help'])?'block':'none';  ?>;">
							  		<?php echo $_SESSION['error']['financial_help'];?>
							  	</div>
							<!-- Field: Is Applicant Recieved Any Financial Help:End -->

							<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):Start -->
							  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>If yes, how much? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="how_much_financial_help" value="<?php echo $how_much_applicant_received_financial_help??''; ?>">
							    		<div class="invalid-feedback" id="error-how-much-financial-help" style="display:<?php echo isset($_SESSION['error']['how_much_financial_help'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['how_much_financial_help'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 1: How Much (If Applicant Recieved Any Financial Help Yes):End -->
							  
							<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):Start -->
							  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
							  		<label class="form-label col-sm-12"><b>From where? <span class="text-danger">*</span></b></label>
							  		<div class="col-md-12 my-auto">
							    		<input type="text" class="form-control" name="from_where_financial_help" value="<?php echo $from_where??''; ?>">
							    		<div class="invalid-feedback" id="error-from-where-financial-help" style="display:<?php echo isset($_SESSION['error']['from_where_financial_help'])?'block':'none';  ?>;">
							    			<?php echo $_SESSION['error']['from_where_financial_help'];?>
							      		</div>
							  		</div>
							  	</div>
							<!-- Field 2: From Where (If Applicant Recieved Any Financial Help Yes):End -->

							<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):Start -->
								  	<div class="financial-box" style="display:<?php echo (isset($applicant_receive_financial_help) && $applicant_receive_financial_help == "Yes")?'block':'none';?>;">
								  		<label class="form-label col-sm-12"><b>Scanned image of the notification of financial help <span class="text-danger">*</span></b> <span> 
								  			<?php if((pathinfo($financial_help_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
								  				<img src="<?php echo $financial_help_image;  ?>" class="rounded border border-dark" onerror="this.src='../assets/default.jpg'" alt="No Image" width="40px" height="40px" />  
								  				<?php else: ?>
		                                    	<a target="_blank" href="<?php echo $financial_help_image ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
		                                    <?php endif; ?>
								  		</span> </label>
								  		<div class="col-md-12 my-auto">
								    		<input type="file" class="form-control" name="financial_help_image">
								    		<input type="hidden" name="hidden_financial_image_help" value="<?php echo isset($financial_help_image)?"1":"0"; ?>">
								    		<div class="invalid-feedback" id="error-financial-help-image"style="display:<?php echo isset($_SESSION['error']['financial_help_image'])?'block':'';?>">
								    			<?php echo $_SESSION['error']['financial_help_image']??"";?>
								      		</div>
								  		</div>
								  	</div>
							<!-- Field 3: Scan Image (If Applicant Recieved Any Financial Help Yes):End -->	

							<!-- Field: Total Number Of Family Members:Start -->
								  	<label class="form-label col-sm-12"><b>Total Number of Family Members <span class="text-danger">*</span></b></label>
								  	<div class="col-md-4 my-auto">
								    	<input type="number" class="form-control bottom-margin" name="adult" value="<?php echo $total_adults??''; ?>" placeholder="Adults" min="" id="adult_member">
								    	<div class="invalid-feedback" id="error-adult" style="display:<?php echo isset($_SESSION['error']['adult'])?'block':'none';  ?>;">
								    		<?php echo $_SESSION['error']['adult'];?>
								    	</div>
								  	</div>
								  	<div class="col-md-4 my-auto">
								    	<input type="number" class="form-control bottom-margin" name="children_under_age" value="<?php echo $total_childrens??''; ?>" placeholder="Children Under 18" min="" id="under_18_member">
								    	<div class="invalid-feedback" id="error-children-under-age"
								    	style="display:<?php echo isset($_SESSION['error']['children_under_age'])?'block':'none';  ?>;" >
								    		<?php echo $_SESSION['error']['children_under_age'];?>
								    	</div>
								  	</div>

								  	<div class="col-md-4 my-auto">
								    	<input type="text" class="form-control bottom-margin" name="total_family_member" value="<?php echo $total_number_of_family_member??''; ?>" placeholder="Total" id="total_family_member" disabled>
									    <div class="invalid-feedback" id="error-total-family-members"style="display:<?php echo isset($_SESSION['error']['total_family_member'])?'block':'none';  ?>;">
									    <?php echo $_SESSION['error']['total_family_member'];?>
									    </div>
								  	</div>
							<!-- Field: Total Number Of Family Members:End -->

							<!-- Field: Total Monthly Family Income:Start -->
								  	<label class="form-label col-sm-12"><b>Total Monthly Family Income <span class="text-danger">*</span></b></label>
								  	<div class="col-md-12 my-auto">
								    	<input type="text" class="form-control bottom-margin" name="total_family_monthly_income" value="<?php echo $total_monthly_family_income??''; ?>" placeholder="Total Amount">
									    <div class="invalid-feedback" id="error-total-family-monthly-income" style="display:<?php echo isset($_SESSION['error']['total_family_monthly_income'])?'block':'none';  ?>;">
									    	<?php echo $_SESSION['error']['total_family_monthly_income'];?>
									    </div>
								  	</div>
								  	
							<!-- Field: Total Monthly Family Income:End -->

							<!-- Field: How many earning members in the family:Start -->
								<label class="form-label col-sm-12"><b>How many earning members in the family? <span class="text-danger">*</span></b></label>
								<div class="col-md-12">
							  	<input type="text" class="form-control bottom-margin" name="how_many_earning_members" value="<?php echo $how_many_earning_family_members??''; ?>" placeholder="Total earning members in the family">
							  	<div class="invalid-feedback" id="error-how-many-earning-members" style="display:<?php echo isset($_SESSION['error']['how_many_earning_members'])?'block':'none';  ?>;">
							  		<?php echo $_SESSION['error']['how_many_earning_members'];?>
							    </div>
								</div>
							<!-- Field: How many earning members in the family:End -->

							<!-- Field 1: Applicant Family Registration Certificate:Start -->
							  	<div class="" id="nadra-family-registration-certificate">
						  			<label class="form-label col-sm-12"><b>Scanned image of the nadra family registration certificate <span class="text-danger">*</span></b><span> 
									  		<?php if((pathinfo($nadra_family_registration_certificate,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
									  		<img src="<?php echo $nadra_family_registration_certificate;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
									  		<?php else: ?>
				                            	<a target="_blank" href="<?php echo $nadra_family_registration_certificate ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
				                            <?php endif; ?> 
									  	</span> 
						  			</label>
						  			<div class="col-md-12 my-auto">
							  			<input type="file" name="nadra_family_registration_certificate" id="nadra-frc-file" class="form-control <?php echo isset($nadra_family_registration_certificate)?'':'';  ?>">
							  			<input type="hidden" name="hidden_nadra_family_registration_certificate" value="<?php echo isset($nadra_family_registration_certificate)?"1":"0"; ?>">
							  			<div  class="invalid-feedback col-sm-12" id="error-frc" style="display:<?php echo isset($_SESSION['error']['nadra_family_registration_certificate'])?'block':'none';  ?>;" > <?php echo $_SESSION['error']['nadra_family_registration_certificate']??''; ?> 
							  			</div>
							  		</div>
								</div>
							<!-- Field 1: Applicant Family Registration Certificate:End -->

							<!-- Field 2: Applicant Income Document:Start -->
					  	  		<div class="" id="income-certificate">
					  	  			<label class="form-label col-sm-12"><b>Scanned image of the income document <span class="text-danger">*</span></b>
					  	  					<span> 
										  		<?php if((pathinfo($income_document,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
										  		<img src="<?php echo $income_document;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
										  		<?php else: ?>
					                            	<a target="_blank" href="<?php echo $income_document ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
					                            <?php endif; ?> 
										  	</span> 
					  	  			</label>
					  	  			<div class="col-md-12 my-auto">
					  		  			<input type="file" name="income_document" id="income-file" class="form-control <?php echo isset($income_document)?'':'';  ?>">
					  		  			<input type="hidden" name="hidden_income_document" value="<?php echo isset($income_document)?"1":"0"; ?>">
					  		  			<div  class="invalid-feedback col-sm-12" id="error-income"
					  		  			style="display:<?php echo isset( $_SESSION['error']['income_document'])?'block':'none';  ?>;"> <?php echo $_SESSION['error']['income_document']??''; ?>
					  		  			</div>
					  		  		</div>
					  		  	</div>
						  	<!-- Field 2: Applicant Income Document:End -->

						  	<!-- Field 3: Applicant Father NIC:Start -->
			  		  	  		<div class="" id="father-nic">
			  		  	  			<label class="form-label col-sm-12"><b>Scanned image of the father national id card <span class="text-danger">*</span></b><span> 
			  						  		<?php if((pathinfo($father_national_id_card,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
			  						  		<img src="<?php echo $father_national_id_card;  ?>" class="rounded border border-dark" onerror="this.src='../assets/user_default.png'" alt="No Image" width="40px" height="40px" /> 
			  						  		<?php else: ?>
			  	                            	<a target="_blank" href="<?php echo $father_national_id_card ?>" class="text-decoration-none fw-normal"><i class="bi bi-filetype-pdf text-danger fs-2"></i></a>
			  	                            <?php endif; ?> 
			  						  	</span>
			  		  	  			</label>
			  		  	  			<div class="col-md-12 my-auto">
			  		  		  			<input type="file" name="father_national_id_card" id="father-nic-file" class="form-control ">
			  		  		  			<input type="hidden" name="hidden_father_national_id_card" value="<?php echo isset($father_national_id_card)?"1":"0"; ?>">
			  		  		  			<div  class="invalid-feedback col-sm-12" 
			  		  		  			id="error-father-cnic-card" style="display:<?php echo isset($_SESSION['error']['father_national_id_card'])?'block':'none';  ?>;"> 
			  		  		  			<?php echo $_SESSION['error']['father_national_id_card']??'';?>
			  		  		  			</div>
			  		  		  		</div>
			  		  		  	</div>
			  		  		<!-- Field 3: Applicant Father NIC:End -->

			  		  				<h4 class="text-success fw-bolder mt-5">Bank Account Info</h4>
			  		  			<!-- Field Bank Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12" ><b>Bank Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_name" id="bank-name" placeholder='Bank Name' class="form-control" 
			  		  			  			value="<?php echo $_SESSION['data']['bank_name']??$bank_name; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Name :End -->

			  		  			<!-- Field Bank Branch Name:Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Branch Name<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_branch_name" id="bank-branch-name" placeholder='Branch Name' class="form-control" value="<?php echo $_SESSION['data']['bank_branch_name']??$bank_branch_name; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Branch Name :End -->
			  		  			<!-- Field Bank Account Title :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Title<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_title" id="bank-account-title" placeholder='Account Title' class="form-control" value="<?php echo $_SESSION['data']['bank_account_title']??$bank_account_title; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Title :End -->

			  		  			<!-- Field Bank Account Number :Start -->
			  		  				<div class="" id="">
			  		  		  			<label class="form-label col-sm-12"><b>Bank Account Number<span class="text-danger"></span></b></label>
			  		  		  			<div class="col-md-12 my-auto">
			  		  			  			<input type="text" name="bank_account_number" id="bank-account-number" placeholder='Account Number' class="form-control" value="<?php echo $_SESSION['data']['bank_account_number']??$bank_account_number; ?>">
			  		  		
			  		  			  			<div  class="invalid-feedback col-sm-12" id="error-">
			  		  			  			</div>
			  		  			  		</div>
			  		  			  	</div>
			  		  			<!-- Field Bank Account Number :End -->


			  		  		<!-- Field Hidden For Validation Check :Start -->
		  		  			  	<div class="hidden">
		  		  			  		<div class="col-md-12">
		  		  			  			<input type="hidden" name="hidden_value" value="0">
		  		  			  		</div>
		  		  			  	</div>
		  		  			<!-- Field Hidden For Validation Check :End -->


							<!-- MOU:Start -->
								  	<div class="col-md-12 mt-5">
								  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
								  	<ol>
											<li class="text-black">Applicant should be an orphan.</li>
											<li class="text-black">Must be taking classes full-time.</li>
											<li class="text-black">If doing a full-time or part-time job must declare the details to Hidaya.</li>
											<li class="text-black">In case of getting any scholarship or stipend from other sources, monthly or one-time, must declare to Hidaya.</li>
											<li class="text-black">In case of failure to inform Hidaya, Hidaya reserves the right to stop supporting or blacklist the applicant.</li>
											<li class="text-black">Any incorrect information provided by the applicant will be the reason for the rejection of the application.</li>
										</ol>
								  	</div>
							<!-- MOU:End -->

							<!-- Agree Checkbox:Start -->
							  	<label class="form-label col-sm-12 ms-4"><b>Memorandum of Understanding (MOU) Terms Agreement <span class="text-danger">*</span></b></label>
								  <div class="col-md-12 my-auto ms-4">
								    <div class="form-check">
								      <input class="form-check-input" name="agreement" type="checkbox" value="Yes">
								      <label class="form-check-label">
								        I state that I have read and understood the terms and conditions.
								      </label>
								      <div class="invalid-feedback" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;" id="error-agreement">
								        You must agree before submitting.
								      </div>
								    </div>
								  </div>
							<!-- Agree Checkbox:End -->


						  	<!-- Submit Button :Start -->
							  	<div class="col-md-12 ms-4 mb-5 mt-4">
							  		<input type="hidden" name="beneficiary_id" value="<?php echo $beneficiary_id??null; ?>" />
							  		<input type="hidden" name="action" value="save" />

								    <button class="btn btn-success" type="submit" name="submit" value="submit" id="submit-btn">Submit</button>

								    <button class="btn btn-primary" id="save-btn" style="display:<?php echo (isset($applicant_email))?'inline;':'none';?>;" 
								     type="submit" name="save" value="save">Save</button>
								    <span class="invalid-feedback" id="error-appropriate" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;To Submit Your Application, Please fill out the form appropriately</b></span>
								    <!-- <input type="submit" class="btn btn-primary" name="submit" value="Submit"> -->
						  		</div>
							<!-- Submit Button :End  -->

						</div>
					</div>
					<!-- Tab 2 :End -->

				</form>
			</div>
			
			<?php
		}
		/*Beneficiary save data submit form:End*/
	}
?>