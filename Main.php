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
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/util.js"></script>
	<script src="js/main.js"></script>
        <script src="js/jquery.js"></script>
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
		<p><img src="images/svi logo.png" width="120" height="100"></p>
                    <h3>Welcome to SVI Leave.</h3>
                    <h3><?php echo $_SESSION["PrefixE"]; ?>  <?php echo $_SESSION["FirstNameE"] ?> <?php echo $_SESSION["LastNameE"]; ?></h3>
            <form id="fPage2" action="" method="post">
                <?php include './ButtonMain.php'; ?>
            </form>
                <div class="copyright">
                    General Terms & Conditions|Copyriht &copy; 2012 SVI Public Company Limited. All Rights Reserved.
		</div> 
        </div>
    </footer>
</body>
</html>
<?php 
}
?>
