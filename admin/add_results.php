<?php
	require_once '../controllers/functions.php';
	require_once '../controllers/connection.php';

	$regno;
	if (isset($_POST['add_result'])) {
		$regno = $_POST['student_regno'];
		$sem_id = $_POST['semester'];
		$cunit = $_POST['cunit'];
		$test = $_POST['test'];
		$exam = $_POST['exam'];
		$gpa = $_POST['gpa'];
		$res_table = $_SESSION['result_table'];

		if ($regno == "--select--") {
			echo '<div class="alert alert-danger alert-dismissable">    <button type="button" class="close" data-dismiss="alert"        aria-hidden="true">       &times;    </button>    No registration number selected. </div>';
		}

		if ($sem_id == "--select--") {
			echo '<div class="alert alert-danger alert-dismissable">    <button type="button" class="close" data-dismiss="alert"        aria-hidden="true">       &times;    </button>    No semester selected. </div>';
		}

		if ($cunit == "--select--") {
			echo '<div class="alert alert-danger alert-dismissable">    <button type="button" class="close" data-dismiss="alert"        aria-hidden="true">       &times;    </button>    No course unit selected. </div> ';
		}

		// Check if student's results are available in db
		$checkSQL = "SELECT * FROM $res_table WHERE regno= '$regno' AND cu_name= '$cunit' AND semester = '$sem_id'";
		$response = $conn -> query($checkSQL);
		if (mysqli_num_rows($response) > 0) {
			echo '<div class="alert alert-info alert-dismissable">    <button type="button" class="close" data-dismiss="alert"        aria-hidden="true">       &times;    </button>    <b>'.$regno.'</b> results for semester <b>'.$sem_id.'</b> are available. </div> ';
		}else{
			if ($regno != "--select--" && $sem_id != "--select--" && $cunit != "--select--") {
				$sql = "INSERT INTO `$res_table`(`regno`, `cu_name`, `semester`, `test_marks`, `exam_marks`, `gpa`) VALUES ('$regno','$cunit', '$sem_id','$test','$exam','$gpa')";

				$result = $conn -> query($sql);
				if ($result) {
					echo '<div class="alert alert-success alert-dismissable">    <button type="button" class="close" data-dismiss="alert"        aria-hidden="true">       &times;    </button>    Success! Well done its submitted. </div> ';
				}

				
			}
		}

	}
  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		input[type="text"]{
			padding-left: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mx-auto">
					<div class="card-header">
						<h3>Enter Student's Results</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="">
							<div class="form-group">
								<label>Reg. Number</label>
								<select name="student_regno" id="regno" required="required" class="form-control">
									<option selected="selected">--select--</option>
									<?php studentsOption($conn) ?>
								</select>
							</div>
							<div class="form-group" id="sem_id">
								<label>Semester</label>
								<select name="semester" id="semester" required="required" class="form-control">
									<option selected="selected">--select--</option>
									<!-- <?php semesterOption($conn) ?> -->
								</select>
							</div>
							<div class="form-group" id="crs_unit">
								<label>Course Unit</label>
								<select name="cunit" required="required" class="form-control">
									<option selected="selected">--select--</option>
									<!-- <?php intakeOption($conn) ?> -->
								</select>
							</div>
							<div class="form-group">
								<label>Test Marks</label>
								<input type="text" name="test" required="required" id="test" onblur="calculator(this)" onkeyup="calculator(this)" class="form-control">
								<span id="error_test" style="visibility: hidden;" class="alert alert-danger">/40</span>
							</div>
							<div class="form-group">
								<label>Exam Marks</label>
								<input type="text" name="exam" required="required" id="exam" onblur="sumExamMarks(this)" onkeyup="sumExamMarks(this)" class="form-control">
								<span id="error_exam" style="visibility: hidden;" class="alert alert-danger">/60</span>
							</div>
							<div class="form-group">
								<!-- <label>Number CUs</label> -->
								<input type="hidden" name="crslength" 
								value="<?php if(isset($_SESSION['course_length'])){echo($_SESSION['course_length']);} ?>" required="required" id="course_length" class="form-control">
							</div>
							<div class="form-group">
								<label>Total Mark</label>
								<input type="text" name="tot_mark" required="required" id="tot_mark" readonly="" class="form-control">
							</div>
							<div class="form-group">
								<label>GPA</label>
								<input type="text" name="gpa" required="required" id="gpa" readonly="" class="form-control">
							</div>
							<div class="form-group">
								<input type="submit" name="add_result" value="Add Result" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		 	$('#regno').on('change', function(e){
		 		var optionSelected = $("optionSelected",this);
		 		var valueSelected = this.value;
		 		// setInterval(function(){
			 		$.ajax({
		                data:    {value: valueSelected},
		                url:     'request.php',
		                type:    'post',
		                success: function(res) {
		                	$('#sem_id').html(res);
		                	console.log("success result is"+res)},
		                error:   function(res) {console.log("error in result"+res)}
		            });
			 	// },2000);
		 	});

		 	// When semester is selected
		 	$("#semester").on('change', function (e) {
		 		var optionSelected = $("optionSelected",this);
		 		var semValue = this.value;
		 		$.ajax({
		 			data: {semesterID : semValue},
		 			url: 'request.php',
		 			type: 'POST',
		 			success: function(res) {
		                	$('#crs_unit').html(res);
		                	console.log("success result is"+res)},
		                error:   function(res) {console.log("error in result"+res)}
		 		});
		 	});
		 });
	</script>
	<script type="text/javascript">
		function calculator(input) {
			 var testMarks = input.value;
			if (testMarks <= 40) {
				// document.getElementById('gpa').value = testMarks * 2;
				document.getElementById('error_test').style.visibility = 'hidden';
			}else{
				document.getElementById('test').value = "0.0"; //set value to 0
				document.getElementById('error_test').style.visibility = 'visible';
				return false;
			}
		}

		function sumExamMarks(input) {
			var exam_marks = input.value;
			var test = document.getElementById('test').value;
			var tot = exam_marks + '+'+ test;

			if (exam_marks <= 60) {
				document.getElementById('tot_mark').value = eval(tot);
				document.getElementById('error_exam').style.visibility = 'hidden';

				var total = document.getElementById('tot_mark').value;

				// // Calculate gpa
				if (total >= 80 && total <= 100 ) {
					 document.getElementById('gpa').value = "5.0";
				}
				else if (total >= 75 && total < 80) {
				 document.getElementById('gpa').value = "4.5";
				}
				else if (total >= 70 && total < 75 ) {
					 document.getElementById('gpa').value = "4.0";
				}
				else if (total >= 65 && total < 70) {
				 document.getElementById('gpa').value = "3.5";
				}
				else if (total >= 60 && total < 65 ) {
					 document.getElementById('gpa').value = "3.0";
				}
				else if (total >= 55 && total < 60) {
				 document.getElementById('gpa').value = "2.5";
				}
				else if (total >= 50 && total < 55 ) {
					 document.getElementById('gpa').value = "2.0";
				}
				else if (total < 50) {
				 document.getElementById('gpa').value = "0.0";
				}
			}else{
				document.getElementById('exam').value = "0.0";
				document.getElementById('error_exam').style.visibility = 'visible';
				return false;
			}

		}

	</script>
</body>
</html>