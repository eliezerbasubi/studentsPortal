<?php 
	require_once '../controllers/connection.php';
	require_once '../controllers/functions.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/stylesheet.css"> -->

	<style type="text/css">
		.form-control{
			border-width: 0px 0px 1px 0px; 
		}

		.btn-success{
			width: 250px;
			background-color: maroon;
			color: white;
			border-color: maroon;
		}
	</style>
</head>
<body>
	<div class="row">
		<h3>Registration Form</h3>
    	<?php echo '<form class="form-group" method="POST" action="'.registerStudents($conn).'">
    		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    			<div class="semester-container">
    				<h4>Choose Semester</h4>
    				<!-- <form method="POST" action=""> -->
    					<select name="semesterID" class="form-control" onchange="myFunction(this)">
    						<option selected="selected">--select--</option>'?>
	    					<?php retrieveSemesters($conn) ?>
	    			<?php	echo '</select>
    				<!-- </form> -->
    				<!-- Your option: <span id="myfunction">You haven\'t selected an option yet</span> -->
    			</div>

				<h4>Course Offering Type</h4>
	    		<input type="radio" name="type" value="day" id="day"> <label for="day">Day</label> <br><br>
	    		<input type="radio" name="type" value="evening" id="evening"><label for="evening">Evening</label></div>

	    	<div class="table-responsive" id="course_units">          
			  <table class="table">
			    <thead>
			      <tr>
			        <th>Course Code</th>
			        <th>Course Name / Subjects</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			      	<td><center>No semester selected yet</center></td>
			      </tr>
			    </tbody>
			  </table>
		  </div>
    	</form>'?>
    </div>

    		<!-- jQuery offline mode -->
        <script type="text/javascript" src="../js/jquery.min.js"></script>
	    	<script type="text/javascript">
				// function myFunction(event) {
				//     var output = event.value;
				//     document.getElementById("myfunction").innerHTML = output;
				// }
				 $(document).ready(function(){
				 	$('select').on('change', function(e){
				 		var optionSelected = $("optionSelected",this);
				 		var valueSelected = this.value;
				 		// setInterval(function(){
					 		$.ajax({
				                data:    {value: valueSelected},
				                url:     'request_ajax.php',
				                type:    'post',
				                success: function(res) {
				                	$('#course_units').html(res);
				                	console.log("success result is"+res)},
				                error:   function(res) {console.log("error in result"+res)}
				            });
					 	// },2000);
				 	});
				 });

				 $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
				    $(".alert-danger").slideUp(500);
				});
			</script>
    
</body>
</html>