<?php

session_start();
include './connect.php';
$strSQL = "update tblUsers set Password = '123456' where UserID ='" . $useridPass . "' ";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
$row = sqlsrv_rows_affected($query);
        if($row>0){
            echo "<script language='javascript'>alert('Reset Password Fail');
		window.location='MTN.php'</script>";
            
        }else{    echo "<script language='javascript'>alert('Reset Password Sucess.');
		window.location='MTN.php'</script>";}
?>

