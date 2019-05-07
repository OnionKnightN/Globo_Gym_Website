<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Join Now</title>
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
      .error {
        font-family: Helvetica;
        color: #800000;
        margin-top: -5px;
      }
    </style>
  </head>
  <body>
    <?php
    // Error Messages of Forms
    $user_typeErr = "";
    $user_titleErr = "";
    $user_fnameErr = "";
    $user_lnameErr = "";
    $user_genderErr = "";
    $user_dobErr = "";
    $user_emailErr = "";
    $user_pass1Err = "";
    $user_phoneErr = "";
    $user_addressErr = "";
    $user_pcodeErr = "";
    $user_healthErr = "";
    $user_termsErr = "";
    // Input of information of Forms
    $user_id = 20000;
    $user_type = "";
    $user_title = "";
    $user_fname = "";
    $user_lname = "";
    $user_gender = "";
    $user_dob = "";
    $user_email = "";
    $confirm_user_email = "";
    $user_pass1 = "";
    $user_pass = "";
    $user_phone = "";
    $user_address = "";
    $user_pcode = "";
    $user_health = "";
    $user_terms = "";
    // Number of errors from form
    $errors = 0;
    // Form vailidation.
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      // Membership vailidation.
      $user_id += 1;
      if (empty($_POST["user_type"])) {
        $user_typeErr = "<p class ='error'>*Please select a Membership Type</p>";
        $errors += 1;
      } else {
        $user_type = test_input($_POST["user_type"]);
      }
      // Title vailidation.
      if (empty($_POST["user_title"])) {
        $user_titleErr = "<p class ='error'>*Please select a Title</p>";
        $errors += 1;
      } else {
        $user_title  = test_input($_POST["user_title"]);
      }
      // First Name vailidation.
      if (empty($_POST["user_fname"])) {
        $user_fnameErr = "<p class ='error'>*First name is required.</p>";
        $errors += 1;
      } else {
        $user_fname = test_input($_POST["user_fname"]);
        if (!preg_match("/^[a-zA-Z]/", $user_fname)) {
          $user_fnameErr = "<p class ='error'>*Invalid Firstname(use only letters and white space)</p>";
          $errors += 1;
        }
      }
      // Last Name vailidation.
      if (empty($_POST["user_lname"])) {
        $user_lnameErr = "<p class ='error'>*Last name is required.</p>";
        $errors += 1;
      } else {
        $user_lname = test_input($_POST["user_lname"]);
        if (!preg_match("/^[a-zA-Z]/", $user_lname)) {
          $user_lnameErr = "<p class ='error'>*Invalid Lastname(use only letters and white space)</p>";
          $errors += 1;
        }
      }
      // Gender vailidation.
      if (empty($_POST["user_gender"])) {
        $user_genderErr = "<p class ='error'>*Please select a gender type</p>";
        $errors += 1;
      } else {
        $user_gender = test_input($_POST["user_gender"]);
      }
      // Date of Birth vailidation.
      if (empty($_POST["user_dob"])) {
        $user_dobErr = "<p class ='error'>*Date of birth is required.</p>";
        $errors += 1;
      } else {
        $user_dob = test_input($_POST["user_dob"]);
      }
      // Email validation.
      if (empty($_POST['user_email'])) {
        $user_emailErr = "<p class ='error'>*Email is required.</p>";
        $errors += 1;
      } elseif (($_POST['user_email']) != ($_POST['confirm_user_email'])) {
        $user_emailErr = "<p class ='error'>*Emails are not matching.</p>";
        $errors += 1;
      } else {
        $user_email = test_input($_POST['user_email']);
        $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
          $user_emailErr = "<p class ='error'>*Invalid email address.</p>";
          $errors += 1;
        }
      }
      //Password validation
      if (empty($_POST['user_pass1']) && empty($_POST['user_pass2'])) {
        $user_pass1Err = "<p class ='error'>*The passwords are required</p>";
        $errors += 1;
      } elseif (($_POST['user_pass1']) != ($_POST['user_pass2'])) {
        $user_pass1Err = "<p class ='error'>*The passwords do not match.</p>";
      } else {
        $user_pass1 = test_input($_POST['user_pass1']);
        $user_pass1 = hash('sha256', $user_pass1);
      }
      // Phone vailidation.
      if (empty($_POST["user_phone"])) {
        $user_phoneErr = "<p class ='error'>*Phone number is required.</p>";
        $errors += 1;
      } else {
        $user_phone = test_input($_POST["user_phone"]);
        if (!preg_match("/^08[3-9]{1}[0-9]{7}$/", $user_phone)){
          $user_phoneErr = "<p class ='error'>*Invalid phone number</p>";
          $errors += 1;
        }
      }
      // Address vailidation.
      if (empty($_POST["user_address"])) {
        $user_addressErr = "<p class ='error'>*Address is required.</p>";
        $errors += 1;
      } else {
        $user_address = test_input($_POST["user_address"]);
        if (!preg_match("/[1-9]+[ a-zA-Z]+/", $user_address)) {
          $user_addressErr = "<p class ='error'>*Invalid address</p>";
          $errors += 1;
        }
      }
      // Post code vailidation.
      if (empty($_POST["user_pcode"])) {
        $user_pcodeErr = "<p class ='error'>*Please select post code</p>";
        $errors += 1;
      } else {
        $user_pcode = test_input($_POST["user_pcode"]);
      }
      // User health vailidation
      if(empty($_POST['user_health'])){
          $user_healthErr = "<br><br><p class ='error'>*Please check one of the health options</p>";
          $errors += 1;
      } else {
          $user_health = "if you check yes for health issues please inform our gym receptionist.";
      }
      // User terms vailidation
      if(empty($_POST['user_terms'])){
          $user_termsErr = "<p class ='error'>*Please read and agreed to the Globo Gym's terms and condition before continuing.</p>";
          $errors += 1;
      } else {
          $user_terms = "You have read and agreed to the Globo Gym's terms and condition";
      }
    }
    //Manipulate the data input from the user.
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = strtolower($data);
      return $data;
    }
    if ($errors == 0) {?>
    <header>
      <div><a href="index.html"><img src="img/globoGymLogo.png" alt= "home logo" id ="logo"></a></div>
      <label id= "burger" for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle"/>
      <nav class="nav_main">
        <ul class="nav_list">
          <li><a href="membership.html">MEMBERSHIP</a></li>
          <li><a href="classes.html">CLASSES</a></li>
          <li><a href="about_us.html">ABOUT US</a></li>
          <li><a href="testimonial.html">TESTIMONIAL</a></li>
          <li><a href="careers.html">CAREERS</a></li>
          <li><a href="contact_us.html">CONTACT US</a></li>
          <li class = "special"><a href="join_now.html">JOIN NOW</a></li>
          <li class = "special"><a href="login.html">LOG IN</a></li>
        </ul>
      </nav>
    </header>
    <section class="form_container">
      <form action="join_now.php" method="post" class="form">
        <h1>GYM MEMBERSHIP</h1>
        <label>MEMBERSHIP TYPE*</label>
        <select name="user_type" class="form_control">
          <option value="month_stu">Monthly Student</option>
          <option value="year_stu">Yearly Student</option>
          <option value="month_adt">Monthly Adult</option>
          <option value="year_adt">Yearly Adult</option>
          <option value="month_premium">Monthly Premium</option>
          <option value="year_premium">Yearly Premium</option>
        </select>
         <!--<label>CLASS*</label><br>
           <div class = "form_class_container" >
            <input type="checkbox" name="bootcamp" value="bootcamp" class="form_class"><label>BOOTCAMP</label>
            <input type="checkbox" name="strength/condition" value="strength/condition" class="form_class"><label>STRENGTH/CONDITION</label>
            <input type="checkbox" name="battle_rope" value="battle_rope" class="form_class"><label>BATTLE ROPES</label>
            <input type="checkbox" name="boxing" value="boxing" class="form_class"><label>BOXING</label>
            <input type="checkbox" name="globocycle" value="globocycle" class="form_class"><label>GLOBO CYCLE</label>
            <input type="checkbox" name="dragonboat" value="dragonboat" class="form_class"><label>DRAGON BOAT</label>
            <input type="checkbox" name="trx" value="trx" class="form_class"><label>TRX</label>
            <input type="checkbox" name="kickboxing" value="kickboxing" class="form_class"><label>KICKBOXING</label>
            <input type="checkbox" name="globoball" value="globoball" class="form_class"><label>GLOBOBALL</label>
          </div>-->
        <label>TITLE*</label>
        <select name="user_title" class="form_control">
          <option value="mr">Mr</option>
          <option value="mrs">Mrs</option>
          <option value="ms">Ms</option>
          <option value="mx">Mx</option>
          <option value="dr">Dr</option>
        </select>
        <label>FIRSTNAME*</label><input type="text" name="user_fname" class="form_control" size="20" maxlength="30">
        <label>LASTNAME*</label><input type="text" name="user_lname" class="form_control" size="20" maxlength="30">
        <label>GENDER*</label>
        <select name="user_gender" class="form_control">
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="unknown">Unknown</option>
        </select>
        <label>DATE OF BIRTH*</label><input type="date" name="user_dob" class="form_control" min="1920-01-01" max="2001-01-01">
        <label>EMAIL ADDRESS*</label>
        <input type="email" name="user_email" class="form_control"/>
        <label>CONFIRM EMAIL*</label>
        <input type="email" name="confirm_user_email" class="form_control"/>
        <label>PASSWORD*</label><input type="password" class="form_control" name="user_pass1" required>
        <label>COMFIRM PASSWORD*</label><input type="password" class="form_control" name="user_pass2" required>
        <label>ADDRESS</label> <input type="text" name="user_address" size="20" maxlength="200" class ="form_control">
        <label>POST CODE</label>
          <select name ="user_pcode" class ="form_control">
            <option value="D1">Dublin 1</option>
            <option value="D2">Dublin 2</option>
            <option value="D3">Dublin 3</option>
            <option value="D4">Dublin 4</option>
            <option value="D5">Dublin 5</option>
            <option value="D6">Dublin 6</option>
            <option value="D7">Dublin 7</option>
            <option value="D8">Dublin 8</option>
            <option value="D9">Dublin 9</option>
            <option value="D10">Dublin 10</option>
            <option value="D11">Dublin 11</option>
            <option value="D12">Dublin 12</option>
            <option value="D13">Dublin 13</option>
            <option value="D14">Dublin 14</option>
            <option value="D15">Dublin 15</option>
            <option value="D16">Dublin 16</option>
            <option value="D17">Dublin 17</option>
            <option value="D18">Dublin 18</option>
            <option value="D19">Dublin 19</option>
            <option value="D20">Dublin 20</option>
            <option value="D21">Dublin 21</option>
            <option value="D22">Dublin 22</option>
            <option value="D23">Dublin 23</option>
            <option value="D24">Dublin 24</option>
          </select>
          <label>PHONE NUMBER</label>
          <input type="tel" name="user_phone" placeholder="eg.0861238200" class="form_control"/>
          <div class="border"></div>
          <label>Do you have any health issues?</label>
          <input type="radio" name="user_health" value="no" class="form_radio"><label class="form_radio">No</label>
          <input type="radio" name="user_health" value="yes" class="form_radio"><label class="form_radio">Yes</label>
          <div class="border"></div>
          <p><label>I allow Globo Gym to send me marketing offers from time to time.</label><input type="checkbox" name="user_marketing" value="yes" class="form_checkbox"></p>
          <p><label>I have read and agreed to the Globo Gym's terms and condition.</label><input type="checkbox" name="user_terms" value="yes" class="form_checkbox"></p>
          <div class="border"></div>
        <input type="submit" name="submit" value="SUBMIT" class="formBtn" required>
      </form>
    </section>
    <footer>
      <div class="footer_detail">
        <h3>GLOBO GYM LIMITED</h3>
        <p>10 Harring Angel Street,Dublin 8<br>Mobile No: 014967876<br>
        Email: globogym@gmail.com<br><br>Registered in Ireland<br>
        Company No . IE555527<br>VAT No. IE1123544OH</p>
      </div>
      <div class="footer_list">
        <h3>QUICK LINKS</h3>
        <ul>
          <li><a href="#">ABOUT US</a></li>
          <li><a href="#">CLASSES</a></li>
          <li><a href="#">CAREERS</a></li>
          <li><a href="#">CONTACT US</a></li>
          <li><a href="#">PRIVACY POLICY</a></li>
          <li><a href="#">TERMS & CONDITIONS</a></li>
        </ul>
      </div>
      <div class="social">
        <h3>SOCIAL MEDIA</h3>
        <a href="#" target="_blank"><img src="img/facebook.png" alt= "facebook logo" class ="social_logo"></a>
        <a href="#" target="_blank"><img src="img/instagram.png" alt= "instagram logo" class ="social_logo"></a>
        <a href="#" target="_blank"><img src="img/youtube.png" alt= "youtube logo" class ="social_logo"></a>
        <a href="#" target="_blank"><img src="img/snapchat.png" alt= "snapcaht logo" class ="social_logo"></a>
      </div>
    </footer>
    <?php
				$db_connection = mysqli_connect('localhost', 's2989969', 'Password', 's2989969');
				mysqli_set_charset($db_connection, 'utf8');
				$query = "INSERT INTO tbl_user VALUES('$user_id','$user_type','$user_title','$user_fname','$user_lname','$user_gender','$user_dob','$user_email','$user_address','$user_pcode','$user_phone')";
        //(mysqli_query($db_connection, $query);
        if (mysqli_query($db_connection, $query)){
					echo "<p class = 'userdata'>Has Successfully Been Added to the Database!!</p>";
				}else {
					echo "<p class = 'userdata'> You are not connected to the database.</p>";
				}
				mysqli_close($db_connection);
			?>
    <?php
		  }else { ?>
        <header>
          <div><a href="index.html"><img src="img/GloboGymLogo.png" alt= "home logo" id ="logo"></a></div>
          <label id= "burger" for="toggle">&#9776;</label>
          <input type="checkbox" id="toggle"/>
          <nav class="nav_main">
            <ul class="nav_list">
              <li><a href="membership.html">MEMBERSHIP</a></li>
              <li><a href="classes.html">CLASSES</a></li>
              <li><a href="about_us.html">ABOUT US</a></li>
              <li><a href="testimonial.html">TESTIMONIAL</a></li>
              <li><a href="careers.html">CAREERS</a></li>
              <li><a href="contact_us.html">CONTACT US</a></li>
              <li class = "special"><a href="join_now.html">JOIN NOW</a></li>
              <li class = "special"><a href="login.html">LOG IN</a></li>
            </ul>
          </nav>
        </header>
        <section class="form_container">
          <form action="join_now.php" method="post" class="form">
            <h1>GYM MEMBERSHIP</h1>
            <label>MEMBERSHIP TYPE*</label>
            <select name="user_type" class="form_control">
              <option value="month_stu">Monthly Student</option>
              <option value="year_stu">Yearly Student</option>
              <option value="month_adt">Monthly Adult</option>
              <option value="year_adt">Yearly Adult</option>
              <option value="month_premium">Monthly Premium</option>
              <option value="year_premium">Yearly Premium</option>
            </select>
            <?php echo $user_typeErr; ?>
             <!--<label>CLASS*</label><br>
               <div class = "form_class_container" >
                <input type="checkbox" name="bootcamp" value="bootcamp" class="form_class"><label>BOOTCAMP</label>
                <input type="checkbox" name="strength/condition" value="strength/condition" class="form_class"><label>STRENGTH/CONDITION</label>
                <input type="checkbox" name="battle_rope" value="battle_rope" class="form_class"><label>BATTLE ROPES</label>
                <input type="checkbox" name="boxing" value="boxing" class="form_class"><label>BOXING</label>
                <input type="checkbox" name="globocycle" value="globocycle" class="form_class"><label>GLOBO CYCLE</label>
                <input type="checkbox" name="dragonboat" value="dragonboat" class="form_class"><label>DRAGON BOAT</label>
                <input type="checkbox" name="trx" value="trx" class="form_class"><label>TRX</label>
                <input type="checkbox" name="kickboxing" value="kickboxing" class="form_class"><label>KICKBOXING</label>
                <input type="checkbox" name="globoball" value="globoball" class="form_class"><label>GLOBOBALL</label>
              </div>-->
            <label>TITLE*</label>
            <select name="user_title" class="form_control">
              <option value="mr">Mr</option>
              <option value="mrs">Mrs</option>
              <option value="ms">Ms</option>
              <option value="mx">Mx</option>
              <option value="dr">Dr</option>
            </select>
            <?php echo $user_titleErr; ?>
            <label>FIRSTNAME*</label><input type="text" name="user_fname" class="form_control" size="20" maxlength="30">
            <?php echo $user_fnameErr; ?>
            <label>LASTNAME*</label><input type="text" name="user_lname" class="form_control" size="20" maxlength="30">
            <?php echo $user_lnameErr; ?>
            <label>GENDER*</label>
            <select name="user_gender" class="form_control">
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="unknown">Unknown</option>
            </select>
            <?php echo $user_genderErr; ?>
            <label>DATE OF BIRTH*</label><input type="date" name="user_dob" class="form_control" min="1920-01-01" max="2001-01-01">
            <?php echo $user_dobErr; ?>
            <label>EMAIL ADDRESS*</label>
            <input type="email" name="user_email" class="form_control"/>
            <label>CONFIRM EMAIL*</label>
            <input type="email" name="confirm_user_email" class="form_control"/>
            <?php echo $user_emailErr; ?>
            <label>PASSWORD*</label><input type="password" class="form_control" name="user_pass1" required>
            <label>COMFIRM PASSWORD*</label><input type="password" class="form_control" name="user_pass2" required>
            <label>ADDRESS</label> <input type="text" name="user_address" size="20" maxlength="200" class ="form_control">
            <?php echo $user_addressErr; ?>
            <label>POST CODE</label>
              <select name ="user_pcode" class ="form_control">
                <option value="D1">Dublin 1</option>
                <option value="D2">Dublin 2</option>
                <option value="D3">Dublin 3</option>
                <option value="D4">Dublin 4</option>
                <option value="D5">Dublin 5</option>
                <option value="D6">Dublin 6</option>
                <option value="D7">Dublin 7</option>
                <option value="D8">Dublin 8</option>
                <option value="D9">Dublin 9</option>
                <option value="D10">Dublin 10</option>
                <option value="D11">Dublin 11</option>
                <option value="D12">Dublin 12</option>
                <option value="D13">Dublin 13</option>
                <option value="D14">Dublin 14</option>
                <option value="D15">Dublin 15</option>
                <option value="D16">Dublin 16</option>
                <option value="D17">Dublin 17</option>
                <option value="D18">Dublin 18</option>
                <option value="D19">Dublin 19</option>
                <option value="D20">Dublin 20</option>
                <option value="D21">Dublin 21</option>
                <option value="D22">Dublin 22</option>
                <option value="D23">Dublin 23</option>
                <option value="D24">Dublin 24</option>
              </select>
              <?php echo $user_pcodeErr; ?>
              <label>PHONE NUMBER</label>
              <input type="tel" name="user_phone" placeholder="eg.0861238200" class="form_control"/>
              <?php echo $user_phoneErr; ?>
              <div class="border"></div>
              <label>Do you have any health issues?</label>
              <input type="radio" name="user_health" value="no" class="form_radio"><label class="form_radio">No</label>
              <input type="radio" name="user_health" value="yes" class="form_radio"><label class="form_radio">Yes</label>
              <?php echo $user_healthErr; ?>
              <div class="border"></div>
              <p><label>I allow Globo Gym to send me marketing offers from time to time.</label><input type="checkbox" name="user_marketing" value="yes" class="form_checkbox"></p>
              <p><label>I have read and agreed to the Globo Gym's terms and condition.</label><input type="checkbox" name="user_terms" value="yes" class="form_checkbox"></p>
              <?php echo $user_termsErr; ?>
              <div class="border"></div>
            <input type="submit" name="submit" value="SUBMIT" class="formBtn" required>
          </form>
        </section>
        <footer>
          <div class="footer_detail">
            <h3>GLOBO GYM LIMITED</h3>
            <p>10 Harring Angel Street,Dublin 8<br>Mobile No: 014967876<br>
            Email: globogym@gmail.com<br><br>Registered in Ireland<br>
            Company No . IE555527<br>VAT No. IE1123544OH</p>
          </div>
          <div class="footer_list">
            <h3>QUICK LINKS</h3>
            <ul>
              <li><a href="#">ABOUT US</a></li>
              <li><a href="#">CLASSES</a></li>
              <li><a href="#">CAREERS</a></li>
              <li><a href="#">CONTACT US</a></li>
              <li><a href="#">PRIVACY POLICY</a></li>
              <li><a href="#">TERMS & CONDITIONS</a></li>
            </ul>
          </div>
          <div class="social">
            <h3>SOCIAL MEDIA</h3>
            <a href="#" target="_blank"><img src="img/facebook.png" alt= "facebook logo" class ="social_logo"></a>
            <a href="#" target="_blank"><img src="img/instagram.png" alt= "instagram logo" class ="social_logo"></a>
            <a href="#" target="_blank"><img src="img/youtube.png" alt= "youtube logo" class ="social_logo"></a>
            <a href="#" target="_blank"><img src="img/snapchat.png" alt= "snapcaht logo" class ="social_logo"></a>
          </div>
        </footer>
    <?php }?>
    <?php
      echo "<h2>Your Input:</h2>";
      echo $user_id;
      echo "<br>";
      echo $user_type;
      echo "<br>";
      echo $user_title;
      echo "<br>";
      echo $user_fname;
      echo "<br>";
      echo $user_lname;
      echo "<br>";
      echo $user_gender;
      echo "<br>";
      echo $user_dob;
      echo "<br>";
      echo $user_email;
      echo "<br>";
      echo $user_pass1;
      echo "<br>";
      echo $user_phone;
      echo "<br>";
      echo $user_address;
      echo "<br>";
      echo $user_pcode;
      echo "<br>";
      echo $user_health;
      echo "<br>";
      echo $user_terms;
    ?>
  </body>
</html>
