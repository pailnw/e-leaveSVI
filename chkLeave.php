<?php

session_start();
include './connect.php';
$strSQL = "SELECT * FROM tblLeaveNew";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);

//รับค่า
$leaveType = $_POST["leaveType"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$reson = $_POST["reson"];
$date = $_POST["startDate1"];
$time_a = $_POST["time1"];
$time_b = $_POST["time2"];
$leaveApove = $_POST["leaveApove"];

if($startDate!="" && $endDate!=""){
//ปิดรับค่า
//สร้างรหัส Leave ID
$strSQL1 = "select ROW_NUMBER() OVER(ORDER BY keyname DESC) AS keyname,Year,Month,Amount from MasterCode";
$params1 = array();
$options1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$query1 = sqlsrv_query($conn, $strSQL1, $params1, $options1) or die("Error Query [" . $strSQL1 . "]");
$result1 = sqlsrv_fetch_array($query1);
if ($result1["Year"] == date("y") && $result1["Month"] == date("m")) {
    $Seq = substr("0000" . $result1["Amount"], -4, 4);   //*** Replace Zero Fill ***//
    $strNextSeq = $result1["Year"] . $result1["Month"] . $Seq;
    //*** Update Next Seq ***//
    $strSQL2 = "UPDATE MasterCode SET Amount= Amount+1 ";
    $query2 = sqlsrv_query($conn, $strSQL2, $params1, $options1) or die("Error Query [" . $strSQL2 . "]");
} else {  //*** Check val != year now ***//
    $Seq = substr("0001" . $result1["Amount"], -4, 4);   //*** Replace Zero Fill ***//

    $strNextSeq = date("y") . date("m") . $Seq;
    //*** Update New Seq ***//
    $strSQL2 = "INSERT INTO MasterCode(Year,Month,Amount) Values ('" . date("y") . "','" . date("m") . "',2)";
    $query2 = sqlsrv_query($conn, $strSQL2, $params1, $options1) or die("Error Query [" . $strSQL2 . "]");
}

//ปิดสร้าง Leave ID
//คำนวณจำนวนวัน
function timespan($seconds = 1, $time = 1) {
    if (!is_numeric($seconds)) {
        $seconds = 1;
    }
    if (!is_numeric($time)) {
        $time = 1;
    }
    if ($time <= $seconds) {
        $seconds = 1;
    } else {
        $seconds = $time - $seconds;
    }
    $str = '';
    $days = floor($seconds / 86400);
    if ($days > 0) {
        if ($days > 0) {
            $str .= $days . ',';
        }
        $seconds -= $days * 86400;
    }
    return substr(trim($str), 0, -1);
}

$birthdate = strtotime($startDate);
$today = strtotime($endDate);
$sumday = timespan($birthdate, $today);
if($sumday=="" && $time_a =="" && $time_b == "" && $startDate=="" && $endDate ==""){
    echo "<script language='javascript'>alert('Data incorrect!');
		window.location='RF_Leave.php'</script>";
    
}else{
//ปิดคำนวณวัน
//คำนวณเวลาหน่วยชั่วโมง/นาที
$now_time1 = strtotime(date("Y-m-d " . $time_a));
$now_time2 = strtotime(date("Y-m-d " . $time_b));
$time_diff = abs($now_time2 - $now_time1);
$time_diff_h = floor($time_diff / 3600); //ชั่วโมง
$time_diff_m = floor(($time_diff % 3600) / 60); //นาที
//ปิดคำนวณเวลาหน่วยชั่วโมง/นาที
//เช็คจำนวนวันลาพักร้อน    
$sumVocation = $_SESSION["VocationUse"] + $sumday;

if ($leaveType == 71) {

    if ($sumVocation > $_SESSION["Vocation"]) {

        echo "<script language='javascript'>alert('วันลาพักร้อนของคุณหมดแล้ว!/You are out of your vacation!');
		window.location='RF_Leave.php'</script>";
    }else{      $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'1','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); 
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        
            echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
        }
        
    }
} else if ($startDate == $endDate && $date == "") {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'1','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); 
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        
            echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
        }

} else if ($startDate != $endDate) {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays      
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate
           )
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'" . $sumday . "' ,'" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); // or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
   }
} else if ($startDate == $endDate && $date != "") {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,DateTime
      ,TimeStart
      ,TimeEnd
      ,SumHours
      ,SumMinute
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate )
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $date . "' ,'" . $time_a . "' ,'" . $time_b . "' , '" . $time_diff_h . "' , '" . $time_diff_m . "','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); // or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
    }
} else {
//บันทึกข้อมูล
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,DateTime
      ,TimeStart
      ,TimeEnd
      ,SumDays
      ,SumHours
      ,SumMinute
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'" . $date . "' ,'" . $time_a . "' ,'" . $time_b . "' ,'" . $sumday . "' , '" . $time_diff_h . "' , '" . $time_diff_m . "','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); //or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
    }
} }
}else if($date !=""){
    //สร้างรหัส Leave ID
$strSQL1 = "select ROW_NUMBER() OVER(ORDER BY keyname DESC) AS keyname,Year,Month,Amount from MasterCode";
$params1 = array();
$options1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$query1 = sqlsrv_query($conn, $strSQL1, $params1, $options1) or die("Error Query [" . $strSQL1 . "]");
$result1 = sqlsrv_fetch_array($query1);
if ($result1["Year"] == date("y") && $result1["Month"] == date("m")) {
    $Seq = substr("0000" . $result1["Amount"], -4, 4);   //*** Replace Zero Fill ***//
    $strNextSeq = $result1["Year"] . $result1["Month"] . $Seq;
    //*** Update Next Seq ***//
    $strSQL2 = "UPDATE MasterCode SET Amount= Amount+1 ";
    $query2 = sqlsrv_query($conn, $strSQL2, $params1, $options1) or die("Error Query [" . $strSQL2 . "]");
} else {  //*** Check val != year now ***//
    $Seq = substr("0001" . $result1["Amount"], -4, 4);   //*** Replace Zero Fill ***//

    $strNextSeq = date("y") . date("m") . $Seq;
    //*** Update New Seq ***//
    $strSQL2 = "INSERT INTO MasterCode(Year,Month,Amount) Values ('" . date("y") . "','" . date("m") . "',2)";
    $query2 = sqlsrv_query($conn, $strSQL2, $params1, $options1) or die("Error Query [" . $strSQL2 . "]");
}

//ปิดสร้าง Leave ID
//คำนวณจำนวนวัน
function timespan($seconds = 1, $time = 1) {
    if (!is_numeric($seconds)) {
        $seconds = 1;
    }
    if (!is_numeric($time)) {
        $time = 1;
    }
    if ($time <= $seconds) {
        $seconds = 1;
    } else {
        $seconds = $time - $seconds;
    }
    $str = '';
    $days = floor($seconds / 86400);
    if ($days > 0) {
        if ($days > 0) {
            $str .= $days . ',';
        }
        $seconds -= $days * 86400;
    }
    return substr(trim($str), 0, -1);
}

$birthdate = strtotime($startDate);
$today = strtotime($endDate);
$sumday = timespan($birthdate, $today);
if($sumday=="" && $time_a =="" && $time_b == "" && $startDate=="" && $endDate ==""){
    echo "<script language='javascript'>alert('Data incorrect!');
		window.location='RF_Leave.php'</script>";
    
}else{
//ปิดคำนวณวัน
//คำนวณเวลาหน่วยชั่วโมง/นาที
$now_time1 = strtotime(date("Y-m-d " . $time_a));
$now_time2 = strtotime(date("Y-m-d " . $time_b));
$time_diff = abs($now_time2 - $now_time1);
$time_diff_h = floor($time_diff / 3600); //ชั่วโมง
$time_diff_m = floor(($time_diff % 3600) / 60); //นาที
//ปิดคำนวณเวลาหน่วยชั่วโมง/นาที
//เช็คจำนวนวันลาพักร้อน    
$sumVocation = $_SESSION["VocationUse"] + $sumday;

if ($leaveType == 71) {

    if ($sumVocation > $_SESSION["Vocation"]) {

        echo "<script language='javascript'>alert('วันลาพักร้อนของคุณหมดแล้ว!/You are out of your vacation!');
		window.location='RF_Leave.php'</script>";
    }else{      $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'1','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); 
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        
            echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
        }
        
    }
} else if ($startDate == $endDate && $date == "") {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'1','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); 
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        
            echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
        }
    
} else if ($startDate != $endDate) {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,SumDays      
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate
           )
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'" . $sumday . "' ,'" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); // or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
   }
} else if ($startDate == $endDate && $date != "") {
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,DateTime
      ,TimeStart
      ,TimeEnd
      ,SumHours
      ,SumMinute
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate )
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $date . "' ,'" . $time_a . "' ,'" . $time_b . "' ,'" . $time_diff_h . "' , '" . $time_diff_m . "','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); // or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
    }
} else {
//บันทึกข้อมูล
    $insertLeave = "INSERT INTO tblLeaveNew(LeaveID
      ,LeaveStatusID
      ,UserID
      ,LeaveType
      ,Reson
      ,Approver
      ,StartDate
      ,EndDate
      ,DateTime
      ,TimeStart
      ,TimeEnd
      ,SumDays
      ,SumHours
      ,SumMinute
      ,CreateUser
      ,CreateDate
      ,LastEditUser
      ,LastEditDate)
VALUES ('" . $strNextSeq . "' , '2' , '" . $_SESSION["UserID"] . "','" . $leaveType . "','" . $reson . "','" . $leaveApove . "' , '" . $startDate . "' ,'" . $endDate . "' ,'" . $date . "' ,'" . $time_a . "' ,'" . $time_b . "' ,'" . $sumday . "' , '" . $time_diff_h . "' , '" . $time_diff_m . "','" . $_SESSION["UserID"] . "', getdate(),'" . $_SESSION["UserID"] . "',getdate())";
    $query1 = sqlsrv_query($conn, $insertLeave, $params, $options); //or die("Error Query [" . $insertLeave . "]");
    $numrow = sqlsrv_num_rows($query1);
    if ($numrow > 0) {
        echo "<script language='javascript'>alert('ส่งคำขอสำเร็จ/Request successful!');
		window.location='Main.php'</script>";
    }
}
} 
}else {
    
    echo "<script language='javascript'>alert('กรุณากรอกข้อมูลให้ครบ!');
		window.location='RF_Leave.php'</script>";
}
?>


