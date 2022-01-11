<?php
session_start();
include_once 'config.php';
define('user','tb_user');

class Query extends Config {

	public $module = 'Query';
	
	public function __construct()
	{
        parent::__construct();	
	}
	
	
	public function user_registration($data)
	{
		
		extract($data);
		
		$sql = "INSERT INTO ".user."(full_name, user_name, user_password, user_email, user_location)VALUES ('".$fullname."', '".$username."', '".$password."', '".$email."', '".$location."')";
		
		if (mysqli_query($this->con, $sql)) 
		{
              return true;
        } 
		else 
		{
		   return false;
		}
		
	}
	
	public function user_login($data)
	{
		
		extract($data);
		
		$sql = "SELECT user_id from ".user." WHERE (user_name='$username' or user_email='$username') and user_password='$password'";
		
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);

		if (mysqli_num_rows($query) > 0)
		{
              $_SESSION['STATUS'] = 'LOGED';
			  return true;
        } 
		else 
		{
		   return false;
		}
		
	}
	
	public function product_query($data)
	{
		extract($data);
		
        $strPath = "product_img/";
		if(!file_exists($strPath))
		mkdir($strPath , 0777, true);
		
		$filename = '';
		if(!empty($_FILES["images"]["name"]))
		{
			$filename = time().$_FILES["images"]["name"];
			$tempname = $_FILES["images"]["tmp_name"];
			
			$strPath .= $filename;
		}
		
		$sql = "INSERT INTO tbl_product(name, price, upc, status, image)VALUES ('".$name."', '".$price."', '".$upc."', '".$status."', '".$filename."')";
		
		/**
		* For edit
		*/
		if(!empty($pId))
		{
			$sql = "UPDATE tbl_product SET name= '$name', price= '$price', upc= '$upc', status= $status";
			if(!empty($_FILES["images"]["name"]))
			{
				$sql .= ", image= '$filename'";
			}
			$sql .= " where ID= $pId";
		}
		
		if (mysqli_query($this->con, $sql)) 
		{
			if(!empty($_FILES["images"]["name"]))
			{
				move_uploaded_file($tempname, $strPath);
			}
			 return true;
        } 
		else 
		{
		   return false;
		}
		
	}
	
	public function get_product($id='')
	{
		
		$sql = "select * from tbl_product";
		
		if(!empty($id))
			$sql .= " where ID = $id";
		
		
		
		$result = mysqli_query($this->con, $sql);
		
		$response = $result;
		
		if(!empty($id))
			$response = mysqli_fetch_assoc($result);
		
		
		if(mysqli_num_rows($result) > 0)
			return $response;
		else
			return false;
		
	}
	
	public function del_product($id='')
	{
		
		$sql = "delete from tbl_product where ID IN($id)";
		
		if(mysqli_query($this->con, $sql))
			return true;
		else
			return false;
		
	}
	
	
}
