<?php
	class General
	{
		public static function site_title()
		{
			return "Support Poor Student";
		}

		public static function site_header()
		{
			?>
				<!doctype html>
				<html lang="en">
				  <head>
				    <meta charset="utf-8">
				    <meta name="viewport" content="width=device-width, initial-scale=1">
				    <title><?php echo self::site_title(); ?></title>
				    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
				    <link rel="stylesheet" href="../assets/css/datepicker.css">
				    <link rel="stylesheet" href="../assets/css/widget_Tab.css">
				  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
				  	<link rel="stylesheet" href="../assets/plugin/LC-Lightbox-Image/css/lc_lightbox.css">

				  	<style type="text/css">
				  		.form-label{
				  			margin-top: 1.5rem !important; 
				  		}
				  		.bottom-margin{
				  			margin-bottom:20px 
				  		}

				  		/* Ensure that the demo table scrolls */
			  		    th, td { white-space: nowrap; }
			  		    div.dataTables_wrapper {
			  		        width: 100%;
			  		        margin: 0 auto;
			  		    }
			  		    table.dataTable thead tr th {
			  		        background-color: #438EB9;
			  		        color: white;
			  		        font-size: 15px;
			  		        text-align: center;
			  		        /*border: 1px solid white;*/
			  		        border-left: 1px solid white;
			  		        border-right: 1px solid white;
			  		    }
			  		    table.dataTable tbody tr td{
			  		        border: 1px solid #ccddff;
			  		        border-left: 1px solid #ddd;
			  		        border-right: 1px solid #ddd;
			  		        vertical-align: center;
			  		    }
			  		    #beneficiary-table_paginate{
			  		    	margin-top: 10px;
			  		    }
			  		    .dataTables_wrapper .dataTables_filter {
			  		      float: right;
			  		    }
			  		    /*.dataTables_wrapper .dataTables_filter input {
			  		      background-color: transparent;
			  		      color: inherit;
			  		    }*/

				  		/*add media queries code in site_header():Start*/

				  			/* Extra small devices (phones, 600px and down) */
			  				@media only screen and (max-width: 600px) {
			  				  .media {/*background: red;*/}
			  				  .logo{margin-left: -2rem;}
			  				  .space{margin-left:6rem; }
			  				  .gap{margin-left: -10rem}
			  				  .coustom-border{margin-top:2rem;  border:1px solid #c3b8b8; }
			  				}

			  				/* Small devices (portrait tablets and large phones, 600px and up) */
			  				@media only screen and (min-width: 600px) {
			  				  .media {/*background: green;*/ font-size:22px;margin-top: 10px;}
			  				}

			  				/* Medium devices (landscape tablets, 768px and up) */
			  				@media only screen and (min-width: 768px) {
			  				  .media {/*background: blue;*/ font-size:24px;}
			  				  .coustom-border{margin-top:2rem; margin-left:4rem;
			  				   border:1px solid #c3b8b8; width:80%;}
			  				   .clear-search-btn{
			  				   	margin:-5px;
			  				   }
			  				} 

			  				/* Large devices (laptops/desktops, 992px and up) */
			  				@media only screen and (min-width: 992px) {
			  				  .media {/*background: orange;*/}
			  				} 

			  				/* Extra large devices (large laptops and desktops, 1200px and up) */
			  				@media only screen and (min-width: 1200px) {
			  				  .media {/*background: pink;*/ font-size:40px; margin-top: 1rem;}
			  				  .logo{margin-left: 3rem;}
			  				  .gap{margin-left: 5rem;}
			  				  .coustom-border{margin-left:17%; border:1px solid #c3b8b8; width:66%;}
			  				}

				  		/*add media queries code in site_header():End*/
    				</style>

				  </head>
				  <body>
			<?php
		}

		public static function site_logo()
		{
			$href = (isset($_SESSION["user"]))?"index.php":"../user/index.php"; 
			?>
				<!-- Header Container:Start -->
				        <div class="container-fluid border-dark border-bottom">
				        	<div class="row">
				        		<div class="col-sm-12 text-center">
				        			<div id="et-secondary-menu" class="pt-2">
				    					<ul id="et-secondary-nav" class="menu" style="list-style:none;"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10196 chimmc-menu-item_10196 sec_menu_item"><a href="#"><img src="../assets/Hidaya-Bismillah-pnh.png" style="width:240px;height:30px;" class="alignnone"></a></li>
				    					</ul>	
				    				</div>		
				        		</div>
				        	</div>
				        </div>
			    <!-- Header Container:End -->

			    <!-- Logo Container:Start -->
				        <div class="container-fluid" style="background-color:#2c4e23;">
				        	<div class="row">
				        		<div class="col-sm-3">
				        			<div id="et-secondary-menu" class="logo">
				    					<ul id="et-secondary-nav" class="menu" style="list-style:none;"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10196 chimmc-menu-item_10196 sec_menu_item"><a href="<?php echo $href; ?>"><img src="../assets/logo.png" style="max-width: 100%; height:auto !important;" class="alignnone pt-2 img-fluid"></a></li>
				    					</ul>	
				    				</div>
				        		</div>
				        		<div class="col-sm-9">
				        			<h1 class="entry-title main_title text-light text-success media">Spread Education - Support Poor Students (Monthly)</h1>
				        		</div>
				        	</div>
				        </div>
			    <!-- Logo Container:End -->

			<?php
		}

		public static function admin_navbar(){
			?>
			<nav class="navbar navbar-expand-lg bg-primar border-bottom border-dark mt-3">
			  <div class="container-fluid text-light">
			    <div class="navbar-brand text-light"><h3 class="text-danger">Welcome: <a href="index.php"><b class="text-success"><?php echo ucwords($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']); ?></b></a> </h3></div>
			    <ul class="nav navbar-nav navbar-right">
			    	<li class="align-content:center">
			        	<a class="btn btn-danger text-light" href="logout.php" >Logout</a>
			    	</li>
			    </ul>
			  </div>
			</nav>
			<?php
		}

		public static function site_footer()
		{
			?>
				<script src="../assets/js/jquery-3.7.0.min.js"></script>
				<script src="../assets/js/bootstrap-datepicker.js"></script>
    			<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    			<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
    			<script type="text/javascript" src="../assets/js/dataTables.fixedColumns.min.js"></script>

    			<script type="text/javascript" src="../assets/js/dataTables.bootstrap5.min.js"></script>

    			<!-- Validation File JS -->
			    <script type="text/javascript" src="../assets/js/validation.js"></script>
			    <!-- LightBox Image - jQuery Plugin -->
    			<script type="text/javascript" src="../assets/plugin/LC-Lightbox-Image/js/lc_lightbox.lite.js"></script>

			    <!--Datepicker Js Code Start  -->

			    <script type="text/javascript">
			     $(document).ready(function() { 

			            $('#txtDate').datepicker({
			               dateFormat :"MM yy",
			               autoclose  : true,
			               viewMode   : "months", 
			               minViewMode: "months",
			            })

			            $("#txtDate").focus(function () {
			               $(".ui-datepicker-calendar").hide();
			               $("#ui-datepicker-div").position({
			                   my: "center top",
			                   at: "center bottom",
			                   of: $(this)
			               });
			            });

			      });
			    </script>


			    <!--Datepicker Js Code End  -->

			    </body>
			</html>
			<?php
		}

	}
?>