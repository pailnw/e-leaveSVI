<?php

ini_set('display_errors', 1);
error_reporting(~0);

include './connect.php';
$Username1 = $_POST['txtUsername'];
$Password1 = $_POST['txtPassword'];
$strSQL = "SELECT * FROM tblUsers WHERE UserID = '" . $Username1 . "' 
	and Password = '" . $Password1 . "'";
$query = sqlsrv_query($conn, $strSQL, $params, $options);
$numrow = sqlsrv_num_rows($query);
$result = sqlsrv_fetch_array($query);

//UserGoup
$userGroup = "SELECT * FROM tblUsers";
$query2 = sqlsrv_query($conn, $userGroup, $params, $options);
$numrow = sqlsrv_num_rows($query2);
$result2 = sqlsrv_fetch_array($query2);

if (!$result) {
    echo "<script language='javascript'>alert('Uesrname and Password Incorect!');
		window.location='Login.php'</script>";
    // header("location:login.html");
} else {
    session_start();
    $_SESSION["UserID"] = $result["UserID"];
    $_SESSION["Password"] = $result["Password"];
    $_SESSION["UserGroup"] = $result["UserGroup"];
    $_SESSION["FirstNameE"] = $result["FirstNameE"];
    $_SESSION["LastNameE"] = $result["LastNameE"];
    $_SESSION["PrefixE"] = $result["PrefixE"];
    $_SESSION["WorkType"] = $result["WorkType"];
    $_SESSION["Department"] = $result["Department"];
    $_SESSION["Vocation"] = $result["Vocation"];
    $_SESSION["VocationPluse"] = $result["VocationPluse"];
    $_SESSION["VocationUse"] = $result["VocationUse"];
    $_SESSION["UserLevel"] = $result["UserLevel"];
    $_SESSION["Approver1"] = $result["Approver1"];
    $_SESSION["Approver2"] = $result["Approver2"];
    $_SESSION["UserID"] = $result["UserID"];
  

  if($result["UserGroup"] != ""){//หน้า HR
         header("location:Main.php");
    }else{
            echo "<script language='javascript'>alert('User Name or Password incorrect');
		window.location='Login.php'</script>";
    }
}
sqlsrv_close($conn);
?>