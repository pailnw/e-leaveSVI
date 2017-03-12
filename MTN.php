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
        <link rel="stylesheet" type="text/css" href="css/datetimepicker.css"/>
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
        <script src="js/editUser.js"></script>
        <script language="JavaScript">
            var HttPRequest = false;

            function doCallAjax(fUserID, fUserName) {
                HttPRequest = false;
                if (window.XMLHttpRequest) { // Mozilla, Safari,...
                    HttPRequest = new XMLHttpRequest();
                    if (HttPRequest.overrideMimeType) {
                        HttPRequest.overrideMimeType('text/html');
                    }
                } else if (window.ActiveXObject) { // IE
                    try {
                        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                        }
                    }
                }

                if (!HttPRequest) {
                    alert('Cannot create XMLHTTP instance');
                    return false;
                }

                var url = 'ajaxMTN.php';
                var pmeters = "UserID=" + encodeURI(document.getElementById(fUserID).value);

                HttPRequest.open('POST', url, true);

                HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                HttPRequest.setRequestHeader("Content-length", pmeters.length);
                HttPRequest.setRequestHeader("Connection", "close");
                HttPRequest.send(pmeters);


                HttPRequest.onreadystatechange = function ()
                {
                    if (HttPRequest.readyState == 4) // Return Request
                    {
                        var myUser = HttPRequest.responseText;
                        if (myUser != "")
                        {
                            var myArr = myUser.split("|");
                            document.getElementById(fUserName).value = myArr[0];
                            document.getElementById(fPrice).value = myArr[1];
                        }
                    }

                }

            }
        </script>
    </head>
    <body class="subpage">
        <header id="header">
            <div class="inner">
                <?php include './BTNhome.php'; ?>
                <nav id="nav">
                    <a href="profileD.php"><?php echo $_SESSION["FirstNameE"] ?> <?php echo $_SESSION["LastNameE"]; ?></a>
                    <a href="ChangPassWord.php">Change Password</a>
                    <a href="logout.php">Logout</a>
                </nav>
                <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
            </div>
        </header>
        <footer id="footer">
            <div class="inner">
                <center>
                    <form name="f1" action="MTN.php" method="POST">
                        <div class="6u 12u$(small)">
                            <input type="text" name="txtUserID" id="txtName" value=""><br>
                            <input name="btnButton" id="btnButton" type="submit" value="Check User" >
                        </div>
                    </form>
                    <?php
                    include './connect.php';
                    $Username1 = @$_POST['txtUserID'];

                    $strSQL = "SELECT * FROM tblUsers WHERE UserID ='" . $Username1 . "'";
                    $query = sqlsrv_query($conn, $strSQL, $params, $options);
                    $numrow = sqlsrv_num_rows($query);
                    $result = sqlsrv_fetch_array($query);
