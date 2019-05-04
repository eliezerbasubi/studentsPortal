<?php 
require_once '../controllers/connection.php';
session_start();

	if (isset($_POST['value']) ) {
		$regno = $_POST['value'];
		$sql = "SELECT * FROM students WHERE `stud_regno` = '$regno'";

		$result = $conn -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			echo '<div class="form-group" id="sem_id">
				<label>Semester</label>
				<select name="semester" id="semester" class="form-control">
					<option selected="selected">--select--</option>'; 

			while ($row = $result -> fetch_assoc()) {
				$_SESSION['depart_id'] = $row['stud_depart'];

				for ($i=1; $i <= $row['stud_semester'] ; $i++) { 
					echo '<option>'.$i.'</option>';
				}
			}

			echo "</select>
			</div>";

		}
	}

	// Save department id to allow us to determine student table where courses will be loaded
		$dp_table;
		if (isset($_SESSION['depart_id'])) {
			$dpID = $_SESSION['depart_id'];
			$departSQL = "SELECT * FROM departments WHERE `departId` = '$dpID' ";

			$response = $conn -> query($departSQL);
			if (mysqli_num_rows($response) > 0) {
				while ($row = $response -> fetch_assoc()) {
					// echo $row['depart_table'];
					$dp_table = $row['depart_table'];
					$_SESSION['dep_table'] = $dp_table;
					$_SESSION['result_table'] = $row['result_table'];
				}
			}
		}

	
	// Course unit 
	if (isset($_POST['semesterID'])) {
		$sem_id = $_POST['semesterID'];
		$course_table = $_SESSION['dep_table'];

		$sql = "SELECT * FROM $course_table WHERE `bit_sem` = '$sem_id'";

		$result = $conn -> query($sql);

		//Create a sessin to store the length of course units
		$_SESSION['course_length'] = mysqli_num_rows($result);
		if (mysqli_num_rows($result) > 0) {
			echo '<div class="form-group" id="crs_unit">
				<label>Course Unit</label>
				<select name="cunit" id="crs_id">
					<option selected="selected">--select--</option>';

			while ($row = $result -> fetch_assoc()) {
				// for ($i=1; $i <= $row['course_name'] ; $i++) { 
					echo '<option>'.$row['courseUnit'].'</option>';
				// }
			}

			echo "</select>
			</div>";
		}

	}
 ?>

 <script type="text/javascript" src="../js/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
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