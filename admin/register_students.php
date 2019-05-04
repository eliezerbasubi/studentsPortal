<?php
	require_once '../controllers/functions.php';
	require_once '../controllers/connection.php';

	if (isset($_POST['add'])) {
		$regno = $_POST['regnumber'];
		$fname = $_POST['firstname'];
		$midname = $_POST['middlename'];
		$lname = $_POST['lastname'];
		$password = $_POST['password'];
		$intake = $_POST['intake'];
		$yearOfStudy = $_POST['yearOfStudy'];
		$semester = $_POST['semester'];
		$fac = $_POST['faculty'];
		$depart = $_POST['department'];

		$facId; $dpID;$inkID;

		// Encrypt password using md5,sha1 and crypt
		$password = md5($password);
		$pwd_sha = sha1($password);
		$crypted = crypt($pwd_sha,"password");
		echo $crypted;

		// // ******** Fetch faculty id *******//
		// $facSQL = "SELECT * FROM faculty WHERE facName = '$fac'";

		// $resultFac = $conn -> query($facSQL);

		// if (mysqli_num_rows($resultFac) > 0) {
		// 	while ($row = $resultFac -> fetch_assoc()) {
		// 		$facId = $row['facId'];
		// 	}
		// }

		// // ******* Fetch department id *******//

		// $dSQL = "SELECT * FROM departments WHERE departName = '$depart'";

		// $resultDep = $conn -> query($dSQL);

		// if (mysqli_num_rows($resultDep) > 0) {
		// 	while ($row = $resultDep -> fetch_assoc()) {
		// 		$dpID = $row['facID'];
		// 	}
		// }

		// // ******* Fetch intake id *******//

		// $dSQL = "SELECT * FROM intake WHERE intakeName = '$intake'";

		// $resultDep = $conn -> query($dSQL);

		// if (mysqli_num_rows($resultDep) > 0) {
		// 	while ($row = $resultDep -> fetch_assoc()) {
		// 		$inkID = $row['intakeID'];
		// 	}
		// }

		// if ($facId != $dpID) {
		// 	echo "<div class='alert alert-warning'>$depart is not in the selected faculty </div>";
		// }

		// // Now insert data into db
		// $sql ="INSERT INTO `students`(`stud_regno`, `stud_name`, `stud_midname`, `stud_lname`, `stud_intake`, `stud_year`, `stud_semester`, `stud_fac`, `stud_depart`) VALUES ('$regno','$fname','$midname','$lname','$inkID','$yearOfStudy',$semester,'$facId','$dpID')";

		// $result = $conn -> query($sql);
		// // check if data was inserted
		// if($result){
		// 	echo "Student successfully registered";
		// }
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all"> -->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mx-auto">
					<div class="card-header bg-dark">
						<h3 style="color: white;">Register Student</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="">
							<div class="form-group">
								<label>Registration Number</label>
								<input type="text" name="regnumber" class="form-control">
							</div>
							<div class="form-group">
								<label>First Name</label>
								<input type="text" name="firstname" id="firstname" class="form-control">
							</div>
							<div class="form-group">
								<label>Middle Name</label>
								<input type="text" name="middlename" id="middlename"  class="form-control">
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" name="lastname" onblur="passwordGenerator(this)" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" id="password" class="form-control">
							</div>
							<div class="form-group">
								<label>Select Intake</label>
								<select name="intake" class="form-control">
									<option selected="selected">--select--</option>
									<?php intakeOption($conn) ?>
								</select>
							</div>
							<div class="form-group">
								<label>Year of study</label>
								<select name="yearOfStudy" class="form-control">
									<option selected="selected">--select--</option>
									<?php yearOption($conn) ?>
								</select>
							</div>
							<div class="form-group">
								<label>Semester</label>
								<select name="semester" class="form-control">
									<option selected="selected">--select--</option>
									<?php semesterOption($conn) ?>
								</select>
							</div>
							<div class="form-group">
								<label>Faculty</label>
								<select name="faculty" class="form-control">
									<option selected="selected">--select--</option>
									<?php facultyOption($conn) ?>
								</select>
							</div>
							<div class="form-group">
								<label>Department</label>
								<select name="department" class="form-control">
									<option selected="selected">--select--</option>
									<?php departmentOption($conn) ?>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="add" value="Register" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function passwordGenerator(input) {
			var fst_value = input.value;
			document.getElementById('password').value = fst_value;
		}
	</script>
</body>
</html>