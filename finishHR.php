<?php

session_start();
//$finish_leave=$_GET["finish_leave"];
 include './connect.php';
$strSQL1 = "SELECT * FROM tblLeaveNew where LeaveStatusID ='7' and LeaveType =71 ";
$query1 = sqlsrv_query($conn, $strSQL1, $params, $options);
 while ($result1 = sqlsrv_fetch_array($query1)) {
     $sumVocationUse =0;
     $strSQL3 = "SELECT * FROM tblUsers where UserID ='".$result1["UserID"]."' ";
     $query3 = sqlsrv_query($conn, $strSQL3, $params, $options);
     $result3 = sqlsrv_fetch_array($query3);
     $sumVocationUse = $result1["SumDays"]+$result3["VocationUse"];
     
     $strUpdate = "update tblUsers set VocationUse = '".$sumVocationUse."' where UserID ='".$result1["UserID"]."'";
     $queryUpdate = sqlsrv_query($conn, $strUpdate, $params, $options);
 }
 

$filName = "eLeave.csv";
$objWrite = fopen("eLeave.csv", "w");
$strSQL2 = "SELECT * FROM tblLeaveNew where LeaveStatusID ='7'";
$query2 = sqlsrv_query($conn, $strSQL2, $params, $options);
//export file .csv
while ($result2 = sqlsrv_fetch_array($query2)) {
    //หยุดเป็นวัน
    //วันที่เริ่ม
    $yearStart = substr($result2[6], 0,4);
    $monthStart = substr($result2[6], 5,2);
    $dayStart = substr($result2[6], 8,2);
    //วันที่สุดท้าย
    $yearEnd = substr($result2[7], 0,4);
    $monthEnd = substr($result2[7], 5,2);
    $dayEnd = substr($result2[7], 8,2);
    //หยุดเป็น ชม.
    //วันที่หยุด
    $timeYear = substr($result2[8], 0,4);
    $timeMonth = substr($result2[8], 5,2);
    $timeDays = substr($result2[8], 8,2);
    //เวลาที่เริ่ม
    $timeHStart = substr($result2[9], 0,2);
    $timeMStart = substr($result2[9], 4,2);
    //เวลาที่สิ้นสุดท้าย
    $timeHEnd = substr($result2[10], 0,2);
    $timeMEnd = substr($result2[10], 4,2);
    
    $result2[15] = new DateTime();
    $result2[15] = $result2[15]->format('Y-m-d H:i:s');
    $result2[19] = new DateTime();
    $result2[19] = $result2[19]->format('Y-m-d H:i:s');
    
    fwrite($objWrite,"$result2[2],$result2[3],$dayStart,");
    fwrite($objWrite,"$monthStart,$yearStart,$dayEnd,");
    fwrite($objWrite,"$monthEnd,$yearEnd,$timeDays,");
    fwrite($objWrite,"$timeMonth,$timeYear,$timeDays,");
    fwrite($objWrite,"$timeMonth,$timeYear,$timeHStart,");
    fwrite($objWrite,"$timeMStart,$timeHEnd,$timeMEnd,");
    fwrite($objWrite,"$result2[12],$result2[13]\n");

}
fclose($objWrite);
if (file_exists($filName)) {
  header("Location:$filName");


}


$strSQL = "update tblLeaveNew set LeaveStatusID = '8' ,LastEditUser = '" . $_SESSION["UserID"] . "',LastEditDate = getdate()where LeaveStatusID = '7'  ";

$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
$row = sqlsrv_rows_affected($query);


if ($row > 0) {
    echo "<script language='javascript'>alert('Cancel Leave Fail.');
		window.location='HR_VLeave.php'</script>";
} else {


  
}

?>
