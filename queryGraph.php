<?php

include './connect.php';
$yearsLeave = $_POST["A2"];
$montsLeave = $_POST["A1"];
$departmentLeave = $_POST["A3"];
$sqlUser = "SELECT * FROM tblUsers where Department='" . $departmentLeave . "' ";
$query = sqlsrv_query($conn, $sqlUser, $params, $options);
while ($result = sqlsrv_fetch_array($query)) {

    $sqlLeavenew1 = "SELECT * FROM tblLeaveNew where 
UserID='" . $result[0] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='01' and MONTH(StartDate)= '" . $montsLeave . "'
or UserID = '" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='01' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew1 = sqlsrv_query($conn, $sqlLeavenew1, $params, $options);
    while ($resultLeavenew1 = sqlsrv_fetch_array($queryLeavenew1)) {
        $row1 = sqlsrv_num_rows($queryLeavenew1);
    }

    $sqlLeavenew2 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='02' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='02' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew2 = sqlsrv_query($conn, $sqlLeavenew2, $params, $options);
    while ($resultLeavenew2 = sqlsrv_fetch_array($queryLeavenew2)) {
        $row2 = sqlsrv_num_rows($queryLeavenew2);
    }
//
    $sqlLeavenew3 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='03' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='03' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew3 = sqlsrv_query($conn, $sqlLeavenew3, $params, $options);
    while ($resultLeavenew3 = sqlsrv_fetch_array($queryLeavenew3)) {
        $row3 = sqlsrv_num_rows($queryLeavenew3);
    }
//
    $sqlLeavenew4 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='04' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='04' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew4 = sqlsrv_query($conn, $sqlLeavenew4, $params, $options);
    while ($resultLeavenew4 = sqlsrv_fetch_array($queryLeavenew4)) {
        $row4 = sqlsrv_num_rows($queryLeavenew4);
    }

//
    $sqlLeavenew5 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='05' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='05' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew5 = sqlsrv_query($conn, $sqlLeavenew5, $params, $options);
    while ($resultLeavenew5 = sqlsrv_fetch_array($queryLeavenew5)) {
        $row5 = sqlsrv_num_rows($queryLeavenew5);
    }
//
    $sqlLeavenew6 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='06' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='06' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew6 = sqlsrv_query($conn, $sqlLeavenew6, $params, $options);
    while ($resultLeavenew6 = sqlsrv_fetch_array($queryLeavenew6)) {
        $row6 = sqlsrv_num_rows($queryLeavenew6);
    }
//
    $sqlLeavenew21 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='21' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='21' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew21 = sqlsrv_query($conn, $sqlLeavenew21, $params, $options);
    while ($resultLeavenew21 = sqlsrv_fetch_array($queryLeavenew21)) {
        $row21 = sqlsrv_num_rows($queryLeavenew21);
    }
//
    $sqlLeavenew22 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='22' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='22' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew22 = sqlsrv_query($conn, $sqlLeavenew22, $params, $options);
    while ($resultLeavenew22 = sqlsrv_fetch_array($queryLeavenew22)) {
        $row22 = sqlsrv_num_rows($queryLeavenew22);
    }

//
    $sqlLeavenew23 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='23' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='23' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew23 = sqlsrv_query($conn, $sqlLeavenew23, $params, $options);
    while ($resultLeavenew23 = sqlsrv_fetch_array($queryLeavenew23)) {
        $row23 = sqlsrv_num_rows($queryLeavenew23);
    }
//
    $sqlLeavenew24 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='24' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='24' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew24 = sqlsrv_query($conn, $sqlLeavenew2, $params, $options);
    while ($resultLeavenew24 = sqlsrv_fetch_array($queryLeavenew24)) {
        $row24 = sqlsrv_num_rows($queryLeavenew24);
    }
//
    $sqlLeavenew25 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='25' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='25' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew25 = sqlsrv_query($conn, $sqlLeavenew25, $params, $options);
    while ($resultLeavenew25 = sqlsrv_fetch_array($queryLeavenew25)) {
        $row25 = sqlsrv_num_rows($queryLeavenew25);
    }
//
    $sqlLeavenew26 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='26' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='26' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew26 = sqlsrv_query($conn, $sqlLeavenew26, $params, $options);
    while ($resultLeavenew26 = sqlsrv_fetch_array($queryLeavenew26)) {
        $row26 = sqlsrv_num_rows($queryLeavenew26);
    }
//
    $sqlLeavenew27 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='27' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='27' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew27 = sqlsrv_query($conn, $sqlLeavenew27, $params, $options);
    while ($resultLeavenew27 = sqlsrv_fetch_array($queryLeavenew27)) {
        $row27 = sqlsrv_num_rows($queryLeavenew27);
    }
//
    $sqlLeavenew28_1 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='28-1' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='28-1' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew28_1 = sqlsrv_query($conn, $sqlLeavenew28_1, $params, $options);
    while ($resultLeavenew28_1 = sqlsrv_fetch_array($queryLeavenew28_1)) {
        $row28_1 = sqlsrv_num_rows($queryLeavenew28_1);
    }
//
    $sqlLeavenew28 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='28' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='28' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew28 = sqlsrv_query($conn, $sqlLeavenew28, $params, $options);
    while ($resultLeavenew28 = sqlsrv_fetch_array($queryLeavenew28)) {
        $row28 = sqlsrv_num_rows($queryLeavenew28);
    }
//
    $sqlLeavenew71 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='71' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='71' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew71 = sqlsrv_query($conn, $sqlLeavenew71, $params, $options);
    while ($resultLeavenew71 = sqlsrv_fetch_array($queryLeavenew71)) {
        $row71 = sqlsrv_num_rows($queryLeavenew71);
    }
//
    $sqlLeavenew72 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='72' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='72' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew72 = sqlsrv_query($conn, $sqlLeavenew72, $params, $options);
    while ($resultLeavenew72 = sqlsrv_fetch_array($queryLeavenew72)) {
        $row72 = sqlsrv_num_rows($queryLeavenew72);
    }

//
    $sqlLeavenew2 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='73' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='73' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew73 = sqlsrv_query($conn, $sqlLeavenew2, $params, $options);
    while ($resultLeavenew73 = sqlsrv_fetch_array($queryLeavenew73)) {
        $row73 = sqlsrv_num_rows($queryLeavenew73);
    }
//
    $sqlLeavenew74 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='74' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='74' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew74 = sqlsrv_query($conn, $sqlLeavenew74, $params, $options);
    while ($resultLeavenew74 = sqlsrv_fetch_array($queryLeavenew74)) {
        $row74 = sqlsrv_num_rows($queryLeavenew74);
    }
//
    $sqlLeavenew75 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='75' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='75' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew75 = sqlsrv_query($conn, $sqlLeavenew75, $params, $options);
    while ( $resultLeavenew75 = sqlsrv_fetch_array($queryLeavenew75)) {
        $row75 = sqlsrv_num_rows($queryLeavenew75);
    }
//
    $sqlLeavenew76 = "SELECT * FROM tblLeaveNew where 
      UserID='" . $result["EmployeeID"] . "' and  LeaveStatusID='8' and YEAR(StartDate)='" . $yearsLeave . "' and LeaveType ='76' and MONTH(StartDate)= '" . $montsLeave . "'
       or UserID='" . $result["EmployeeID"] . "' and LeaveStatusID='8' and YEAR(DateTime)='" . $yearsLeave . "' and LeaveType ='76' and MONTH(DateTime)= '" . $montsLeave . "' ";
    $queryLeavenew76 = sqlsrv_query($conn, $sqlLeavenew76, $params, $options);
    while ($resultLeavenew76 = sqlsrv_fetch_array($queryLeavenew76)) {
        $row76 = sqlsrv_num_rows($queryLeavenew76);
    }
}
if (!isset($row1) || $row1 == "") {
    $row1 = 0;
} else {
    $row1;
}
if (!isset($row2) || $row2 == "") {
    $row2 = 0;
} else {
    $row2;
}
if (!isset($row3) || $row3 == "") {
    $row3 = 0;
} else {
    $row3;
}
if (!isset($row4) || $row4 == "") {
    $row4 = 0;
} else {
    $row4;
}
if (!isset($row5) || $row5 == "") {
    $row5 = 0;
} else {
    $row5;
}
if (!isset($row6) || $row6 == "") {
    $row6 = 0;
} else {
    $row6;
}
if (!isset($row21) || $row21 == "") {
    $row21 = 0;
} else {
    $row21;
}
if (!isset($row22) || $row22 == "") {
    $row22 = 0;
} else {
    $row22;
}
if (!isset($row23) || $row23 == "") {
    $row23 = 0;
} else {
    $row23;
}if (!isset($row24) || $row24 == "") {
    $row24 = 0;
} else {
    $row24;
}if (!isset($row25) || $row25 == "") {
    $row25 = 0;
} else {
    $row25;
}
if (!isset($row26) || $row26 == "") {
    $row26 = 0;
} else {
    $row26;
}
if (!isset($row27) || $row27 == "") {
    $row27 = 0;
} else {
    $row27;
}
if (!isset($row28_1) || $row28_1 == "") {
    $row28_1 = 0;
} else {
    $row28_1;
}
if (!isset($row28) || $row28 == "") {
    $row28 = 0;
} else {
    $row28;
}
if (!isset($row71) || $row71 == "") {
    $row71 = 0;
} else {
    $row71;
}
if (!isset($row72) || $row72 == "") {
    $row72 = 0;
} else {
    $row72;
}
if (!isset($row73) || $row73 == "") {
    $row73 = 0;
} else {
    $row73;
}
if (!isset($row74) || $row74 == "") {
    $row74 = 0;
} else {
    $row74;
}
if (!isset($row75) || $row75 == "") {
    $row75 = 0;
} else {
    $row75;
}
if (!isset($row76) || $row76 == "") {
    $row76 = 0;
} else {
    $row76;
}

