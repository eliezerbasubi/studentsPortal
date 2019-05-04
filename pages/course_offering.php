<?php 
	require_once '../controllers/connection.php';
	require_once '../controllers/functions.php';

	function getCourseOfferings($conn,$entry)
	{
		$yearId = $_SESSION['year'];
		$semID = $_SESSION['semester'];
		$facID = $_SESSION['faculty'];
		$dp_table = getDepartment($conn);

		$sql = "SELECT * FROM $dp_table WHERE bit_sem = $entry";

		$result = $conn -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($row = $result -> fetch_assoc()) {
				echo $row['courseUnit']."<br>";
			}
		}else{
			echo "No Course Unit available";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
	<style type="text/css">
		.view_semester{
			border: 1px solid black;
			border-radius: 10px;
			box-shadow: all;
		}

		.card-header{
			background-color: maroon;
		}

		.card-body{
			background-color: lightblue;
			padding: 5px;
			font-weight: 400;
		}

		.card:hover{
		    transform:scale(1.05);
		    -webkit-transform:scale(1.05);
		    -moz-transform:scale(1.05);
		    -o-transform:scale(1.05);
		    -ms-transform:scale(1.05);
		}
	</style>
</head>
<body>
	<div class="row">
		<?php 
			for ($i=1; $i < 9; $i++) { 
				?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
						<div class="card">
							<div class="card-header bg-primary">
								<h1>Semester <?php echo($i) ?></h1>
							</div>
							<div class="card-body">
								<?php getCourseOfferings($conn, $i) ?>
							</div>
						</div>
					</div>	
			<?php }
		 ?>	
	</div>
</body>
</html>
