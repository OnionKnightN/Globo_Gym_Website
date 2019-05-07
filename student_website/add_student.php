<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Register New Students</title>
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
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				$errors = array();
				if(empty($_POST['student_no'])) {
					$errors[] = 'Student number is required.';
				}else {
					$userid = trim($_POST['student_no']);
					if (!preg_match('/[0-9]{7}$/',$userid)) {
						$errors[] = "Invalid Student number!";
					}
				}
				if(empty($_POST["first_name"])) {
					$errors[] = 'First name is required.';
				}else {
						$first_name = trim($_POST["first_name"]);
						if (!preg_match("/^[a-zA-Z]/",$first_name))	{
							$errors[] = "Invalid First Name! Use only letters and white space.";
						}
				}
				if(empty($_POST["last_name"])) {
					$errors[] = 'Last name is required.';
				}else {
						$last_name = trim($_POST["last_name"]);
						if (!preg_match("/^[a-zA-Z]/",$last_name)){
							$errors[] = "Invalid Last Name! Use only letters and white space.";
						}
				}
				if(empty($_POST["dob"])) {
					$errors[] = "Please Enter Date of Birth.";
				}else {
					$dob = trim($_POST["dob"]);
				}
				if(empty($_POST["gender"])) {
					$errors[] = "Please select a gender";
				}else {
					$gender = trim($_POST["gender"]);
				}
				if(empty($_POST["mobile"])) {
					$errors[] = 'Mobile Number is required.';
				}else {
						$mobile = trim($_POST["mobile"]);
						if (!preg_match("/^08[0-9]{8}$/",$mobile)) {
							$errors[] = "Invalid Mobile Number!";
						}
				}
				if(empty($_POST["home_tel"])) {
					$errors[] = 'Home Telephone Number is required.';
				}else {
						$home_tel = trim($_POST["home_tel"]);
						if (!preg_match("/^014[0-9]{6}$/",$home_tel)) {
							$errors[] = "Invalid Home Telephone Number!";
						}
				}
				if (empty($_POST['email'])) {
					$errors[] = 'Email is required.';
				}else {
					$email = trim($_POST['email']);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$errors[] = "Invalid email address.";
					}
				}
				if(empty($_POST["address"])) {
					$errors[] = 'Address is required.';
				}else {
						$address = trim($_POST["address"]);
						if (!preg_match("/^[0-9] [a-zA-Z]/",$address)) {
							$errors[] = "Invalid Address!";
						}
				}
				if(empty($_POST["major"])) {
					$errors[] = "Please select a major";
				}else {
					$major = trim($_POST["major"]);
				}
				if(empty($_POST["course"])) {
					$errors[] = "Please select course";
				}else {
					$course = trim($_POST["course"]);
				}
				if(empty($_POST["mode"])) {
					$errors[] = "Please Select Study mode";
				}else {
					$mode = trim($_POST["mode"]);
				}
				if(empty($_POST["start_date"])) {
					$errors[] = "Please enter start date";
				}else {
					$start_date = trim($_POST["start_date"]);
				}
				if(empty($_POST["end_date"])) {
					$errors[] = "Please enter end date";
				}else {
					$end_date = trim($_POST["end_date"]);
				}
				if (empty($errors)) {?>
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
					<div class = "success">
						<h2>Register New Student</h2>
						<p>The Student That You Have Registered</p>
						<a class = "btn btn-primary bg-dark" href="../student_website/index.html" role ="button" >Return To Home Page</a>
						<a class = "btn btn-primary bg-dark" href="../student_website/add_student.php" role ="button" >Register New Student</a>
					</div>
					<footer class="page-footer font-small text-muted bg-dark">
						 <div class="text-center py-3">
							 <p>Student Details: Hoai Nhan Nguyen (2989969)</p>
						 </div>
					</footer>
			<?php
				$db_connection = mysqli_connect('localhost', 's2989969', 'password', 's2989969');
				mysqli_set_charset($db_connection, 'utf8');
				$query = "INSERT INTO student VALUES('$userid', '$first_name', '$last_name','$dob','$gender','$mobile','$home_tel','$email','$address','$major','$course','$mode','$start_date','$end_date')";
				if (mysqli_query($db_connection, $query)){
					echo "<p class = 'userdata'>Has Successfully Been Added to the Database!!</p>";
				}else {
					echo "<p class = 'userdata'> Has Been Previous Submitted To The Database.</p>";
				}
				mysqli_close($db_connection);
			?>
			<?php
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
					<div class = "errors">
						<h2>Register New Student</h2>
						<p>Error! Please <a class = "text" href="../student_website/add_student.php" >go back</a> and enter the correct details.<br>The following error(s) occurred:</p>
					</div>
					<?php
						foreach (array_reverse($errors) as $msg){
								echo "<p class = 'error'>- $msg <br/></p>";
						}
					?>
	<?php	}
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
			<form action="add_student.php" method="POST" class ="form">
				<h2>Register New Student</h2>
				<label>Student number: </label><input type="text" name="student_no" id="student_no" class ="form-control" size="20" maxlength="20">
				<label>Firstname: </label><input type="text" name="first_name" id="first_name" class ="form-control" size="20" maxlength="30">
				<label>Lastname: </label><input type="text" name="last_name" id="last_name" class ="form-control" size="20" maxlength="30">
				<label>Date of Birth: </label><input type="date" name="dob" id="dob" class ="form-control">
				<label>Gender: </label>
				<select name ="gender" class ="form-control">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Unknown">Unknown</option>
				</select>
				<label>Mobile: </label><input type="tel" name="mobile" placeholder="eg. 0861238200" class ="form-control"/>
				<label>Home Telephone: </label><input type="tel" name="home_tel" placeholder="eg. 014567890" class ="form-control"/>
				<label>Email: </label><input type="email" name="email" class ="form-control"/>
				<label>Address: </label> <input type="text" name="address" size="20" maxlength="200" class ="form-control">
				<label>Major: </label>
				<select name ="major" class ="form-control">
					<option value="Computer Science">Computer Science</option>
					<option value="Architecture">Architecture</option>
					<option value="Medicine">Medicine</option>
					<option value="Business">Business</option>
					<option value="Journalism">Journalism</option>
				</select>
				<label>Course Type: </label>
				<select name ="course" class ="form-control">
					<option value="PHD">Postgraduate</option>
					<option value="MS">Masters</option>
					<option value="BA">Bachelors</option>
					<option value="Dip">Diploma</option>
					<option value="AdvDip">Higher Diploma</option>
				</select>
				<label>Study mode : </label>
				<select name ="mode" class ="form-control">
					<option value="Fulltime">Full-Time</option>
					<option value="Parttime">Part-time</option>
				</select>
				<label>Start date: </label><input type="date" name="start_date" id="start" class ="form-control">
				<label>End date: </label><input type="date" name="end_date" id="end" class ="form-control">
				<p id = "register"><input type="submit" name="submit" value="Register Student"></p>
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
