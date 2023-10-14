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

				  		    .entry-title{
				  		    	color: #ffff !important;
				  		    	margin-top: 1rem;
				  		    }
				  	</style>


				  </head>
				  <body>
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

    			<!-- LightBox Image - jQuery Plugin -->
    			<script type="text/javascript" src="../assets/plugin/LC-Lightbox-Image/js/lc_lightbox.lite.js"></script>
    			<!-- Validation File JS -->
			    <script type="text/javascript" src="../assets/js/validation.js"></script>

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