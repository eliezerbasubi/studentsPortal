<?php
	require_once '../controllers/functions.php';
	require_once '../controllers/connection.php';

  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
	 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 		<?php echo '<div class="card">
	 			<div class="card-header bg-dark">
	 				<h3 style="color:white;">Add Department</h3>
	 			</div>
	 		</div>
	 		<div class="card-body">
	 				<form method="POST" action="'.handleAddDepartment($conn).'">
		 			<div class="form-group">
		 				<label>Department</label>
		 				<input type="text" name="department" class="form-control">
		 			</div>
		 			<div class="form-group">
		 				<label>Faculty</label>
		 				<select name="fac" class="form-control">
		 					<option selected="selected">--select--</option>
		 					';?><?php facultyOption($conn) ?>
		 		 <?php
		 			echo '</select>
		 			</div>
		 			<div class="form-group">
		 				<input type="submit" name="btn_dp" value="Add Department" class="btn btn-success">
		 			</div>
		 		</form>
	 			'; ?>
	 		</div>
	 	</div>

	 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 		<?php echo '<div class="card">
	 			<div class="card-header bg-dark">
	 				<h3 style="color:white;">Add Course Units</h3>
	 			</div>
	 		</div>
	 		<div class="card-body">
	 				<form method="POST" action="'.handleAddCourseUnit($conn).'">
		 			<div class="form-group">
		 				<label>Department</label>
		 				<select name="depart" class="form-control">
		 					<option selected="selected">--select--</option>
		 					';?><?php departmentOption($conn) ?>
		 		 <?php
		 			echo '</select>
		 			</div>
		 			<div class="form-group">
		 				<label>Course unit name</label>
		 				<input type="text" name="crs_unit" class="form-control">
		 			</div>

		 			<div class="form-group">
		 				<label>Course Code</label>
		 				<input type="text" name="crs_code" class="form-control">
		 			</div>

		 			<div class="form-group">
		 				<label>Semester</label>
		 				<select name="semester" class="form-control">
		 					<option selected="selected">--select--</option>
		 					';?><?php semesterOption($conn) ?> <?php
		 			echo '</select></div>

		 			<div class="form-group">
		 				<label>Year of study</label>
		 				<select name="year" class="form-control">
		 					<option selected="selected">--select--</option>
		 					';?><?php yearOption($conn) ?> <?php
		 			echo '</select></div>

		 				<p>Is this course unit optional or compulsory ?</p>
		 				
		 				<input type="radio" name="status" value="0" id="compulsory" checked="checked">
		 				<label for="compulsory">Compulsory</label>&nbsp; &nbsp;

		 				<input type="radio" name="status" value="1" id="optional">
		 				<label for="optional">Optional</label>
		 			

		 			<div class="form-group">
		 				<input type="submit" name="btn_course" value="Add Course" class="btn btn-success">
		 			</div>
		 		</form>
	 			'; ?>
	 	</div>

	 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 		
	 	</div>

	 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 		
	 	</div>
	 </div>
	</div>
</body>
</html>