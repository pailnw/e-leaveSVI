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
        <link href="images/icon.png" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="css/tableCss.css"/>
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
            <script type="text/javascript">$('#datetimepicker_dark').datetimepicker({timepicker:false,format:'d/m/Y',lang:'th',theme:'dark'})</script>
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
    <footer id="footer">
        <div class="inner">
            <h2>Profile</h2>
            <div align="center">
            <table>
    	<tr>
        	<th>Name</th>
            <th> : </th>
            <td><?php echo $_SESSION["FirstNameE"] ?><?php echo $_SESSION["LastNameE"] ?></td>
        </tr>
        <tr>
            <th>Department</th>
            <th> : </th>
            <td><?php echo $_SESSION["Department"] ?></td>
        </tr>
        <tr>
            <th>Time can has leave</th>
            <th> : </th>
            <td><?php ?></td>
        </tr>
        <tr>
            <th>The number of sick days</th>
            <th> : </th>
            <td><?php ?></td>
        </tr>
        <tr>
            <th>The number of vacation days</th>
            <th> : </th>
            <td><?php echo $_SESSION["VocationUse"] ?> / <?php echo $_SESSION["Vocation"] ?>
            </td>
        </tr>
            </table></div><br/>
              <input type="button" name="btnb" value="Back" onclick='window.location="Main.php";'/>
                    
                 
            </div>
    </footer>
</body>
</html>
<?php } ?>
