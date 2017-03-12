<?php session_start(); 
if(@$_SESSION["UserID"]==""){
    echo "<script language='javascript'>alert('Please login!!');
		window.location='Login.html'</script>";
}else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>e-Leave System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/Grap.css"/>
        <link href="images/icon.png" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body class="subpage">
        <header id="header">
            <div class="inner1">
                <?php include './BTNhome.php'; ?>
                <nav id="nav">
                    <a href="Profile.php"><?php echo $_SESSION["FirstNameE"] ?> <?php echo $_SESSION["LastNameE"]; ?></a>
                    <a href="ChangPassWord.php">Change Password</a>
                    <a href="logout.php">Logout</a>
                </nav>
                <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
            </div>
        </header>
        <footer id="footer">
            <div class="inner2">
                <center>
                    <div class="6u 12u$(small)"> 
                        
                        <form action="HR_VReport.php" method="post" name="form1">
                            
                            <ul class="actions fit">
                                
                                <!--                            <li><h7>Month :</h7></li>-->
                                <li><h1>Month<select name="A1">
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select></h1></li>
                                <?php
                                include './connect.php';

                                $sqlYear = "SELECT DISTINCT YEAR(StartDate) FROM tblLeaveNew where StartDate != ''";
                                $queryYear = sqlsrv_query($conn, $sqlYear, $params, $options);
                                ?>

                                <!--                            <li><h7><label>Year :</label></h7>-->
                                <li> <h1>Year<select name="A2" id="demo-category">
                                            <?php
                                            while ($resultYear = sqlsrv_fetch_array($queryYear)) {
                                                echo "<option value='$resultYear[0]'>" . $resultYear[0] . " </option>";
                                            }
                                            ?></select></h1></li>
                                <?php
                                $sqlDepart = "SELECT DISTINCT Department FROM tblUsers where Department !=''";
                                $queryDepart = sqlsrv_query($conn, $sqlDepart, $params, $options);
                                ?>
                                <!--                        <li><h7><label>Department :</label></h7>-->
                                <li><h1>Department<select name="A3" id="demo-category">
                                            <?php
                                            while ($resultDepart = sqlsrv_fetch_array($queryDepart)) {
                                                echo "<option value='$resultDepart[0]'>" . $resultDepart[0] . " </option>";
                                            }
                                            ?></select></h1></li>
                            </ul>
                            <ul class="actions fit">
                                <li><input name="submit" type="submit" value="submit" ></li>
                            </ul>
                        </form>
                    </div>
                </center> 
            </div>
            <?php
            if (@$_POST["submit"] != "") {
                include './queryGraph.php';
                ?>
                <div class="GrapDT"><?php
                    echo $departmentLeave;
                    ?></div>                           
            </footer>
            <table id="q-graph">
                <thead>
                    <tr>
                        <th class="L01">L01 : ลาอื่น ๆ (ไม่จ่าย)</th>
                        <th class="L02">L02 : ลาป่วย (ไม่จ่าย)</th>
                        <th class="L03">L03 : ลาพักงาน</th>
                        <th class="L04">L04 : ลาฝึกอบรม</th>
                        <th class="L05">L05 : ลาบวช (ไม่จ่าย)</th>
                        <th class="L06">L06 : ลาคลอด (ไม่จ่าย)</th>
                        <th class="L21">L21 : หยุดสะสมชม.OT</th>
                        <th class="L22">L22 : ลาทำบัตรประชาชน</th>
                        <th class="L23">L23 : ลาภรรยาคลอดบุตร</th>
                        <th class="L24">L24 : ลารับปริญาบัตร</th>
                        <th class="L25">L25 : ลาสมรส</th>
                        <th class="L26">L26 : ลาสมาชิกในครอบครับเจ็บ หรือเสียชีวิต</th>
                        <th class="L27">L27 : ลาทำหมัน</th>
                        <th class="L28-1">L28-1 : ลาฝึกอบรม</th>
                        <th class="L28">L28 : ลากิจได้รับค่าจ้าง</th>
                        <th class="L71">L71 : ลาพักผ่อนประจำปี</th>
                        <th class="L72">L72 : ลาหยุดไม่รับค่าจ้าง</th>
                        <th class="L73">L73 : ลาป่วย</th>
                        <th class="L74">L74 : ลาคลอด</th>
                        <th class="L75">L75 : ลาอุปสมบท</th>
                        <th class="L76">L76 : ลารับราชการทหาร</th>

                    </tr>
                </thead>
                    <tbody>      
                        <tr class="qtr" id="q1">
                            <th scope="row">L01</th>
                            <td class="sent bar" style="height:<?php echo $sum1; ?>%;"><p><?php
                                    if ($row1 == "") {
                                        echo 0;
                                    } else {
                                        echo $row1;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q2">
                            <th scope="row">L02</th>
                            <td class="sent bar" style="height:<?php echo $sum2; ?>%;"><p><?php
                                    if ($row2 == "") {
                                        echo 0;
                                    } else {
                                        echo $row2;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q3">
                            <th scope="row">L03</th>
                            <td class="sent bar" style="height:<?php echo $sum3; ?>%;"><p><?php
                                if ($row3 == "") {
                                    echo 0;
                                } else {
                                    echo $row3;
                                }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q4">
                            <th scope="row">L04</th>
                            <td class="sent bar" style="height:<?php echo $sum4; ?>%;"><p><?php
                                if ($row4 == "") {
                                    echo 0;
                                } else {
                                    echo $row4;
                                }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q5">
                            <th scope="row">L05</th>
                            <td class="sent bar" style="height:<?php echo $sum5; ?>%;"><p><?php
                                if ($row5 == "") {
                                    echo 0;
                                } else {
                                    echo $row5;
                                }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q6">
                            <th scope="row">L06</th>
                            <td class="sent bar" style="height:<?php echo $sum6; ?>%;"><p><?php
                                    if ($row6 == "") {
                                        echo 0;
                                    } else {
                                        echo $row6;
                                    }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q7">
                            <th scope="row">L21</th>
                            <td class="sent bar" style="height:<?php echo $sum21; ?>%;"><p><?php
                                    if ($row21 == "") {
                                        echo 0;
                                    } else {
                                        echo $row21;
                                    }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q8">
                            <th scope="row">L22</th>
                            <td class="sent bar" style="height:<?php echo $sum22; ?>%;"><p><?php
                                    if ($row22 == "") {
                                        echo 0;
                                    } else {
                                        echo $row22;
                                    }
                                    ?></p></td>
                        </tr>
                        </tr>
                        <tr class="qtr" id="q9">
                            <th scope="row">L23</th>
                            <td class="sent bar" style="height:<?php echo $sum23; ?>%;"><p><?php
                                if ($row23 == "") {
                                    echo 0;
                                } else {
                                    echo $row23;
                                }
                                    ?></p></td>
                        </tr>
                        </tr>
                        <tr class="qtr" id="q10">
                            <th scope="row">L24</th>
                            <td class="sent bar" style="height: <?php echo $sum24; ?>%;"><p><?php
                                    if ($row24 == "") {
                                        echo 0;
                                    } else {
                                        echo $row24;
                                    }
                                    ?></p></td>
                        </tr>
                        </tr>
                        <tr class="qtr" id="q11">
                            <th scope="row">L25</th>
                            <td class="sent bar" style="height:<?php echo $sum25; ?>%;"><p><?php
                                    if ($row25 == "") {
                                        echo 0;
                                    } else {
                                        echo $row25;
                                    }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q12">
                            <th scope="row">L26</th>
                            <td class="sent bar" style="height: <?php echo $sum26; ?>%;"><p><?php
                                    if ($row26 == "") {
                                        echo 0;
                                    } else {
                                        echo $row26;
                                    }
                                    ?></p></td>
                        </tr>

                        <tr class="qtr" id="q13">
                            <th scope="row">L27</th>
                            <td class="sent bar" style="height: <?php echo $sum27; ?>%;"><p><?php
                                    if ($row27 == "") {
                                        echo 0;
                                    } else {
                                        echo $row27;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q14">
                            <th scope="row">L28-1</th>
                            <td class="sent bar" style="height:<?php echo $sum28_1; ?>%;"><p><?php
                                    if ($row28_1 == "") {
                                        echo 0;
                                    } else {
                                        echo $row28_1;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q15">
                            <th scope="row">L28</th>
                            <td class="sent bar" style="height: <?php echo $sum28; ?>%;"><p><?php
                                if ($row28 == "") {
                                    echo 0;
                                } else {
                                    echo $row28;
                                }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q16">
                            <th scope="row">L71</th>
                            <td class="sent bar" style="height: <?php echo $sum71; ?>%;"><p><?php
                                if ($row71 == "") {
                                    echo 0;
                                } else {
                                    echo $row71;
                                }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q17">
                            <th scope="row">L72</th>
                            <td class="sent bar" style="height: <?php echo $sum72; ?>%;"><p><?php
                                    if ($row72 == "") {
                                        echo 0;
                                    } else {
                                        echo $row72;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q18">
                            <th scope="row">L73</th>
                            <td class="sent bar" style="height: <?php echo $sum73; ?>%;"><p><?php
                                    if ($row73 == "") {
                                        echo 0;
                                    } else {
                                        echo $row73;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q19">
                            <th scope="row">L74</th>
                            <td class="sent bar" style="height: <?php echo $sum74; ?>%;"><p><?php
                                    if ($row74 == "") {
                                        echo 0;
                                    } else {
                                        echo $row74;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q20">
                            <th scope="row">L75</th>
                            <td class="sent bar" style="height: <?php echo $sum75; ?>%;"><p><?php
                                    if ($row75 == "") {
                                        echo 0;
                                    } else {
                                        echo $row75;
                                    }
                                    ?></p></td>
                        </tr>
                        <tr class="qtr" id="q21">
                            <th scope="row">L76</th>
                            <td class="sent bar" style="height: <?php echo $sum76; ?>%;"><p><?php
                                    if ($row76 == "") {
                                        echo 0;
                                    } else {
                                        echo $row76;
                                    }
                                    ?></p></td>
                        </tr>
                    </tbody>
                </table>
            <div id="ticks">
                <div class="tick" style="height: 20px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
                <div class="tick" style="height: 49.5px;"></div>
            </div><br/><br/><br/><br/>
<?php
} else {
    echo 'Please insert data';
}
?>
    </body>
</html>
<?php } ?>