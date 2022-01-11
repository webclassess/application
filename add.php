<?php
include_once 'database/query.php';
$prod = new Query();

if (isset($_POST['submit'])) {
	
	$resp = $prod->product_query($_POST);
	if ($resp) {
		$_SESSION['success'] = '<div class="alert alert-success text-center">
				  Successfully Inserted!</a>
				</div>';
		header("location:dashboard.php");
	}
	else 
	{	
		echo '<div class="alert alert-danger text-center">
				  Something Wrong! please try again
				</div>';
	}
}

$id = '';
$text = 'Add';
$css = '';
if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
	$text = 'Edit';
	$resp = $prod->get_product($id);
}
elseif (isset($_GET['idv'])) {
	
	$id = $_GET['idv'];
	$text = 'View';
	$css = 'views';
	$resp = $prod->get_product($id);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Usermanagement | <?php echo $text; ?> Product</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <link rel="stylesheet" href="css/style.css">

</head>
<body">
  <div class="wrapper">
    <form class="form-registration <?php echo $css; ?>" action="" method="post" data-toggle="validator" role="form" enctype="multipart/form-data">       
      <h2 class="form-signin-heading pull-left"><?php echo $text; ?> Product here</h2>
	  <a href="dashboard.php" class="btn btn-default pull-right">Back</a>
      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Product name" value="<?php echo isset($resp['name'])? $resp['name'] : ''; ?>" required/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="price" name="price" placeholder="00.00"  onkeypress="return isNumberKeys(this, event);" value="<?php echo isset($resp['price'])? $resp['price'] : ''; ?>" required/>
      </div>
       <div class="form-group">
	   <input type="text" class="form-control" id="upc" name="upc" placeholder="UPC" value="<?php echo isset($resp['upc'])? $resp['upc'] : ''; ?>" required/>
      </div>
       <div class="form-group">
        <select class="form-control" id="status" name="status" required>
			<option value="1" <?php echo (isset($resp['status']) && $resp['status'] == 1)? 'selected' : ''; ?>> Active </option>
			<option value="0"<?php echo (isset($resp['status']) && $resp['status'] == 0)? 'selected' : ''; ?>> Inactive </option>
		</select>
      </div>
      <div class="form-group">
        
		<?php if(!isset($_GET['idv'])){?>
        <input type="file" class="form-control" id="images" name="images">
	   <?php }else{ ?>
	   <img src="<?php echo isset($resp['image'])? 'product_img/'.$resp['image'] : ''; ?>" width="100" height="100">
	   <?php } ?>
      </div>
	  
	  <?php if(!isset($_GET['idv'])){?>
       <div class="form-group">
          <button type="submit" name="submit" value="submit" class="btn btn-success btn-block"><?php echo $text; ?> Product</button>
		  <input type="hidden" name="pId" value="<?php echo $id; ?>">
        </div>
	  <?php } ?>
    </form>
  </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
function isNumberKeys(txt, evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode == 46) {
		//Check if the text already contains the . character
		if (txt.value.indexOf('.') === -1) {
			return true;
		} else {
			return false;
		}
	} else {
		if (charCode > 31
			 && (charCode < 48 || charCode > 57))
			return false;
	}
}
</script>
</body>
</html>