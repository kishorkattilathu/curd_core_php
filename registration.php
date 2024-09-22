<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Registration :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="reg-w3">
<div class="w3layouts-main">
	<h2>Register Now</h2>
		<form  method="post">
			<input type="text" class="ggg" name="name" placeholder="NAME" required="">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<input type="password" class="ggg" name="confirm_password" placeholder="Confirm Password" required="">
				<div class="clearfix"></div>
				<input type="submit" value="submit" name="register">
		</form>
		<p>Already Registered.<a href="login.php">Login</a></p>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>

<?php 
	
	include ('connect.php');

	if (isset($_POST['register'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		function validate_name($name) {
		    if (empty($name)) {
		        return "Name is required.";
		    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
		        echo"<script>alert('Name can only contain letters and spaces.')</script>";
		    }
		    return true;
		}

		function validate_email($email) {
		    if (empty($email)) {
		        return "Email is required.";
		    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		        echo"<script>alert(Invalid email format.')</script>";
		    }
		    return true;
		}

		function validate_password($password) {
		    if (empty($password)) {
		        return "Password is required.";
		    } elseif (strlen($password) < 6) {
		        echo"<script>alert('Password must be at least 6 characters long.')</script>";
		    } 
		    return true;
		}

		$name_validation = validate_name($name);
		$email_validation = validate_email($email);
		$password_validation = validate_password($password);

		if ($name_validation === true && $email_validation === true && $password_validation === true) {
		    // Validation passed, you can proceed with further actions (e.g., saving to the database)
			$hashpassword = password_hash($password,PASSWORD_DEFAULT);

		   $email_check = " SELECT * from users where email = '$email'";
			$execute = mysqli_query($connect,$email_check);
			$count = mysqli_num_rows($execute);
			if ($count == 0) {
				if ($password == $confirm_password) {
						$insert = "INSERT INTO users (name,email,password)values('$name','$email','$hashpassword')";
						$created = mysqli_query($connect,$insert);
						if ($created) {
								echo"<script>alert('Successfully Registered')</script>";
								echo"<script>window.location.href = 'login.php'</script>";
						}else{
							echo"<script>alert('Failed try again')</script>";
							echo"<script>window.location.href = 'registration.php'</script>";
						}
				}else{
					echo"<script>alert('Password Does not match')</script>";
					echo"<script>window.location.href = 'registration.php'</script>";
				}
			}else{
				echo"<script>alert('Email already exist')</script>";
				echo"<script>window.location.href = 'registration.php'</script>";
			}
		} else {
		    // Display validation errors
		    echo $name_validation !== true ? $name_validation . "<br>" : '';
		    echo $email_validation !== true ? $email_validation . "<br>" : '';
		    echo $password_validation !== true ? $password_validation . "<br>" : '';
		}
	}
?>
