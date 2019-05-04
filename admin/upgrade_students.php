<?php 
	require_once '../controllers/connection.php';
	require_once '../controllers/functions.php';

	if (isset($_GET['upgraded'])) {
		$regno = $_GET['upgraded'];
		$incrementer;

		$sql = "SELECT `stud_regno`,`stud_semester` FROM `students` WHERE `stud_regno` = '$regno'";
		$result = $conn-> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$row = $result -> fetch_assoc();
			$incrementer = $row['stud_semester'] + 1;

			$update = "UPDATE `students` SET `stud_semester` = $incrementer WHERE `stud_regno` = '$regno'";

			$response = $conn -> query($update);
			if ($response) {
				header("Location:dashboard.php?query=upgrade");
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.error_gpa{
			color: red;
		}
	</style>
</head>
<body>
	<div class="row">
	 	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	 		<form method="POST" action="">
	 			<div class="form-group">
					<label>Department</label>
					<select name="department" class="form-control">
						<option selected="selected">--select--</option>
						<?php departmentOption($conn) ?>
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
					<input type="submit" name="btn_check" value="View results" class="form-control btn btn-success" style="background-color: black; color: white; border-color: black;">
				</div>
	 		</form>
	 	</div>

	 	<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
	 		<div class="table-responsive">
	 			<table class="table">
		 			<thead>
		 				<th>Regno</th>
		 				<th>Semester</th>
		 				<th>GPA</th>
		 				<th>Action</th>
		 			</thead>
		 			<tbody>
		 				<?php viewResults($conn) ?>
		 			</tbody>
		 		</table>
	 		</div>
	 	</div>
	 </div>
</body>
</html>