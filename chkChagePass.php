<?php

session_start();
ini_set('display_errors', 1);
error_reporting(~0);
include './connect.php';
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$renewPass = $_POST['retrynewPass'];
$strSQL = "SELECT * FROM tblUsers WHERE UserID = '" . $_SESSION["UserID"] . "' 
                and Password = '" . $oldPass . "'";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);
if ($numrow == 0) {
    die("<script>
				alert('Old password incorrect');
				history.back();
			 </script>");
} else
if ($newPass != $renewPass) {
    die("<script>
				alert('Passwords do not match');
				history.back();
                </script>");
} else {
    //$newPass = md5($newPass);
    $sql = "update tblUsers set
                                        Password='" . $newPass . "'
                                        where UserID = '" . $_SESSION["UserID"] . "'
                                        ";
    //$result = sqlsrv_query($sql) or die("Err : $sql");
    $query = sqlsrv_query($conn, $sql, $params, $options);
    echo "<script>
			alert('Update Password');
			window.location='Login.php';
                            </script>";
}
?>

