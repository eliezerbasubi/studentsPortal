<?php  
	require_once '../controllers/functions.php';
	// $yearId = $_SESSION['year'];
	// $semID = $_SESSION['semester'];

	// $sql = "SELECT `course_code`, `course_name`, `course_credit`, `course_year`, `course_sem` FROM `course_units` WHERE `course_year` = $yearId AND `course_sem`= $semID ";

	// $result = $conn -> query($sql);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="row">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Course Name</th>
						<th>Course Code</th>
					</tr>
				</thead>
				<tbody>
					<?php getCourseUnits($conn); ?>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>
<!-- <tbody>
					<tr>
						<td>
							<p>Computer Ethics and IT professionalism</p>
						</td>
						<td>
							<p>BIT3201</p>
						</td>
					</tr>

					<tr>
						<td>
							<p>Computer Networks and Implementation III</p>
						</td>
						<td>
							<p>BIT3202</p>
						</td>
					</tr>

					<tr>
						<td>
							<p>Strategic IT Management</p>
						</td>
						<td>
							<p>BIT3203</p>
						</td>
					</tr>
				</tbody> -->