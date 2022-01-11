<?php
include_once 'database/query.php';
$prod = new Query();

if(!isset($_SESSION['STATUS']))
header("location:index.php");

if (isset($_SESSION['success'])) {
	echo $_SESSION['success'];
	unset($_SESSION['success']);
}

$resp = $prod->get_product();

if (isset($_GET['iddl'])) {
	$result = $prod->del_product($_GET['iddl']);
	if ($result) {
		$_SESSION['success'] = '<div class="alert alert-success text-center">
				  Successfully Deleted!</a>
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

if (isset($_POST['groupdelete'])) {
	
	$grpIds = implode(',', $_POST['delinfo']);
	$result = $prod->del_product($grpIds);
	if ($result) {
		$_SESSION['success'] = '<div class="alert alert-success text-center">
				  Successfully Deleted!</a>
				</div>';
		echo 1; die;
	}
	else 
	{	
		echo '<div class="alert alert-danger text-center">
				  Something Wrong! please try again
				</div>';
		echo 0; die;
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
<body>
  <div class="wrapper text-center">
      <div class="container">
		  <div class="row">
			<div class="col-md-12">
			<h1 class="form-signin-heading pull-left"> Welcome To Product List</h1>
			<a href="add.php" class="btn btn-default pull-right">Add Product</a>
				<table class="table text-left bg2">
					<thead>
					<?php if($resp != false) { ?>
					  <tr>
						<th colspan="7" align="right"><button class="btn btn-danger pull-right grp-del">Delete Selected</button></th>
					  </tr>
					<?php }?>
					  <tr>
						<th>#</th>
						<th>Name</th>
						<th>price</th>
						<th>UPC</th>
						<th>Image</th>
						<th>Status</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					<?php if($resp != false) {
						$i= 1;
						while($row = mysqli_fetch_array($resp, MYSQLI_ASSOC)){?>
					  <tr>
						<td><?php echo $i; ?> &nbsp; <input type="checkbox" class="subsId" name="seltProd" value="<?php echo $row['ID']; ?>"></td>
						<td><?php echo isset($row['name'])? $row['name'] : ''; ?></td>
						<td><?php echo isset($row['price'])? $row['price'] : ''; ?></td>
						<td><?php echo isset($row['upc'])? $row['upc'] : ''; ?></td>
						<td><img src="<?php echo isset($row['image'])? 'product_img/'.$row['image'] : ''; ?>" width="100" height="100"></td>
						<td><?php echo !empty($row['status'])? 'Active' : 'Inactive'; ?></td>
						<td><a href="add.php?id=<?php echo $row['ID']; ?>">Edit </a> | <a href="add.php?idv=<?php echo $row['ID']; ?>">View</a> | <a href="?iddl=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure want to delete this?');">Del</a></td>
					  </tr>
					<?php $i++; } }else{ echo '<tr> <td colspan="7" align="center">No found Record!</td></tr>'; }?>
					 </tbody>
				</table>
			</div>
		  </div>
      </div>
      
  </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function(){
	
$('.grp-del').on('click', function(){	
	
	var info = [];
	$('input:checkbox[name=seltProd]:checked').each(function(){
		var ids = $(this).val();
		info.push(ids);
		
	});
	console.log(info);
	
	$.ajax({
        url: "dashboard.php",
        type: "post",
        data: {'groupdelete':1, 'delinfo':info},
        success: function (response) {

          if(response == 1)
		  {
			  window.location.href="dashboard.php";
		  }
		  
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
});

});
</script>
</body>
</html>