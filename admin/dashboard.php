<?php 
	require_once '../controllers/connection.php';
	require_once 'session_checker.php';
	require_once '../controllers/functions.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

       <title>IUEA Admin Dashboard</title>

        <!-- Bootstrap CSS CDN -->
       <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">
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
                	<p><?php echo ($_SESSION['admin_name']); ?></p>
					<div class="table-responsive">
						<table class="table" >
							<tbody>
								<tr>
									<td>
									<?php echo '
									<form method="POST" action="">
										<input type="submit" name="edit_profile" value="Edit profile" class="btn btn-info"><br><br>
									</form>
									'; ?>							
									</td>
									<td>
										<?php echo '
										<form method="POST" action="logout.php">
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
                	 <li class="active"><a href="dashboard.php?query=home">Home <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
                       <li><a href="dashboard.php?query=offering">Add Course <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="dashboard.php?query=registration">Register Students <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
                        <li><a href="dashboard.php?query=upgrade">Upgrade Students <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="dashboard.php?query=statement">Fees Statement <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
						<li><a href="dashboard.php?query=transcript">Enter Results <i class="glyphicon glyphicon-chevron-right"></i></a> </li>
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

                <?php 
                	if (isset($_GET['query'])) {
                		$query = $_GET['query'];

                		switch ($query) {
                			case 'home':
                				include 'home.php';
                				break;
                			case 'offering':
                				include 'add_course.php';
                				break;
                			case 'registration':
                				include 'register_students.php';
                				break;
                            case 'upgrade':
                                include 'upgrade_students.php';
                                break;
                			case 'statement':
                				include 'add_fees_statement.php';
                				break;
                			case 'transcript':
                				include 'add_results.php';
                				break;
                			
                			default:
                				# code...
                				break;
                		}
                	}
                	else{
                		 include 'home.php'; 
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
