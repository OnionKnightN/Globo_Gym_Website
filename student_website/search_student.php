<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Search Students</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<?php
		if(isset($_GET['searched'])) {
			if(empty($_GET['search'])) {?>
				<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
				  <a class="navbar-brand" href="../student_website/index.html">Student Management System</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
				    <ul class="navbar-nav">
				      <li class="nav-item">
				        <a class="nav-link" href="../student_website/index.html">Home</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="../student_website/add_student.php">Form</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="../student_website/search_student.php">Search</a>
				      </li>
				    </ul>
				  </div>
				</nav>
				<img class = "mainbackground" src="img/background.jpeg" alt = "blue background">
				<form action="search_student.php" method="GET" class ="form">
					<h2>Search Registered Student</h2>
					<label for="search">Enter Student Id</label>
					<input type="text" name="search" placeholder="eg. 2989969" class="form-control"/>
					<p>Please enter a vailid student id to search for student.</p>
					<p id = "searching"><input type="submit" name="searched" value="Search Student"></p>
				</form>
				<footer class="page-footer font-small text-muted bg-dark">
					 <div class="text-center py-3">
						 <p>Student Details: Hoai Nhan Nguyen (2989969)</p>
					 </div>
				</footer>
		<?php	}else {
				$search = $_GET['search'];
				$db_connection = mysqli_connect('localhost', 's2989969', 'password', 's2989969');
				mysqli_set_charset($db_connection, 'utf8');
				$sql = "SELECT * FROM student WHERE student_no = $search;";
				$result = mysqli_query($db_connection, $sql);
				if($result){?>
					<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
					  <a class="navbar-brand" href="../student_website/index.html">Student Management System</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					    <span class="navbar-toggler-icon"></span>
					  </button>
					  <div class="collapse navbar-collapse" id="collapsibleNavbar">
					    <ul class="navbar-nav">
					      <li class="nav-item">
					        <a class="nav-link" href="../student_website/index.html">Home</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="../student_website/add_student.php">Form</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="../student_website/search_student.php">Search</a>
					      </li>
					    </ul>
					  </div>
					</nav>
					<?php
					while($row = mysqli_fetch_array($result)){
						foreach($row as $column=>$value){
							if(!is_numeric($column)){
								echo "<p><b>$column</b>: $value</p>";
							}
						}
					}
				}
				mysqli_close($db_connection);
			}
		}else { ?>
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			  <a class="navbar-brand" href="../student_website/index.html">Student Management System</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="collapsibleNavbar">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="../student_website/index.html">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="../student_website/add_student.php">Form</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="../student_website/search_student.php">Search</a>
			      </li>
			    </ul>
			  </div>
			</nav>
			<img class = "mainbackground" src="img/background.jpeg" alt = "blue background">
			<form action="search_student.php" method="GET" class ="form">
				<h2>Search Registered Student</h2>
				<label for="search">Enter Student Id</label>
				<input type="text" name="search" placeholder="eg. 2989969" class="form-control"/>
				<p id = "searching"><input type="submit" name="searched" value="Search Student"></p>
			</form>
			<footer class="page-footer font-small text-muted bg-dark">
				 <div class="text-center py-3">
					 <p>Student Details: Hoai Nhan Nguyen (2989969)</p>
				 </div>
			</footer>
	<?php }
	?>
	</body>
</html>
