<?php

class Config{

	public $host = 'localhost';
	public $root = 'root';
	public $password = '';
	public $database = 'Usermanagement';
	public $product = 'Usermanagement';
	
	public function __construct()
	{
		$this->con = mysqli_connect($this->host, $this->root, $this->password);
		if(!$this->con)
		{
			die("Error!: Database has been not established.");
		}

		$this->create_database($this->host, $this->root, $this->password, $this->database);
	}
	
	/**
	* Create Tables list.
	*/
	public function create_database($host, $root, $password, $database)
	{
		$sql = "CREATE DATABASE IF NOT EXISTS $this->database";         
         if(!mysqli_query($this->con, $sql))		  
		 {
            echo "Error creating database: " . mysqli_error($this->con); die();
         }
		 mysqli_select_db($this->con,$this->database);
	}
	
	public function create_table($table_name)
	{
	    
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
				  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `full_name` varchar(191) NOT NULL,
				  `user_name` varchar(191) NOT NULL,
				  `user_password` varchar(255) NOT NULL,
				  `user_email` varchar(255) NOT NULL,
				  `user_location` varchar(255),
				  PRIMARY KEY(user_id)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(!mysqli_query($this->con, $sql))		  
		
		 {
            echo "Error creating table: " . mysqli_error($this->con); die();
         }else{
			 
			 $sql = "CREATE TABLE IF NOT EXISTS tbl_product (
				  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
				  `name` varchar(191) NOT NULL,
				  `price` double(10,2) NOT NULL,
				  `upc` varchar(255) NULL,
				  `status` int(1) NOT NULL DEFAULT 1,
				  `image` text NULL,
				  PRIMARY KEY(ID)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			mysqli_query($this->con, $sql);
		 }
	}
	
	
	
}
