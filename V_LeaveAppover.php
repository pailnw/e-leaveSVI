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
                <?php include './BTNhome.php'; ?>
                <nav id="nav">
                    <a href="Profile.php"><?php echo $_SESSION["FirstNameE"] ?> <?php echo $_SESSION["LastNameE"]; ?></a>
                    <a href="ChangPassWord.php">Change Password</a>
                    <a href="logout.php">Logout</a>
                </nav>
                <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
            </div>
        </header>

        <!-- Footer -->

        <footer id="footer"><h2>View Request Leave</h2>
            <div class="inner">

                <h1>
                    <div id="table">
                        <div class="A A1">

                            <span class="A2">Leave ID</span>
                            <span class="A2">User ID</span>
                            <span class="A2">Name</span>
                            <span class="A2">Leave Type</span>
                            <span class="A2">Date-Time</span>
                            <span class="A2">Status</span>   
                            <span class="A2"></span> 
                            <span class="A2"></span>   
                        </div>
                        <?php
                        include './connect.php';
                        $userLeave = $_SESSION["UserID"];
                        $strSQL = "SELECT * FROM tblLeaveNew WHERE Approver = '" . $userLeave . "' and LeaveStatusID = '2' ORDER BY LeaveID DESC  ";
                        $query = sqlsrv_query($conn, $strSQL, $params, $options);
                        $numrow = sqlsrv_num_rows($query);
                        if ($numrow > 0) {
                            while ($result = sqlsrv_fetch_array($query)) {
                                ?>

                                <div class="B A1">
                                    <input type="radio" name="expand">
                                    <span class="A2 pk" data-label="ID"><?php echo $result[0]; ?></span>
                                    <span class="A2" data-label="UserID"> <?php
                                        $strSQL3 = "SELECT * FROM tblUsers WHERE UserID = '" . $result[2] . "' ";

                                        $query3 = sqlsrv_query($conn, $strSQL3, $params, $options);
                                        $numrow3 = sqlsrv_num_rows($query3);
                                        $result3 = sqlsrv_fetch_array($query3);
                                        echo $result3[0];
                                        ?> </span>
                                    <span class="A2" data-label="Name" >
                                        <?php
                                        echo $result3[10] . " " . $result3[11];
                                        ?>



                                    </span>
                                    <span class="A2" data-label="Type" ><?php
                                        $strSQL1 = "SELECT * FROM tblLeaveType WHERE TypeID = '" . $result[3] . "' ";

                                        $query1 = sqlsrv_query($conn, $strSQL1, $params, $options);
                                        $numrow1 = sqlsrv_num_rows($query1);
                                        $result1 = sqlsrv_fetch_array($query1);
                                        echo $result1[1] . " /" . $result1[2];
                                        ?></span>

                                    <span class="A2" data-label="time"><?php
                                        if ($result[6] == "" && $result[7] == "") {
                                            echo $result[8] . " | " . $result[9] . " - " . $result[10];
                                        } else {
                                            echo $result[6] . " | " . $result[7];
                                        }
                                        ?></span>
                                    <span class="A2" data-label="Status"><?php
                                        $strSQL2 = "SELECT * FROM tblLeaveStatus WHERE LeaveStatusID = '" . $result[1] . "' ";

                                        $query2 = sqlsrv_query($conn, $strSQL2, $params, $options);
                                        $result2 = sqlsrv_fetch_array($query2);
                                        echo $result2[1];
                                        ?></span>
                                    <span class="A2"  data-label="Cancle"><a href="detailRequest.php?userid=<?php echo $result[0]; ?>">Detail</a>           
                                    </span> <!--ส่งค่ารหัสพนักงานแบบ GET ไปยังหน้า detailRequest.php -->
                                    <?php if ($result2[0] == '2') { ?>
                                        <span class="A2"  data-label="Cancle"><a href="appoveByAppover.php?appove_id=<?php echo $result[0]; ?>" onclick="return confirm('You want appove leave?')">Approve</a> |
                                            <a href="cancleLeaveByAppove.php?cancle_leave=<?php echo $result[0]; ?>"onclick="return confirm('You want reject leave?')">Reject</a>
<!--Appove-->
                                        </span>
                                    <?php } ?>
                                </div>   <?php }
                    }
                            ?>
                    </div></h1><br>
                <div class="copyright">
                    General Terms & Conditions|Copyriht &copy; 2012 SVI Public Company Limited. All Rights Reserved.
                </div>                                     
            </div> 
        </footer>          
    </body>
</html>
<?php } ?>
