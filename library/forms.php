<?php
	// session_start();
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

		public function beneficiary_form()
		{
			?>

			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			    <button class="nav-link active" id="nav-father-alive-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Father Alive</button>
			    <button class="nav-link" id="nav-personal-info-tab" data-bs-toggle="tab" data-bs-target="#nav-personal-info" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" disabled>Applicant Information</button>
			  </div>
			</nav>
			<!-- <div class="container"> -->
				<!-- <div class="borde p-4 "> -->
					<div class="tab-content" id="nav-tabContent">

						<form class="row g-3" onsubmit="return validateForm()"  action="<?php echo $this->get_action(); ?>" method="<?php echo $this->get_method(); ?>" enctype="multipart/form-data">
							<div class="tab-pane fade show active" id="nav-father-alive" role="tabpanel" aria-labelledby="nav-father-alive-tab" style="display:;">

								<!-- Field: Applicant Is Father Alive:Start -->
									<div class="row mt-3" id="first_tab">
										<label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
										<div class="col-sm-2 my-auto">
										  	<div class="input-group has-validation">
										  		<div class="form-check">
											  	<input class="form-check-input is_father_alive" type="radio" name="is_father_alive" value="Yes" <?php echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "Yes")?'checked':'';?>>
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
											  				<div  class="invalid-feedback col-sm-12" id="error-father-death-certificate">
											      			 
											   				</div>
											  		</div>
											  	</div>
										  	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):End -->





										   	<div class="row mt-3">
										   		<div class="col-sm-10"></div>
						                        <div class="col-sm-2 text-right">
													<!--<button class="btn btn-prev myPrev border">
						                                <i class="ace-icon fa fa-arrow-left" disable></i>
						                                Prev
						                            </button> -->

						                            <button type="button" class="btn btn-success float-end" id="nextBtn" style="display: none;">
						                                Next
						                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
						                            </button>
						                            <!-- <button class="nav-link btn btn-success nextBtn" id="nav-personal-info-tab" data-bs-toggle="tab" data-bs-target="#nav-personal-info" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="display: none">Next</button> -->
						                        </div>
					                    	</div>
					                    	<span class="invalid-feedback" id="" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;Note: To Submit Your Application, Please fill out the form appropriately</b></span>
										</div>
								<!-- </div> -->
							    <!-- Field: Applicant Is Father Alive:End -->
							</div>

							<div class="tab-pane fade" id="nav-personal-info" role="tabpanel" aria-labelledby="nav-personal-info-tab">
							    <div class="row  mt-3">
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
									  	</div>
									<!-- Field: Applicant CNIC:End -->

									<!-- Field: Applicant CNIC Picture:Start -->
									  	<label class="form-label col-sm-12"><b>Scanned image of National ID Card No</b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_cnic_picture" class="form-control <?php echo isset($_SESSION['error']['applicant_cnic_picture'])?'is-invalid':'';  ?>">
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
										  	<div class="invalid-feedback" id="error-applicant-picture">
										      <?php echo $_SESSION['error']['applicant_picture']??''; ?>
										    </div>
										  </div>
									<!-- Field: Applicant Picture:End -->
									<!-- Field: Applicant Student ID Card Image:Start -->
									  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card <span class="text-danger">*</span></b></label>
										  <div class="col-md-12 my-auto">
										  	<input type="file" name="applicant_student_id_card_image" class="form-control <?php echo isset($_SESSION['error']['applicant_student_id_card_image'])?'is-invalid':'';  ?>">
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

									<!-- Field: Applicant Is Father Alive:Start -->
										<!-- <label class="form-label col-sm-12"><b>Is Father Alive? <span class="text-danger">*</span></b></label>
										<div class="col-sm-6 my-auto">
									  	<div class="input-group has-validation">
									  		<div class="form-check">
											  	<input class="form-check-input" type="radio" name="is_father_alive" value="Yes" <?php //echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "Yes")?'checked':'';?>>
											  	<label class="form-check-label">
											    	Yes
											  	</label>
												</div>
											</div>
										</div>
									  
									  	<div class="col-sm-6 my-auto">
									    	<div class="form-check">
										  		<input class="form-check-input" type="radio" name="is_father_alive" value="No" <?php //echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'checked':'';?>>
											  	<label class="form-check-label">
											    	No
											  	</label>
												</div>
									  	</div>
									  	<div  class="invalid-feedback col-sm-12" id="error-father-alive" style="display:<?php //echo isset($_SESSION['error']['is_father_alive'])?'block':'none';  ?>">
									      	<?php //echo $_SESSION['error']['is_father_alive']??''; ?>
									   	</div> -->
									<!-- Field: Applicant Is Father Alive:End -->

									<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):Start -->
								  		<!-- <div id="death-certificate-box" style="display:<?php //echo (isset($_SESSION['data']['is_father_alive']) && $_SESSION['data']['is_father_alive'] == "No")?'block':'none';?>;">
								  			<label class="form-label col-sm-12"><b>Scanned image of the applicant's father's death certificate issued by the authorised department</b></label>
									  		<div class="col-md-12 my-auto">
									  			<input type="file" name="applicant_father_death_certificate" class="form-control <?php //echo isset($_SESSION['error']['death_certificate'])?'is-invalid':'';  ?>">
									  				<div  class="invalid-feedback col-sm-12" id="error-father-death-certificate">
									      			<?php //echo $_SESSION['error']['death_certificate']??''; ?> 
									   				</div>
									  		</div>
									  	</div> -->
								  	<!-- Field 1: Applicant Father Death Certificate Image (If Father Alive No):End -->

								  	<!-- Field: Applicant Father CNIC:Start -->
									  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['error']['father_cnic'])?'is-invalid':'';  ?>" name="father_cnic" value="<?php echo $_SESSION['data']['father_cnic']??''; ?>" placeholder="Father National ID Card No">
										    <div class="invalid-feedback" id="error-father-cnic">
										      <?php echo $_SESSION['error']['father_cnic']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Father CNIC:End -->

									<!-- Field: Applicant Father Name:Start -->
									  	<label class="form-label col-sm-12"><b> Father Name <span class="text-danger">*</span></b></label>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_first_name'])?'is-invalid':'bottom-margin';  ?>" name="father_first_name" value="<?php echo $_SESSION['data']['father_first_name']??''; ?>" placeholder="First Name">
										    <div class="invalid-feedback" id="error-father-first-name">
										      <?php echo $_SESSION['error']['father_first_name']??''; ?>
										    </div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_middle_name'])?'is-invalid':'bottom-margin';  ?>" name="father_middle_name" value="<?php echo $_SESSION['data']['father_middle_name']??''; ?>"  placeholder="Middle Name">
									    	<div class="invalid-feedback" id="error-father-middle-name">
									      	<?php echo $_SESSION['error']['father_middle_name']??''; ?>
									    	</div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_last_name'])?'is-invalid':'bottom-margin';  ?>" name="father_last_name" value="<?php echo $_SESSION['data']['father_last_name']??''; ?>"  placeholder="Last Name">
									    	<div class="invalid-feedback" id="error-father-last-name">
									      	<?php echo $_SESSION['error']['father_last_name']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Father Name:End -->

									<!-- Field: Applicant Father Occupation:Start -->
									  		<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['error']['father_occupation'])?'is-invalid':'';  ?>" name="father_occupation" value="<?php echo $_SESSION['data']['father_occupation']??''; ?>">
										    	<div class="invalid-feedback" id="error-father-occupation">
										      	<?php echo $_SESSION['error']['father_occupation']??''; ?>
										    	</div>
									  		</div>
									<!-- Field: Applicant Father Occupation:End -->

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
									  		<label class="form-label col-sm-12"><b>Details of yearly expenses (in rupees) towards education</b></label>
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



									<!-- MOU:Start -->
										  	<div class="col-md-12 mt-5">
										  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
										  	<ol>
													<li class="text-black">Applicant should be an orphan, father died in childhood.</li>
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

										  	<div class="col-md-12 ms-4 mb-5 mt-4">
										    <button class="btn btn-primary" type="submit" name="submit">Submit</button><span class="invalid-feedback" id="error-appropriate" style="display:<?php echo (isset($_SESSION['error']['appropriate']))?'inline;':'none';?>;"><b>&nbsp;&nbsp;To Submit Your Application, Please fill out the form appropriately</b></span>
										    <!-- <input type="submit" class="btn btn-primary" name="submit" value="Submit"> -->
									  		</div>
								</div>
							</div>
						</form>
					</div>
				<!-- </div> -->
		<!-- </div> -->
			<?php
		}

		public function update_beneficiary_form($beneficiary_record,$beneficiary_degree_attachment,$beneficiary_id)
		{
			extract($beneficiary_record);
			?>

			<div class="container">
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
					    <button class="nav-link active" id="nav-father-alive-update-tab" data-bs-toggle="tab" data-bs-target="#nav-father-alive-update" type="button" role="tab" aria-controls="nav-father" aria-selected="true">Father Alive</button>

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
							                        
											    <a class="<?php echo isset($father_death_certificate_image)?'elem2':'' ?>" 
			                                        <?php echo isset($father_death_certificate_image)?"href=$father_death_certificate_image":''; ?>
			                                        title="Document : Applicant Father`s Death Certificate Scanned Image" 
			                                        data-lcl-txt="<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> " 
			                                        style="text-decoration: none;">
			                                        <img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class="rounded shadow" alt="No Image" width="300px" height="250px" /> 
			                                    </a>
	                                    	</div>
				                    	</div>

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
										  <a class="<?php echo isset($applicant_cnic_image)?'elem3':'' ?>" 
                                                <?php echo isset($applicant_cnic_image)?"href=$applicant_cnic_image":''; ?>
                                                title="Document : Applicant National ID Card Scanned Image" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                              <img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" />
                                            </a>
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
											    <a class="elem3" 
	                                                href="<?php echo $applicant_picture; ?>"
	                                                title="Image : Applicant Profile Picture" 
	                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
	                                                style="text-decoration: none;">
	                                                <img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5 light-box shadow" onerror="this.src='../assets/user_default.png'" alt="No Image" width="150px" height="150px" />
	                                            </a>
										    </div>
                                        	</div>
										  <!-- </div> -->
									<!-- Field: Applicant Picture:End -->

									<!-- Field: Applicant Student ID Card Image:Start -->
									  	<label class="form-label col-sm-12"><b> Scanned image of Student ID Card/Enrollment Card </b></label>
										  <div class="col-md-6 my-auto">
										  	<a class="<?php echo isset($applicant_student_id_card_image)?'elem3':''; ?>" 
                                                <?php echo isset($applicant_student_id_card_image)?"href=$applicant_student_id_card_image":''; ?>
                                                title="Document : Applicant Student ID Card Scanned Image" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded shadow" width="150px" height="150px" /> 
                                            </a>
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
										    ?>
													 	<a class="<?php echo  isset($academic_degree_attachment)?'elem3':''?>" 
			                                                href="<?php echo $academic_degree_attachment??"#"; ?>"
			                                                title="Document : Applicant Degree Attachment Scanned Image" 
			                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
			                                                style="text-decoration: none;">

			                                               <img src="<?php echo $academic_degree_attachment;  ?>" class="rounded shadow " alt="No Image" width="150px" height="150px" onerror="this.src='../assets/default.jpg'" /> 
			                                            </a>
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

								  	<!-- Field: Applicant Father CNIC:Start -->
									  	<label class="form-label col-sm-12"><b> Father National ID Card No <span class="text-danger">*&nbsp;</span></b><span class="text-secondary">(eg: 4130312345671)</span></label>
									  	<div class="col-md-12 my-auto">
									    	<input type="number" class="form-control <?php echo isset($_SESSION['update-error']['father_cnic'])?'is-invalid':'';  ?>" name="father_cnic" value="<?php echo $_SESSION['update-data']['father_cnic']??$father_cnic; ?>" placeholder="Father National ID Card No">
										    <div class="invalid-feedback" id="error-father-cnic">
										      <?php echo $_SESSION['update-error']['father_cnic']??''; ?>
										    </div>
									  	</div>
									<!-- Field: Applicant Father CNIC:End -->


									<!-- Field: Applicant Father Name:Start -->
									  	<label class="form-label col-sm-12"><b> Father Name <span class="text-danger">*</span></b></label>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_first_name'])?'is-invalid':'bottom-margin';  ?>" name="father_first_name" value="<?php echo $_SESSION['update-data']['father_first_name']??$father_first_name; ?>" placeholder="First Name">
										    <div class="invalid-feedback" id="error-father-first-name">
										      <?php echo $_SESSION['update-error']['father_first_name']??''; ?>
										    </div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_middle_name'])?'is-invalid':'bottom-margin';  ?>" name="father_middle_name" value="<?php echo $_SESSION['update-data']['father_middle_name']??$father_middle_name;?>"  placeholder="Middle Name">
									    	<div class="invalid-feedback" id="error-father-middle-name">
									      	<?php echo $_SESSION['update-error']['father_middle_name']??''; ?>
									    	</div>
									  	</div>
									  	<div class="col-md-4 my-auto">
									    	<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_last_name'])?'is-invalid':'bottom-margin';  ?>" name="father_last_name" value="<?php echo $_SESSION['update-data']['father_last_name']??$father_last_name; ?>"  placeholder="Last Name">
									    	<div class="invalid-feedback" id="error-father-last-name">
									      	<?php echo $_SESSION['update-error']['father_last_name']??''; ?>
									    	</div>
									  	</div>
									<!-- Field: Applicant Father Name:End -->

									<!-- Field: Applicant Father Occupation:Start -->
									  		<label class="form-label col-sm-12"><b>Father Occupation <span class="text-danger">*</span></b></label>
									  		<div class="col-md-12 my-auto">
									    		<input type="text" class="form-control <?php echo isset($_SESSION['update-error']['father_occupation'])?'is-invalid':'';  ?>" name="father_occupation" value="<?php echo $_SESSION['update-data']['father_occupation']??$father_occupation; ?>">
										    	<div class="invalid-feedback" id="error-father-occupation">
										      	<?php echo $_SESSION['update-error']['father_occupation']??''; ?>
										    	</div>
									  		</div>
									<!-- Field: Applicant Father Occupation:End -->

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

									  		<label class="form-label col-sm-12"><b>Details of yearly expenses (in rupees) towards education</b></label>
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
												    <a class="<?php echo  isset($financial_help_image)?'elem3':''?>" 
		                                               <?php echo isset($financial_help_image)?"href=$financial_help_image":''; ?>
		                                                title="Document : Applicant Financial Help Notification Scanned Image" 
		                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
		                                                style="text-decoration: none;">

		                                              <img src="<?php echo $financial_help_image;  ?>" class="rounded shadow" onerror="this.src='../assets/default.jpg'" alt="No Image" width="150px" height="150px" />
		                                            </a>
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



									<!-- MOU:Start -->
										  	<div class="col-md-12 mt-5">
											  	<h3 class="text-success fw-bolder ms-4">Memorandum of Understanding (MOU)</h3>
											  	<ol>
													<li class="text-black">Applicant should be an orphan, father died in childhood.</li>
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
	}
?>