<?php
session_start();
$userGroup = $_POST["userGroup"];
$newApp1 = $_POST["newApp1"];
$newApp2 = $_POST["newApp2"];
$newEmail = $_POST["newEmail"];
$label =$_POST["hdnName"];

include './connect.php';


$strSQLuserGroup1 = "update tblUsers set UserGroup ='".$userGroup."',Approver1='".$newApp1."' , Approver2='".$newApp2."',Email='".$newEmail."' where UserID ='".$label."' ";
$query2 = sqlsrv_query($conn, $strSQLuserGroup1, $params, $options);
$result2 = sqlsrv_fetch_array($query2);

$row = sqlsrv_rows_affected($query2);

     $newAppover= "SELECT * FROM tblUsers WHERE UserID = '" . $newApp1 . "' 
	or UserID = '" . $newApp1 . "'";
        $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $queryApp = sqlsrv_query($conn, $newAppover, $params, $options);
    $numrowApp = sqlsrv_num_rows($queryApp);
    $resultApp = sqlsrv_fetch_array($queryApp);
        
    
    //เช็คเงื่อนไขในการอัพเดต
    if($resultApp["UserGroup"]=="1"){
        //update usergroup for Appover1
        $strSQLuserGroup2 = "update tblUsers set UserGroup ='4' where UserID ='".$newApp1."' ";
        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $query3 = sqlsrv_query($conn, $strSQLuserGroup2, $params, $options);
        $result3 = sqlsrv_fetch_array($query3);      
     }
     if($resultApp["UserGroup"]=="2"){ 
         //update usergroup for Appover2
        $strSQLuserGroup3 = "update tblUsers set UserGroup ='4' where UserID ='".$newApp2."' ";
        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $query4 = sqlsrv_query($conn, $strSQLuserGroup3, $params, $options);
        $result4 = sqlsrv_fetch_array($query4);
     }
             
     if($row>0){
            echo "<script language='javascript'>alert('Fail');
		window.location='MTN.php'</script>";
            
        }else{    echo "<script language='javascript'>alert('Sucess.');
		window.location='MTN.php'</script>";}
?>