$totalrow = ($row1 + $row2 + $row3 + $row4 + $row5 + $row6) + ($row21 + $row22 + $row23 + $row24 + $row25 + $row26 + $row27 + $row28_1 + $row28) + ($row71 + $row72 + $row73 + $row74 + $row75 + $row76);
if ($totalrow != 0) {
    $sum1 = ($row1 / $totalrow) * 200;
    $sum2 = ($row2 / $totalrow) * 200;
    $sum3 = ($row3 / $totalrow) * 200;
    $sum4 = ($row4 / $totalrow) * 200;
    $sum5 = ($row5 / $totalrow) * 200;
    $sum6 = ($row6 / $totalrow) * 200;

    $sum21 = ($row21 / $totalrow) * 200;
    $sum22 = ($row22 / $totalrow) * 200;
    $sum23 = ($row23 / $totalrow) * 200;
    $sum24 = ($row24 / $totalrow) * 200;
    $sum25 = ($row25 / $totalrow) * 200;
    $sum26 = ($row26 / $totalrow) * 200;
    $sum27 = ($row27 / $totalrow) * 200;
    $sum28_1 = ($row28_1 / $totalrow) * 200;
    $sum28 = ($row28 / $totalrow) * 200;

    $sum71 = ($row71 / $totalrow) * 200;
    $sum72 = ($row72 / $totalrow) * 200;
    $sum73 = ($row73 / $totalrow) * 200;
    $sum74 = ($row74 / $totalrow) * 200;
    $sum75 = ($row75 / $totalrow) * 200;
    $sum76 = ($row76 / $totalrow) * 200;
} else {
    $sum1 = 0;
    $sum2 = 0;
    $sum3 = 0;
    $sum4 = 0;
    $sum5 = 0;
    $sum6 = 0;

    $sum21 = 0;
    $sum22 = 0;
    $sum23 = 0;
    $sum24 = 0;
    $sum25 = 0;
    $sum26 = 0;
    $sum27 = 0;
    $sum28_1 = 0;
    $sum28 = 0;

    $sum71 = 0;
    $sum72 = 0;
    $sum73 = 0;
    $sum74 = 0;
    $sum75 = 0;
    $sum76 = 0;
}
?>