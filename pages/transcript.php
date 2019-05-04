<?php 
	require_once '../controllers/connection.php';
	require_once '../controllers/functions.php';

	function getTranscript($conn,$entry)
	{
		$yearId = $_SESSION['year'];
		$semID = $_SESSION['semester'];
		$facID = $_SESSION['faculty'];
		$regnumber = $_SESSION['regno'];
		$dp_table = getDepartment($conn);
		$res_table = getResultTable($conn);
		$initial_gpa = 0; $tot_gpa = 0;
		$num_courses = 0;


		for ($i= 1; $i <= $semID ; $i++) { 
			$sql = "SELECT * FROM $res_table INNER JOIN $dp_table ON `$res_table`.`regno` = '$regnumber' AND `$res_table`.`semester`= '$i' AND `$res_table`.`cu_name` = `$dp_table`.`courseUnit`";

			$sqlSUM = "SELECT SUM(gpa) AS GPA FROM $res_table WHERE `regno` = '$regnumber' AND `semester`= '$i'";
			$response = $conn -> query($sqlSUM);
			$data = $response -> fetch_assoc();
			$initial_gpa = $data['GPA'];

			$result = $conn -> query($sql);
			if (mysqli_num_rows($result) > 0) {
				echo '<h3>SEMESTER '.$i.'</h3>
					<table class="table">
						<thead>
							<tr>
								<th>Course Code</th>
								<th>Course Name</th>
								<th>Grade</th>
								<th>GP</th>
							</tr>
						</thead>
						<tbody>';

				while ($row = $result -> fetch_assoc()) {
					$num_courses = mysqli_num_rows($result);

					$tot_gpa = $initial_gpa / $num_courses;
					echo '
						<tr>
							<td>'.$row['course_code'].'</td>
							<td>'.$row['cu_name'].'</td>
							<td>'.$row['exam_marks'].'</td>
							<td>'.$row['gpa'].'</td>
						</tr>
					';
				}

				echo '</tbody>
					</table>
					<p>This Semester : <strong> GPA = '.$tot_gpa.'</strong></p>';

			}else{
				echo '<h3>SEMESTER '.$i.'</h3>
				<table class="table">
				<tbody>
					<tr>
						<td><center>No result yet</center></td>
					</tr>
				</tbody>
			</table>';
			}
		}
	} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="row">
		<?php getTranscript($conn,1) ?><br>
<!-- 
		<?php getTranscript($conn,2) ?><br>

		<?php getTranscript($conn,3) ?><br>

		<?php getTranscript($conn,4) ?><br>

		<?php getTranscript($conn,5) ?><br>

		<?php getTranscript($conn,6) ?><br> -->


	</div>
</body>
</html>