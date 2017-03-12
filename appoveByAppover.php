<?php
session_start();
$appove_id=$_GET["appove_id"];
include './connect.php';

$strSQL = "update tblLeaveNew set LeaveStatusID = '7',LastEditUser = '".$_SESSION["UserID"]."',LastEditDate = getdate() where LeaveID ='" . $appove_id . "' ";

$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
$row = sqlsrv_rows_affected($query);
        if($row>0){
            echo "<script language='javascript'>alert('Appove Leave Fail.');
		window.location='V_LeaveAppover.php'</script>";
            
        }else{    echo "<script language='javascript'>alert('Appove Leave Sucess.');
		window.location='V_LeaveAppover.php'</script>";}
?>