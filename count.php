<?php
include './connect.php';
 $strSQL = "SELECT     LeaveType, COUNT(LeaveType) AS icount
FROM         tblLeaveNew
GROUP BY LeaveType
HAVING      (COUNT(LeaveType) > 0)
 ";
                        $params = array();
                        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                        $query = sqlsrv_query($conn, $strSQL, $params, $options);
                         while ($result = sqlsrv_fetch_array($query)) {
                         echo $result[1];
                             
                         }
?>


