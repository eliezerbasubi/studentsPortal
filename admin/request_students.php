<?php 
	require_once '../controllers/connection.php';

	// Course unit 
	if (isset($_POST['semesterID'])) {
		$sem_id = $_POST['semesterID'];

		$sql = "SELECT * FROM course_units WHERE `course_sem` = '$sem_id'";

		$result = $conn -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			echo '<div class="form-group" id="crs_unit">
				<label>Select Course Unit</label>
				<select name="cunit" id="crs_id">
					<option selected="selected">--select--</option>';

			while ($row = $result -> fetch_assoc()) {
				// for ($i=1; $i <= $row['course_name'] ; $i++) { 
					echo '<option>'.$row['course_name'].'</option>';
				// }
			}

			echo "</select>
			</div>";
		}
	}

	echo $_SESSION['depart_id'];
 ?>