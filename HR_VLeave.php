<!DOCTYPE HTML>
<?php
session_start();
if(@$_SESSION["UserID"]==""){
    echo "<script language='javascript'>alert('Please login!!');
		window.location='Login.html'</script>";
}else{
?>
<html>
    <head>	
        <title>e-Leave System</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/datetimepicker.css"/>
        <link rel="stylesheet" href="css/style-table.css"/>
        <link href="images/icon.png" rel="shortcut icon" type="image/x-icon" />
        <style type="text/css">
            .custom-date-style {
                background-color: red !important;
            }
        </style>
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/util.js"></script>
        <script src="js/main.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.datetimepicker.js"></script>
        <script language="JavaScript">
            function updateStatus() {

                window.location = "finishHR.php";
            }

        </script>
        <style type="text/css"> 
            .test
            {
                white-space:nowrap; 
                width:180px; 
                overflow:hidden;
                text-overflow:ellipsis;
            }
        </style>
    </head>
    <body class="subpage">
        <header id="header">
            <div class="inner">
                <?php include './BTNhome.php';?>
                <nav id="nav">
                    <a href="Profile.php"><?php echo $_SESSION["FirstNameE"] ?> <?php echo $_SESSION["LastNameE"]; ?></a>
                    <a href="ChangPassWord.php">Change Password</a>
                    <a href="logout.php">Logout</a>
                </nav>
                <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
            </div>
        </header>

        <!-- Footer -->

        <footer id="footer">

            <h2>HR View Leave</h2>
                        
            <?php
            include './connect.php';
            $strSQL = "SELECT * FROM tblLeaveNew where LeaveStatusID ='7'";
            $query = sqlsrv_query($conn, $strSQL, $params, $options);

            $result = sqlsrv_fetch_array($query);
            //ตาราง User
            $strUser = "SELECT * FROM tblUsers where EmployeeID ='" . $result[2] . "'";
            $query2 = sqlsrv_query($conn, $strUser, $params, $options);
            $resultUser = sqlsrv_fetch_array($query2);
            $datetime = @$result[15]->format('Y-m-d');
            //ตารางประเภทการลา
            $strLeave = "SELECT * FROM tblLeaveType where TypeID ='" . $result[3] . "'";
            $query3 = sqlsrv_query($conn, $strLeave, $params, $options);
            $resultLeave = sqlsrv_fetch_array($query3);
            //ตารางสเตตัส
            $strStatus = "SELECT * FROM tblLeaveStatus where LeaveStatusID ='" . $result[1] . "'";
            $query4 = sqlsrv_query($conn, $strStatus, $params, $options);
            $resultStatus = sqlsrv_fetch_array($query4);
            ?>
            <!-- ค้นหารหัสใบลา -->
            <div class="inner">
            <form  method="post" action="HR_VLeave1.php">              
                <input name="leaveID" type="text" id="leaveID" size="20" value="<?php echo @$_POST["leaveID"]; ?>" /><br/>
                <input type="submit" name="btncal" id="btncal" value="Search" />
                <br/>
            </form>
            </div>
            <?php
            if (@$_POST["btncal"] != "") {

                $strSQL = "SELECT * FROM tblLeaveNew where LeaveStatusID ='7' and LeaveID ='" . @$_POST["leaveID"] . "' or LeaveStatusID ='7' and UserID like '%" . $_POST["leaveID"] . "%'  ";
                $query = sqlsrv_query($conn, $strSQL, $params, $options);
                $result = sqlsrv_fetch_array($query);
                //ตาราง User
                $strUser = "SELECT * FROM tblUsers where EmployeeID ='" . $result[2] . "'";
                $query2 = sqlsrv_query($conn, $strUser, $params, $options);
                $resultUser = sqlsrv_fetch_array($query2);
                $datetime = @$result[15]->format('Y-m-d');
                //ตารางประเภทการลา
                $strLeave = "SELECT * FROM tblLeaveType where TypeID ='" . $result[3] . "'";
                $query3 = sqlsrv_query($conn, $strLeave, $params, $options);
                $resultLeave = sqlsrv_fetch_array($query3);
                //ตารางสเตตัส
                $strStatus = "SELECT * FROM tblLeaveStatus where LeaveStatusID ='" . $result[1] . "'";
                $query4 = sqlsrv_query($conn, $strStatus, $params, $options);
                $resultStatus = sqlsrv_fetch_array($query4);
                ?><!-- เช็คค่าในการส่ง Serch -->
                <p align="right"> <a class="" target ="_blank"  href='finishHR.php' onClick="window.location.reload();">Export</a></p>
                <div class="table-wrapper" >
                    <table>
                        <thead>
                            <tr>
                                <th>Leave No.</th>
                                <th>Date</th>
                                <th>E/N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Leave Type</th>
                                <th>Day Form</th>
                                <th>Day To</th>
                                <th>Day Time</th>
                                <th>Form</th>
                                <th>To</th>
                                <th>Reson</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        $query1 = sqlsrv_query($conn, $strSQL, $params, $options);
                        while ($result = sqlsrv_fetch_array($query1)) {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $result[0]; ?></td>
                                    <td><?php echo $datetime; ?></td>
                                    <td><?php echo $result[2]; ?></td>
                                    <td><?php echo $resultUser[10]; ?></td>
                                    <td><?php echo $resultUser[11]; ?></td>
                                    <td><div class="test"><?php echo $resultLeave[1] . "/" . $resultLeave[2]; ?></div></td>
                                    <td><?php echo $result[6]; ?></td>
                                    <td><?php echo $result[7]; ?></td>
                                    <td><?php echo $result[8]; ?></td>
                                    <td><?php echo $result[9]; ?></td>
                                    <td><?php echo $result[10]; ?></td>
                                    <td><div class="test"><?php echo $result[4]; ?></div></td> 
                                    <td><?php echo "Pending for HR"; ?></td> 
                                    <td><a href="DetailForHR.php?detail_leave=<?php echo $result[0]; ?>"  >Detail</a></td>
                                    <td><a href="cancleLeaveByHR.php?cancle_leave=<?php echo $result[0]; ?>" onclick="return confirm(' Are you sure want cancel ?')" >Cancel</a></td>
                                </tr>                          
                            </tbody>
                    <?php } ?>
                    </table>
<?php } else { ?>
                    <p align="right"> <a class="" target ="_blank"  href='finishHR.php' onClick="window.location.reload();">Export</a></p>
                    <div class="table-wrapper" >
                        <table>
                            <thead>
                                <tr>
                                    <th>Leave No.</th>
                                    <th>Date</th>
                                    <th>E/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Leave Type</th>
                                    <th>Day Form</th>
                                    <th>Day To</th>
                                    <th>Day Time</th>
                                    <th>Form</th>
                                    <th>To</th>
                                    <th>Reson</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                            $query1 = sqlsrv_query($conn, $strSQL, $params, $options);
                            while ($result = sqlsrv_fetch_array($query1)) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $result[0]; ?></td>
                                        <td><?php echo $datetime; ?></td>
                                        <td><?php echo $result[2]; ?></td>
                                        <td><?php echo $resultUser[10]; ?></td>
                                        <td><?php echo $resultUser[11]; ?></td>
                                        <td><div class="test"><?php echo $resultLeave[1] . "/" . $resultLeave[2]; ?></div></td>
                                        <td><?php echo $result[6]; ?></td>
                                        <td><?php echo $result[7]; ?></td>
                                        <td><?php echo $result[8]; ?></td>
                                        <td><?php echo $result[9]; ?></td>
                                        <td><?php echo $result[10]; ?></td>
                                        <td><div class="test"><?php echo $result[4]; ?></div></td> 
                                        <td><?php echo "Pending for HR"; ?></td> 
                                        <td><a href="DetailForHR.php?detail_leave=<?php echo $result[0]; ?>"  >Detail</a></td>
                                        <td><a href="cancleLeaveByHR.php?cancle_leave=<?php echo $result[0]; ?>" onclick="return confirm(' Are you sure want cancel ?')" >Cancel</a></td>
                                    </tr>                          
                                </tbody>
                        <?php } ?>
                        </table>
<?php } ?>
                </div>
                <div class="copyright">
                    General Terms & Conditions|Copyriht &copy; 2012 SVI Public Company Limited. All Rights Reserved.
                </div>                                     

        </footer>    

    </body>
</html>
<?php } ?>
