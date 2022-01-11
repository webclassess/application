<?php
include_once 'database/query.php';
$user = new Query();

if (isset($_POST['submit'])) {

	$reg = $user->user_registration($_POST);
	if ($reg) {
		echo '<div class="alert alert-success text-center">
				  <strong>Registration Success! </strong> <a href="index.php">Please login here</a>
				</div>';
	}
	else 
	{	
		echo '<div class="alert alert-danger text-center">
				  <strong> Sorry !</strong> Failed Registration
				</div>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Usermanagement | Registration</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <link rel="stylesheet" href="css/style.css">

</head>
<body">
  <div class="wrapper">
    <form class="form-registration" action="" method="post" data-toggle="validator" role="form">       
      <h2 class="form-signin-heading">Registration here</h2>
      <div class="form-group">
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full name" required/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="username" required/>
      </div>
       <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
      </div>
       <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email id" data-error="Invalid email id" required/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="location" name="location" placeholder="Location">
      </div>
       <div class="form-group">
          <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Sign Up</button>
        </div>
    </form>
  </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>