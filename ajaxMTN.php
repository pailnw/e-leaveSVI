<?php

session_start();

	$strUser = trim($_POST["UserID"]);

        ini_set('display_errors', 1);
error_reporting(~0);

include './connect.php';
	$strSQL = "SELECT * FROM tblUsers WHERE UserID = '" . $strUser . "' ";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
	if($result)
	{
		echo $result["FirstNameE"]." ".$result["LastNameE"];
	}

	
?>