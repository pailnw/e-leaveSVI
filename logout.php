<?php
session_start();
session_destroy();
echo "<script language='javascript'>alert('Logout success');
		window.location='Login.html'</script>";
               // header("location:login.html");
?>

