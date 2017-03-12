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
    </head>
    <body class="subpage">
        <header id="header">
            <div class="inner">
                <?php if ($_SESSION["UserGroup"] == '1') { ?><a href="User.php" class="logo">Home</a>
                <?php } else if ($_SESSION["UserGroup"] == '9') { ?><a href="Adminpage.php" class="logo">Home</a>
                <?php } else if ($_SESSION["UserGroup"] == '4') { ?><a href="Supervisor.php" class="logo">Home</a>
                <?php } ?>
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
            <div class="inner">
                <h2>Detail Leave</h2>
                <?php
                $userid = $_GET["userid"]; //รับค่า GET รหัสของพนักงานที่ส่งมา
                include './connect.php';
                //คิวรี่ข้อมูลในตาราง tblLeaveNew
                $leaveNew = "SELECT *  FROM tblLeaveNew where LeaveID ='" . $userid . "'"; //ดึงข้อมูลของ Leave จากตาราง tblLeaveNew
                $queryLeaveNew = sqlsrv_query($conn, $leaveNew, $params, $options);
                $result = sqlsrv_fetch_array($queryLeaveNew);
                //คิวรี่ข้อมูลในตาราง tblUsers
                $strSQL = "SELECT *  FROM tblUsers where UserID ='" . $result[2] . "'"; //ดึงข้อมูลของ User
                $queryUser = sqlsrv_query($conn, $strSQL, $params, $options);
                $result2 = sqlsrv_fetch_array($queryUser);

                //ดึงข้อมูล status จากตาราง tblLeaveStatus
                $leaveStatus = "SELECT * FROM tblLeaveStatus WHERE LeaveStatusID = '" . $result[1] . "' ";
                $queryLeaveStatus = sqlsrv_query($conn, $leaveStatus, $params, $options);
                $result3 = sqlsrv_fetch_array($queryLeaveStatus);

                //ดึงข้อมูล LeaveType จากตาราง tblLeaveType
                $leaveType = "SELECT * FROM tblLeaveType WHERE TypeID = '" . $result[3] . "' ";
                $queryLeaveType = sqlsrv_query($conn, $leaveType, $params, $options);
                $result4 = sqlsrv_fetch_array($queryLeaveType);
                ?>

                <div align="center">
                    <table>
                        <tr>
                            <th>Leave Status</th>
                            <th> : </th>
                            <td><?php echo $result3[1]; ?></td>
                        </tr>
                        <tr>
                            <th>Employee No.</th>
                            <th> : </th>
                            <td><?php echo $result[2]; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th> : </th>
                            <td><?php echo $result2[9] . " " . $result2[10] . " " . $result2[11]; ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <th> : </th>
                            <td><?php echo $result2[18]; ?></td>
                        </tr>
                        <tr>
                            <th>Leave Type</th>
                            <th> : </th>
                            <td><?php echo $result4[1] . "/" . $result4[2]; ?></td>
                        </tr>
                        <tr>
                            <th>Leave Form</th>
                            <th> : </th>
                            <td><?php
                                if ($result[6] == "" && $result[7] == "") {
                                    echo $result[8] . " " . $result[9];
                                } else if ($result[6] != "" && $result[7] != "") {
                                    echo $result[6];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th>Leave To</th>
                            <th> : </th>
                            <td><?php
                                if ($result[6] == "" && $result[7] == "") {
                                    echo $result[8] . " " . $result[10];
                                } else if ($result[6] != "" && $result[7] != "") {
                                    echo $result[7];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th>Sum Leave</th>
                            <th> : </th>
                            <td><?php echo $result[11]; ?></td>
                        </tr>
                        <tr>
                            <th>Reason</th>
                            <th> : </th>
                            <td><?php echo $result[4]; ?></td>
                        </tr>
                        <tr>
                            <th>Request Date</th>
                            <th> : </th>
                            <td><?php
                                $datetime = $result[15]->format('Y-m-d H:i:s'); //กำหนด format ของ datetime ที่มาแสดง
                                echo $datetime;
                                ?></td>
                        </tr>
                    </table>
                    <div class="6u 12u$(small)">
                        <ul class="actions fit">
                            <li><a class="button fit" href="V_LeaveAppover.php">Back</a></li>

<?php if ($result[1] == '2') { ?>
                                <li><a class="button fit" href="appoveByAppover.php?appove_id=<?php echo $result[0]; ?>" onclick="return confirm('You want appove leave?')">Appove</a></li>
                                <li><a class="button fit" href="cancleLeaveByAppove.php?cancle_leave=<?php echo $result[0]; ?>"onclick="return confirm('You want reject leave?')">Reject</a></li>
                            </ul>
                        </div> 

<?php } ?>
                </div>  

            </div>

        </footer>
    </body>
</html>
<?php } ?>