//        /* เช็คค่าเข้า */ if (empty($Username1)) {
//            echo "<script language='javascript'>alert('กรุณาใส่ข้อมูล!');
//  window.location='MTN_1.php'</script>";
//        } else { 
                    ?>
                    <form name="f2" action="chkMTN_2.php" method="POST">
                        <div class="6u 12u$(small)"> 
                            <h7><label id='label1' name='label1'> UserID : <?php echo $result[0] . " " . $result[10] . " " . $result[11]; ?> </label></h7>
                        </div>
                        <!-- ซ่อนข้อมูล --> <input type="hidden" name="hdnName" value="<?php echo $result["UserID"]; ?>">
                        <div class="6u 12u$(small)"> 
                            <h7><label>New Group<?php
                                    $strSQLuserGroup = "SELECT * FROM tblUserGroup";
                                    $query1 = sqlsrv_query($conn, $strSQLuserGroup, $params, $options);
                                    $result1 = sqlsrv_fetch_array($query1);

                                    $strSQLuserGroup1 = "SELECT * FROM tblUsers where UserID ='" . $Username1 . "'";
                                    $query2 = sqlsrv_query($conn, $strSQLuserGroup1, $params, $options);
                                    $result2 = sqlsrv_fetch_array($query2);

                                    $strSQLuserGroup2 = "SELECT * FROM tblUserGroup where UserGroupID='" . $result2[2] . "'";
                                    $query3 = sqlsrv_query($conn, $strSQLuserGroup2, $params, $options);
                                    $result3 = sqlsrv_fetch_array($query3);
                                    echo $result2[2];
                                    ?>
                                    <select id='userGroup' name='userGroup' > <?php
                                        echo "<option value='" . $result3[0] . "'>" . $result3[1] . " </option>";
                                        echo "<option value='$result1[0]'>" . $result1["UserGroupName"] . " </option>";
                                        while ($result1 = sqlsrv_fetch_array($query1)) {
                                            echo"<option value='$result1[0]'>" . $result1["UserGroupName"] . " </option>";
                                        }
                                        ?>
                                    </select>
                                </label></h7>
                        </div>

                        <div class="6u 12u$(small)">
                            <h7><label>New Approver1</label></h7>
                            <ul class="actions fit">
                                <li><input type="text" id="newApp1" name="newApp1" OnChange="JavaScript:doCallAjax('newApp1', 'txtUserName1');" value="<?php echo $result["26"]; ?> " readOnly></li>
                                <li><input type="text" name="txtUserName1" id="txtUserName1" readOnly style="border:0px;" 
                                           value="<?php
                                           $AppName1 = $result["26"];
                                           $BWsql = "select * from tblUsers where UserID = '" . $AppName1 . "'";
                                           $BWquery = sqlsrv_query($conn, $BWsql, $params, $options);
                                           $BWresult = sqlsrv_fetch_array($BWquery);
                                           echo $BWresult["10"] . " " . $BWresult["11"];
                                           ?> "> </li>
                            </ul>
                            <input class="button" onclick="lockApporver1(2)" value="Edit Approver1"/>
                        </div>

                        <div class="6u 12u$(small)">
                            <h7><label>New Approver2</label></h7>                
                            <ul class="actions fit ">
                                <li><input type="text" id="newApp2" name="newApp2" OnChange="JavaScript:doCallAjax('newApp2', 'txtUserName2');" value="<?php echo $result["27"]; ?>" readOnly></li>
                                <li><input type="text" name="txtUserName2" id="txtUserName2"   readOnly style="border:0px;" value="<?php
                                    $AppName2 = $result["27"];
                                    $BWsql = "select * from tblUsers where UserID = '" . $AppName2 . "'";
                                    $BWquery = sqlsrv_query($conn, $BWsql, $params, $options);
                                    $BWresult = sqlsrv_fetch_array($BWquery);
                                    echo $BWresult["10"] . " " . $BWresult["11"];
                                    ?> "></li> 
                            </ul>
                            <input type="button" name="free" value="Edit Approver2" id="RadioGroup1_1" onclick="lockApporver2(2)"/>
                        </div>

                        <div class="6u 12u$(small)">
                            <h7><label>New Email</label></h7>   
                            <ul class="actions fit">
                                <li><input type="text" id="newEmail"  name="newEmail" value="<?php echo $result["28"]; ?>" readOnly></li>
                            </ul>
                            <input class="button" onclick="lockemail(2)" value="Edit Email"/>
                        </div>

                        <br/>            
                        <div align="center">
                            <input type="submit" id="subEdit" name="subEdit" value="Submit">
                            <input type="button" id="can" name="subEdit" value="Cancle" onclick="window.location = 'Main.php'">
                            <input type="button" name="btnDL" value="Reset Password" onclick="window.location = 'resetPass.php?reset_pass=<?php echo $result["UserID"]; ?>'">                
                        </div>
                    </form> 
                </center>
            </div> 
        </footer><?php // }  ?>
    </body>
</html>
<?php } ?>