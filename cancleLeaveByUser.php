<?php
session_start();
$del_leave=$_GET["del_leave"];
include './connect.php';

$strSQL = "update tblLeaveNew set LeaveStatusID = '1',LastEditUser = '".$_SESSION["UserID"]."',LastEditDate = getdate() where LeaveID ='" . $del_leave . "' ";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
$row = sqlsrv_rows_affected($query);
        if($row>0){
            echo "<script language='javascript'>alert('Cancel Leave Fail.');
		window.location='V_Leave.php'</script>";
            
        }else{    echo "<script language='javascript'>alert('Cancel Leave Sucess.');
		window.location='V_Leave.php'</script>";}
?>

