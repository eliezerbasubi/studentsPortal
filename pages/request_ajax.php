<?php 
session_start();
require_once '../controllers/functions.php';
require_once '../controllers/connection.php';

	// if (isset($_POST['btn_remove'])) {
	// 	echo "workin";
	// }

	if (isset($_POST['value']) && $_POST['value'] != "--select--") {
		$semID = $_POST['value'];
		$se = $_SESSION['semester'];  //load semester of student
		$dp_table = getDepartment($conn);
		$sql = "SELECT * FROM $dp_table WHERE `bit_sem`= $semID";

		// Save locally the value of the selected semester
		$_SESSION["choice_for_semester"] = $semID;

		$result = $conn -> query($sql);

		echo '
		<table class="table">
			    <thead class="thead-dark">
			      <tr>
			        <th>Course Code</th>
			        <th>Course Name / Subjects</th>
			      </tr>
			    </thead>
			    <tbody>';
		while ($row = $result -> fetch_assoc()) {
			echo '
				<tr>
			        <td>
			        	<div class="form-group">
						  <input type="text" class="form-control" id="usr" placeholder="Enter course code 1 " value= "'.$row['course_code'].'" 
						  name="crs'.$row['course_code'].'" readOnly="readOnly">
						</div>
			        </td>

			        <td>
			        	<div class="form-group">
						  <input type="text" class="form-control" id="usr" placeholder="Enter course name 1" value="'.$row['courseUnit'].'" name="cu'.$row['bitID'].'" readOnly="readOnly">
						</div>
			        </td>';

			        // Choose course unit if it's optional
			        if ($row['status'] == 0) {
						// echo '<td>
				  //       	<button  class="btn btn-default" name="btn_remove"><i class="glyphicon glyphicon-ok" style="color:lightgreen; font-size:18px"></i></button>
				  //       </td>';
					}else{
						echo '<td><div class="form-group">
							<input type="checkbox" name="choice'.$row['bitID'].'" class="form-control" checked="checked" value="'.$row['courseUnit'].'">
						</div></td>';
					}
				echo '   
			      </tr>
			';
		}

		// <td>
  //       	<i class="glyphicon glyphicon-remove" style="color:red; font-size:18px"></i>
  //       </td>

		echo '</tbody>
			  </table>

			  <input type="submit" name="register" class="btn btn-success" value="Register">';
		
	}else{
		echo '<table class="table">
			    <thead>
			      <tr>
			        <th>Course Code</th>
			        <th>Course Name / Subjects</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			      	<td>No semester selected yet</td>
			      </tr>
			    </tbody>
			  </table>';
	}
 ?>