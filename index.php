<?php
include_once 'database/query.php';
$object = new Query();
$object->create_table(user);
if (isset($_POST['submit'])) {

	$log = $object->user_login($_POST);
	if ($log) {
		header("location:dashboard.php");
	}
	else 
	{	
		echo '<div class="alert alert-danger text-center">
				  <strong> Sorry !</strong>invalid Crediantial
				</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Usermanagement | Log in</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <link rel="stylesheet" href="css/style.css">

</head>
<body">
  <div class="wrapper">
    <form class="form-signin" action="" method="post" data-toggle="validator" role="form">       
      <h2 class="form-signin-heading">Please login</h2>
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required/>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
      </div>
       <div class="form-group">
          <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Sign In</button>
        </div>  
        <div class="form-group">
          <a href="registration.php">Create new account</a>
        </div>
    </form>
  </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>