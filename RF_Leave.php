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
</head>
        <script>
            function hiddenn(pvar) {
                if (pvar == 0) {
                    document.getElementById("startDate").style.display = '';
                    document.getElementById("endDate").style.display = '';
                    document.getElementById("a1").style.display = '';
                    document.getElementById("a2").style.display = '';
                    document.getElementById("date1").style.display = 'none';
                    document.getElementById("time1").style.display = 'none';
                    document.getElementById("time2").style.display = 'none';
                    document.getElementById("a3").style.display = 'none';
                    document.getElementById("a4").style.display = 'none';
                    document.getElementById("a5").style.display = 'none';
                    document.getElementById("startDate").value = "";
                    document.getElementById("endDate").value = "";
                    document.getElementById("date1").value = "";
                    document.getElementById("time1").value = "";
                    document.getElementById("time2").value = "";
                } else {
                    document.getElementById("startDate").style.display = 'none';
                    document.getElementById("endDate").style.display = 'none';
                    document.getElementById("a1").style.display = 'none';
                    document.getElementById("a2").style.display = 'none';
                    document.getElementById("date1").style.display = '';
                    document.getElementById("time1").style.display = '';
                    document.getElementById("time2").style.display = '';
                    document.getElementById("a3").style.display = '';
                    document.getElementById("a4").style.display = '';
                    document.getElementById("a5").style.display = '';
                }
            }
        </script>
<body onload="hiddenn('0')" class="subpage">
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
        <footer id="footer">
        <div class="inner">
            <h2>Request Form</h2>
       
        <?php
        include './connect.php';
        $strSQL = "SELECT *  FROM tblLeaveType ORDER BY TypeID ASC";
        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $query = sqlsrv_query($conn, $strSQL, $params, $options);
        ?>
        <center>
        <form id="chkLeave" action="chkLeave.php" method="post">
        <!-- select -->
       	<div class="field">
                <div class="4u 12u$(small)">
                <label for="Leave Type">Leave Type</label>
                <div class="select-wrapper">
		<select name="leaveType" id="demo-category">
                    <?php while ($result = sqlsrv_fetch_array($query)) { 
		echo "<option value='$result[0]'>" . $result["LeaveThai"] . " / " . $result["LeaveEng"] . " </option>"; }?>
		</select>
                </div>
            </div>
        </div>
        <div class="row uniform"> 
        <!-- radio -->
        <div class="4u(small)">
           <input type="radio" name="type" onclick="hiddenn('0')" checked id="Day"><label for="Day">Day</label>
           <input type="radio" name="type" onclick="hiddenn('1')" id="Time"><label for="Time">Time</label>
        </div>
        </div>
        <!-- text date -->
        <div class="4u 12u$(small)">
            <label id="a1" for="startDate">Start
            <input type="date" name="startDate" id="startDate" /></label> 
        </div>
        <div class="4u 12u$(small)">
            <label id="a2" for="endDate"> End
            <input type="date" name="endDate" id="endDate" /></label>  
        </div>
        <div class="4u 12u$(small)">
            <label id="a3" for="date">Date</label> 
            <input type="date" name="startDate1" id="date1" placeholder="__/__/____"/>
        </div>
        <div class="4u 12u$(small)">  
            <ul class="actions fit">
                <li><label id="a4" for="time1">Time :</label></li>
                <li><input type="time" id="time1" name="time1" style="border:0px;"></li>
                <li><label id="a5" for="time2">to :</label></li>
                <li><input type="time" id="time2" name="time2" style="border:0px;"></li>
            </ul>
          
        </div>
        <!-- Reson -->
        <div class="4u 12u$(small)">
            <label id="demo-message" for="reson">Reson</label> 
            <textarea name="reson" id="demo-message" placeholder="Enter your message"></textarea>
        </div>
        <!-- approver -->
            <?php
                $strSQL1 = "SELECT * FROM tblUsers where Department = '" . $_SESSION["Department"] . "' and UserLevel = 'Management' "
                        . "or UserID = '" . $_SESSION["Approver1"] . "' "
                        . "or UserID = '" . $_SESSION["Approver2"] . "' ";
                $params = array();
                $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                $query1 = sqlsrv_query($conn, $strSQL1, $params, $options); 
            ?>
        <div class="field">
            <div class="4u 12u$(small)">
                <label for="leaveApove">Approver</label>
                <div class="select-wrapper">
                <select id='leaveApove' name='leaveApove'><?php while ($result1 = sqlsrv_fetch_array($query1)) {
                echo"<option value='$result1[0]'>" . $result1["FirstNameE"] . " " . $result1["LastNameE"] . " </option>"; } ?> 
                </select>
                </div>
            </div>
        </div><br/>
        <!-- Button -->                                                                            
        <div align="center">
            <input type="button" value="Home" id="btnh" onclick="window.location = 'Main.php'">
            <input type="submit" value="Send" id="btnS">
            <input type="reset" value="Cancle" id="btnC">
        </div>
        </form>
            </center>  
                <div class="copyright">
                    General Terms & Conditions|Copyriht &copy; 2012 SVI Public Company Limited. All Rights Reserved.
		</div>
        </div>
        </footer>
</body>
</html>
<?php } ?>
