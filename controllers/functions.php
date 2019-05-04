<?php 
	require_once 'connection.php';

	$table;

	function loginUser($conn)
	{
		if (isset($_POST['login_btn'])) {
			$uid = mysqli_real_escape_string($conn,$_POST['username']);
			$pwd = mysqli_real_escape_string($conn,$_POST['password']);

			// Decrypt password using md5,sha1 and crypt
			$pwd = md5($pwd);
			$pwd_sha = sha1($pwd);
			$crypted = crypt($pwd_sha,"password");

			$statement = $conn -> prepare("SELECT * FROM `students` WHERE stud_name =? AND pwd =?");
			$statement -> bind_param("ss", $username, $password);

			$username = $uid;
			$password = $crypted;

			$statement->execute();

			$result = $statement-> get_result();
			$rowNumber = $result-> num_rows;

			if ($rowNumber > 0) {
				if ($row = $result->fetch_assoc()) {
					$_SESSION['regno'] = $row['stud_regno'];
					$_SESSION['fname'] = $row['stud_name'];
					$_SESSION['midname'] = $row['stud_midname'];
					$_SESSION['faculty'] = $row['stud_fac'];
					$_SESSION['semester'] = $row['stud_semester'];
					$_SESSION['year'] = $row['stud_year'];
					$_SESSION['intake'] = $row['stud_intake'];
					$_SESSION['department'] = $row['stud_depart'];

					header("Location: pages/homepage.php");
				}
			}else{
					echo "
						<div class='alert alert-danger'>
						  <strong>Warning!</strong> Wrong password or username
						</div>
					";
				}
			// exit();
		}
	};

	function loginAdmin($conn)
	{
		if (isset($_POST['login_btn'])) {
			$uid = mysqli_real_escape_string($conn,$_POST['username']);
			$pwd = mysqli_real_escape_string($conn,$_POST['password']);

			$statement = $conn -> prepare("SELECT * FROM `admin` WHERE admin_name =? AND admin_pwd =?");
			$statement -> bind_param("ss", $username, $password);

			$username = $uid;
			$password = $pwd;

			$statement->execute();

			$result = $statement-> get_result();
			$rowNumber = $result-> num_rows;

			if ($rowNumber > 0) {
				if ($row = $result->fetch_assoc()) {
					$_SESSION['admin_name'] = $row['admin_name'];
					header("Location: dashboard.php");
				}
			}else{
					echo "
						<div class='alert alert-danger'>
						  <strong>Warning!</strong> Failed to login as Administration.
						</div>
					";
				}
			// exit();
		}
	};

	function getDepartment($conn)
	{
		$depart = $_SESSION['department'];
		$sql = "SELECT `departId`,`depart_table`
		 FROM `departments` WHERE `departId` = ?";

		 $result = $conn -> query($sql);

		$statement = $conn -> prepare($sql);
		$statement -> bind_param("s", $depart);

		$intakeIds = $depart;
		$statement -> execute();

		$result = $statement -> get_result();
		$rowNumbers = $result -> num_rows;
		if ($rowNumbers > 0) {
			if($row = $result -> fetch_assoc()){
				// echo "".$row['depart_table']." ".date('Y')."";
				return $row['depart_table'];
			}
		}

	}

	function getResultTable($conn)
	{
		$depart = $_SESSION['department'];
		$sql = "SELECT `departId`,`depart_table`,`result_table`
		 FROM `departments` WHERE `departId` = ?";

		 $result = $conn -> query($sql);

		$statement = $conn -> prepare($sql);
		$statement -> bind_param("s", $depart);

		$intakeIds = $depart;
		$statement -> execute();

		$result = $statement -> get_result();
		$rowNumbers = $result -> num_rows;
		if ($rowNumbers > 0) {
			if($row = $result -> fetch_assoc()){
				// echo "".$row['depart_table']." ".date('Y')."";
				return $row['result_table'];
			}
		}

	}

	function getCourseUnits($conn)
	{
		$yearId = $_SESSION['year'];
		$semID = $_SESSION['semester'];
		$facID = $_SESSION['faculty'];
		$dp_table = getDepartment($conn);

		$sql = "SELECT * FROM $dp_table WHERE `bit_year` = $yearId AND `bit_sem`= $semID AND `bit_fac` = $facID ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '
				<tr>
					<td>
						<p>'.$row["courseUnit"].'</p>
					</td>
					<td>
						<p>'.$row["course_code"].'</p>
					</td>
				</tr>
			';
		}
	}

	function retrieveSemesters($conn)
	{
		$semID = $_SESSION['semester'];
		$dp_table = getDepartment($conn);
		$data = array();

		$sql = "SELECT * FROM $dp_table WHERE `bit_sem`<= $semID";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			// echo $row['bit_sem'];
			array_push($data, $row['bit_sem']);
		}

		$array = array_unique($data, SORT_REGULAR);
		foreach ($array as $key) {

			echo '<option>'.$key.'</option>';
		}
	}

	function getIntake($conn)
	{
		$intakeID = $_SESSION['intake'];
		$sql = "SELECT intakeName FROM intake WHERE intakeID = ?";

		$statement = $conn -> prepare($sql);
		$statement -> bind_param("s", $intakeIds);

		$intakeIds = $intakeID;
		$statement -> execute();

		$result = $statement -> get_result();
		$rowNumbers = $result -> num_rows;
		if ($rowNumbers > 0) {
			if($row = $result -> fetch_assoc()){
				echo "".$row['intakeName']." ".date('Y')."";
			}
		}
	}

	function semesterOption($conn)
	{
		$data = array();

		$sql = "SELECT * FROM semesters ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['semName'].'</option>';
		}

	}

	function intakeOption($conn)
	{
		$data = array();

		$sql = "SELECT * FROM intake ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['intakeName'].'</option>';
		}

	}

	function yearOption($conn)
	{

		$sql = "SELECT * FROM c_years ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['years'].'</option>';
		}
	}

	function facultyOption($conn)
	{
		$data = array();

		$sql = "SELECT * FROM faculty ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['facName'].'</option>';
		}
	}

	function departmentOption($conn)
	{
		// $data = array();

		$sql = "SELECT * FROM departments ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['departName'].'</option>';
		}
	}

	function studentsOption($conn)
	{
		$data = array();

		$sql = "SELECT `stud_regno` FROM students ";

		$result = $conn -> query($sql);

		while ($row = $result -> fetch_assoc()) {
			echo '<option>'.$row['stud_regno'].'</option>';
		}
	}

	// Handle add department function
	function handleAddDepartment($conn)
	{
		
		// Add department function
		if (isset($_POST['btn_dp'])) {
			$dp = $_POST['department'];
			$fac = $_POST['fac'];
			$facultyID; $dp_table; 
			$response; $answer; $result_table;

			$query = "SELECT * FROM faculty WHERE `facName`='$fac'";
			$res = $conn -> query($query);
			if(mysqli_num_rows($res) > 0){
				while ($data = $res -> fetch_assoc()) {
					$facultyID = $data['facId'];
				}
			}

			$sql = "SELECT * FROM departments WHERE `departName`= '$dp'";
			$result = $conn -> query($sql);
			if(mysqli_num_rows($result) > 0){
				echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
						Department already exists </div>";
			}else{
				switch ($fac) {
					case 'Science and Technology':
						$dp_table = substr($dp, 0, 5);
						$dp_table = preg_replace('/\s+/', '_', $dp_table);
						$dp_table = strtolower("fst_".$dp_table);

						// CREATE RESULTS TABLE FOR THE FACULTY
							$create_result = "CREATE TABLE if not exists $result_table (resultID int(11) PRIMARY KEY AUTO_INCREMENT,
							 regno varchar(25) NOT NULL, course_name varchar(255) NOT NULL, semester varchar(5) NOT NULL,  yearOfStudy varchar(5) NOT NULL)";

							$answer = $conn -> query($create_result) or die("table result error : ".mysqli_error($conn));

						// Create table for the new department
						$create = "CREATE TABLE IF NOT EXISTS $dp_table (bitID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
							courseUnit varchar(120) NOT NULL, course_code varchar(15) NOT NULL,
						    bit_fac varchar(5), bit_sem varchar(5) NOT NULL, bit_year varchar(5), `status` INT NOT NULL DEFAULT '0'); ";

						 // Execute query
						 $response = $conn -> query($create) or die(mysqli_error($conn));
						break;

						// Business
						case 'Business and Administration':
							$dp_table = substr($dp, 0, 5);
							$dp_table = preg_replace('/\s+/', '_', $dp_table);
							$dp_table = strtolower("fba_".$dp_table);
							$result_table = "results_fba";

							// CREATE RESULTS TABLE FOR THE FACULTY
							$create_result = "CREATE TABLE $result_table (resultID int(11) PRIMARY KEY AUTO_INCREMENT,
							 regno varchar(25) NOT NULL, course_name varchar(255) NOT NULL, semester varchar(5) NOT NULL,  yearOfStudy varchar(5) NOT NULL)";

							$answer = $conn -> query($create_result) or die("table result error : ".mysqli_error($conn));

							// Create table for the new department
							$create = "CREATE TABLE IF NOT EXISTS $dp_table (bitID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
								courseUnit varchar(120) NOT NULL, course_code varchar(15) NOT NULL,
							    bit_fac varchar(5),bit_sem varchar(5) NOT NULL, bit_year varchar(5)); ";

							 // Execute query
							 $response = $conn -> query($create) or die(mysqli_error($conn));

						break;

						// Engineering
						case 'Engineering':
							$dp_table = substr($dp, 0, 5);
							$dp_table = preg_replace('/\s+/', '_', $dp_table);
							$dp_table = strtolower("foe_".$dp_table);
							$result_table = "results_foe";

							// CREATE RESULTS TABLE FOR THE FACULTY
							$create_result = "CREATE TABLE IF NOT EXISTS $result_table (resultID int(11) PRIMARY KEY AUTO_INCREMENT,
							 regno varchar(25) NOT NULL, course_name varchar(255) NOT NULL, semester varchar(5) NOT NULL,  yearOfStudy varchar(5) NOT NULL)";

							$answer = $conn -> query($create_result) or die("table result error : ".mysqli_error($conn));

							// Create table for the new department
							$create = "CREATE TABLE IF NOT EXISTS $dp_table (bitID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
								courseUnit varchar(120) NOT NULL, course_code varchar(15) NOT NULL,
							    bit_fac varchar(5), bit_sem varchar(5) NOT NULL, bit_year varchar(5)); ";

							 // Execute query
							 $response = $conn -> query($create) or die(mysqli_error($conn));

						break;
					
					default:
						# code...
						break;
				}

				// Get length of departments table, then apply it as primary key to departName column

				if ($fac == "--select--") {
				echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
						No faculty selected! </div>";
				}else{
					$length_query = "SELECT * FROM departments";
					$request = $conn -> query($length_query);
					$length = mysqli_num_rows($request) + 1;

					$query = "INSERT INTO `departments`(`departId`,`departName`, `facID`, `depart_table`, `result_table`) VALUES ('$length','$dp','$facultyID','$dp_table','$result_table')";

					// Insert and create tables
					if ($response && $answer) {
						$result = $conn -> query($query) or die(mysqli_error($conn));

						if($result){
							echo "<div class='alert alert-success alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
							Department successfully added </div>";
						}
					}		
				}
			}
		}
	}

	// Handle add course unit
	function handleAddCourseUnit($conn)
	{
		if (isset($_POST['btn_course'])) {
			$depart = $_POST['depart'];
			$courseName = $_POST['crs_unit'];
			$courseCode = $_POST['crs_code'];
			$semester = $_POST['semester'];
			$year = $_POST['year'];
			$status = $_POST['status'];
			$selectedTable; $fac;

			// Check if a course unit has been selected or not
			if ($depart == "--select--" || $semester =="--select--" || $year == "--select--") {
				echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
						No faculty, semester or year selected! </div>";
			}else{
				$sql = "SELECT * FROM departments WHERE `departName`= '$depart'";
				$result = $conn -> query($sql);
				if(mysqli_num_rows($result) > 0){
					while ($data = $result -> fetch_assoc()) {
						$selectedTable = $data['depart_table'];
						$fac = $data['facID'];
					}

					// Check if the particular course unit is available
					$sql = "SELECT * FROM $selectedTable WHERE `courseUnit`= '$courseName' OR `course_code` = '$courseCode'";
					$result = $conn -> query($sql);

					// if found match
					if(mysqli_num_rows($result) > 0){
						echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
								Course Unit already exists </div>";
					}
					else{
						$query = "INSERT INTO `$selectedTable`(`courseUnit`, `course_code`, `bit_fac`, `bit_sem`, `bit_year`) VALUES ('$courseName','$courseCode','$fac','$semester','$year')";

						$response = $conn -> query($query);
						if ($response) {
							echo "<div class='alert alert-success alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
								Course Unit successfully added ! </div>";
						}
					}
				}
			}
		}
	}

	// View results and upgrade students to next semester
	function viewResults($conn)
	{
		if (isset($_POST['btn_check'])) {
			$depart = $_POST['department'];
			$semester = $_POST['semester'];
			$result_table; $all_values =array();
			$crs_table; $total_gpa;
			$error_logger;

			$sql = "SELECT * FROM departments WHERE `departName`= '$depart'";
			$r = $conn -> query($sql);
			if(mysqli_num_rows($r) > 0){
				while ($data = $r -> fetch_assoc()) {
					$result_table = $data['result_table'];
					$crs_table = $data['depart_table'];
				}
			}

			// $sql = "SELECT distinct `regno`,`stud_semester` FROM `students` INNER JOIN $result_table ON `students`.`stud_regno` = `$result_table`.`regno`";
			$sql ="SELECT * FROM  $result_table  INNER JOIN `students` ON `students`.`stud_regno` = `$result_table`.`regno` AND `students`.`stud_semester` = '$semester' GROUP BY `regno` ORDER BY `resultID` ASC";
			$result = $conn -> query($sql);

			// Get the running semester of a student
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result -> fetch_assoc()) {
					array_push($all_values, $row);
					// array_push($all_regno, $row['regno']);
				}
			}else{
				echo '<td colspan="4"><center>No data available!</center></td>';
			}

			foreach ($all_values as $value) {
				// Get sum of gpa for each student
				$answer = $conn -> query("SELECT SUM(gpa) AS GPA FROM $result_table WHERE `regno` = '".$value['regno']."' AND `semester` = '".$value['stud_semester']."'");
				$data = $answer -> fetch_assoc();

				// Get number of course units for each semester, to divide with course gp
				// in order to get total gpa
				$response = $conn -> query("SELECT COUNT(`courseUnit`) AS units FROM $crs_table WHERE `bit_sem` = '".$value['stud_semester']."'");

				$counter = $response -> fetch_assoc();

				// Get total gpa
				$total_gpa = $data['GPA'] / $counter['units'];

				// Check for gpa less than 2.5, and change the style of it.
				if ($total_gpa < 2.5) {
					$error_logger = "error_gpa";
				}else{
					$error_logger = "success_gpa";
				}

				echo '<tr>
 					<td>'.$value['regno'].'</td>
 					<td>'.$value['stud_semester'].'</td>
 					<td class="'.$error_logger.'">'.$total_gpa.'</td>
 					<td colspan="2">
 						<td><a href="upgrade_students.php?upgraded='.$value['regno'].'" class="form-control" style="background-color:black; color: white;">upgrade</a></td>
 						<td><a href="upgrade_students.php?view='.$value['regno'].'" class="form-control" style="background-color:black; color: white;">view</a></td>
 					</td>
 				</tr>';
			}
		}else{
			echo '<td colspan="4"><center>You have not selected yet!</center></td>';
		}
	}

	// Register students
	function registerStudents($conn){
		if (isset($_POST['register'])) {
			$dp_table = getDepartment($conn);
			$semID = $_SESSION['choice_for_semester'];
			$sql = "SELECT * FROM $dp_table WHERE `bit_sem`= '$semID' AND `status` = 1";

			$arrayCourses = array(); 
			$arrCourseUnits = array();
			$notSelected = array(); //Get unchecked courses

			$connected_student = $_SESSION['regno'];

			$result = $conn -> query($sql);
			while ($row = $result -> fetch_assoc()) {//start while
				$optional = $row['bitID'];
				if (isset($_POST['choice'.$optional])) {
					array_push($arrayCourses, $_POST['choice'.$optional]);	
				}else{
					array_push($notSelected, $optional);
				}
							
			} //end while

			

			// check if student has selected more than 3 course units
			if (count($arrayCourses) > 2) {
				echo "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
					You can only select two course units as your area of specialization
				</div>";
			}

			// If student selects only one course units, it should return an error
			elseif (count($notSelected) > 1) {
				echo "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;    </button> 
					You can only select two course units as your area of specialization
				</div>";
			}

			// If course units are less than 2, let student register his/her course units
			else{
				// Load student department, in order to create tables of registered students 
				// for all departments
				$depart_table = getDepartment($conn);
				$keywords = preg_split ("/[_,]+/", $depart_table);
				
				// Create table for registered students
				$keywords = $keywords[0]."_registered";
				$createSQL = "CREATE TABLE IF NOT EXISTS `$keywords` (`stdID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, `std_regno` VARCHAR(120) NOT NULL, `crs_code` VARCHAR(30) NOT NULL, `crs_unit` VARCHAR(250) NOT NULL,`std_sem` VARCHAR(5) NOT NULL)";

				$response = $conn -> query($createSQL);

				// If table is successfully created, insert course units
				foreach ($notSelected as $index) {
					// Get values of inputs 
					$sqlDB = "SELECT * FROM $dp_table WHERE `bit_sem`= '$semID' AND `bitID` != '$index'";

					
					$result = $conn -> query($sqlDB);
						while ($row = $result -> fetch_assoc()) {//start while
							$opt = $row['bitID'];
							$cname = $row['course_code'];

							if (isset($_POST['cu'.$opt])) {
								array_push($arrCourseUnits, $row);
							}
										
						}//end while
					}

				if ($response) {
					// Check if student has ever registered course units for the running  semester
					
					$insertResult;
					foreach ($arrCourseUnits as $value) {
						// $sql = "SELECT * FROM `$keywords` WHERE `std_regno` = '$connected_student' AND `crs_code` = '".$value['course_code']."' AND `crs_unit` = '".$value['courseUnit']."' AND `std_sem` = '$semID'";

						// Remove checking for course unit and course code because when student tries to register for a second time, the system will check for his/her reg number and semester he/she wants to register.
						// If you leave course unit and course code, the system will loop through all data in database, if there's a match it won't insert else it will.
						$sql = "SELECT * FROM `$keywords` WHERE `std_regno` = '$connected_student' AND `std_sem` = '$semID'";
						
						$reply = $conn -> query($sql);
						if (mysqli_num_rows($reply) > 0) {
							echo '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Sorry !</b> You have already registered these course units
							</div>';
							break;
						}else{
							// Now insert values into database
							$query = "INSERT INTO `fst_registered`(`std_regno`, `crs_code`, `crs_unit`, `std_sem`) VALUES ('$connected_student','".$value['course_code']."','".$value['courseUnit']."','$semID')";

							$insertResult = $conn -> query($query);

							// Check for successful results while inserting
							// Put it outside foreach loop, to avoid multiple notifications when data is inserted
							if ($insertResult) {
								echo '<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<b>Thank You !</b> Your registration is successful
								</div>';

								break;
							}
						}
					}
				}
			}
		}
	}
 ?>