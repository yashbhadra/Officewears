<?php
	
	$db_server="localhost";
	$db_name="Officewears_db";
	$db_user="root";
	$db_pw="";
	

	$link=mysqli_connect($db_server,$db_user,$db_pw,$db_name);

	if(!$link)
	{
		die("Connection Failed <br>" . mysqli_connect_error());
	}
	

	mysqli_set_charset($link,"utf8");
	mysqli_select_db($link,"Officewears_db");
	

?>