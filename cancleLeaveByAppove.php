<?php
session_start();
$cancle_leave=$_GET["cancle_leave"];
include './connect.php';

$strSQL = "update tblLeaveNew set LeaveStatusID = '3',LastEditUser = '".$_SESSION["UserID"]."',LastEditDate = getdate() where LeaveID ='" . $cancle_leave . "' ";

$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
$row = sqlsrv_rows_affected($query);
        if($row>0){
            echo "<script language='javascript'>alert('Cancel Leave Fail');
		window.location='V_LeaveAppover.php'</script>";
            
        }else{    echo "<script language='javascript'>alert('Cancel Leave Sucess.');
		window.location='V_LeaveAppover.php'</script>";}
?>
