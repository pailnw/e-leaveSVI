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
            <h2>Change Password</h2>
            <form name="chengepass" method="post" action="chkChagePass.php">
                <div class="field Z1 Z2">
                    <input name="oldPass" type="password" id="oldPass" placeholder="Enter your password">
                </div>
                <div class="field Z1 Z2">
                    <input name="newPass" type="password" id="newPass" placeholder="Enter your new password ">
                </div>
                <div class="field Z1 Z2">
                    <input name="retrynewPass" type="password" id="retrynewPass" placeholder="Retry your new password ">
                </div>
                <div class="field Z1 Z2">
                    <input type="submit" name="Submit" value="Submit">
                </div>
                <div class="field Z1 Z2">  
                    <input type="reset" name="reset" value="Cancel" onclick='window.history.back();'>

                </div>
            </form>
            <div class="copyright">
                    General Terms & Conditions|Copyriht &copy; 2012 SVI Public Company Limited. All Rights Reserved.
		</div>
       			</div>
        </footer>
</body>
</html>
<?php } ?>

