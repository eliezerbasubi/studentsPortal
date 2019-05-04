<?php 
	require_once '../controllers/connection.php';
	require_once '../controllers/session_checker.php';
	require_once '../controllers/functions.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

       <title>IUEA Student Portal</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <!-- <link rel="stylesheet" href="style2.css"> -->
        <link rel="stylesheet" type="text/css" href="../css/main_style.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="../images/3.jpg" class="profile-picture">
                </div>

                <div class="user-details">
                	<p><?php echo ($_SESSION['fname']." ".$_SESSION['midname']); ?></p>
					<p><?php echo ($_SESSION['regno']); ?></p>
					<p>Current term : <?php getIntake($conn) ?></p><br>
					<div class="table-responsive">
						<table class="table" >
							<tbody>
								<tr>
									<td>
									<?php echo '
									<form method="POST" action="">
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" name="edit_profile">Edit profile</button>
									</form>
									'; ?>							
									</td>
									<td>
										<?php echo '
										<form method="POST" action="../controllers/logout.php">
											<input type="submit" name="logout" value="Logout" class="btn btn-danger"><br>
										</form>
										'; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                </div>

                <ul class="list-unstyled components">
                       <li><a href="homepage.php?query=offering">Course Offering <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li class="active"><a href="homepage.php?query=registration">Online Registration <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="homepage.php?query=statement">My Fees statement <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="homepage.php?query=transcript">My Transcript <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="homepage.php?query=courses">My Courses <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
               </ul>

                
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <!-- <span>Toggle Sidebar</span> -->
                            </button>

                            <img src="../images/lo1.png" class="logo-picture" height="70">

                            <!-- <div class="sideright_bar" style="float: right; ">
                            	<h4>Student Portal</h4>
                            	<p><?php echo(Date('d-m-Y')) ?></p>
                            </div> -->
                        </div>

                        <!-- <?php include 'header_pages.php'; ?> -->


                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                	<h4>Student Portal</h4>
	                            	<p><?php echo(Date('d-m-Y')) ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Edit your profile</h4>
				      </div>
				      <div class="modal-body">
				        <div class="column">
				        	<form method="POST" action="">
					        	<div class="form-group">
					        		<label>Old password</label>
					        		<input type="password" name="old_pwd" class="form-control" placeholder="Enter old password">
					        	</div>

					        	<div class="form-group">
					        		<label>New password</label>
					        		<input type="password" name="new_pwd" class="form-control" placeholder="Enter new password">
					        	</div>

					        	<div class="form-group">
					        		<label>Confirm password</label>
					        		<input type="password" name="confirm_pwd" class="form-control" placeholder="Confirm your password">
					        	</div>

					        	<div class="form-group">
					        		<input type="submit" name="btn_pwd" value="Change password" class="btn btn-success">
					        	</div>
					        </form>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div> 
                <?php 
                	if (isset($_GET['query'])) {
                		$query = $_GET['query'];

                		switch ($query) {
                			case 'offering':
                				include 'course_offering.php';
                				break;
                			case 'registration':
                				include 'registration.php';
                				break;
                			case 'courses':
                				include 'mycourses.php';
                				break;
                			case 'transcript':
                				include 'transcript.php';
                				break;
                			
                			default:
                				# code...
                				break;
                		}
                	}
                	else{
                		 include 'registration.php'; 
                	}
                 ?>
        </div>


        





        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- jQuery offline mode -->
        <script type="text/javascript" src="../js/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
              
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });

   //          $('ul > li > a').on('click',function() {
			//     $('ul > li').removeClass("active");
			//     $(this).parent().addClass("active");
			// });

			$(document).ready(function () {
				// $('.components > li > a').on('click', function () {
				// 	$('.components > li').removeClass("active");
				// 	$(this).parent().addClass("active");
				// 	// alert("working in progress");
				// });
				 var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
			     $('.components li a').each(function() {
			      if (this.href === path) {
			      	$('.components li').removeClass("active");
			       $(this).parent().addClass('active');
			      }
			     });
			});
        </script>
    </body>
</html>
