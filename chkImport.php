<?php
set_time_limit(0);
include('./ReadExcle/reader.php');
$data = new Spreadsheet_Excel_Reader('myfile/User.xls',true,"UTF-8");
$data->setOutputEncoding('UTF-8');
$data->read("myfile/User.xls");

$arr1 = array();
$s = 0;
include './connect.php';

$sqlsrv1 = "select * from tblUsers";
$query1 = sqlsrv_query($conn, $sqlsrv1, $params, $options);
while($row1 = sqlsrv_fetch_array($query1)) { 
	for ($x = 2;$x <= count($data->sheets[$s]["cells"]);$x++) {
		for($i=1;$i<=39;$i++){
			if ($i == 2)
		{
			continue;
		}
			@$arr1[$i] =  $data->sheets[$s]["cells"][$x][$i];
		}
		$sql1 = '%s';
		$e = vsprintf($sql1,$arr1);
		$b = $row1["UserID"];
			
		if($b == $e){
				$sql2 = "UPDATE tblUsers SET UserID = '%s'
      ,UserGroup = '%s'
      ,Plant = '%s'
      ,PlantDetails = '%s'
      ,EmployeeID = '%s'
      ,PrefixT = '%s'
      ,FirstNameT = '%s'
      ,LastNameT = '%s'
      ,PrefixE = '%s'
      ,FirstNameE = '%s'
      ,LastNameE = '%s'
      ,HireDate = '%s'
      ,Positions = '%s'
      ,UserLevel = '%s'
      ,UserGrade = '%s'
      ,WorkType = '%s'
      ,OPSType = '%s'
      ,Department = '%s'
      ,Sex = '%s'
      ,MaritalStatus = '%s'
      ,ProbativeDate = '%s'
      ,VacationDate = '%s'
      ,Vocation = '%s'
      ,VocationPluse = '%s'
      ,VocationUse = '%s'
      ,Approver1 = '%s'
      ,Approver2 = '%s'
      ,Email = '%s'
      ,Telphone = '%s'
      ,LoginFlag = '%s'
      ,LockFlag = '%s'
      ,DelFlag = '%s'
      ,LoginDate = '%s'
      ,LogoutDate = '%s'
      ,CreateUser = '%s'
      ,CreateDate = '%s'
      ,LastEditUser = '%s'
      ,LasteditDate = '%s' where UserID = '".$e."'";
				$c = vsprintf($sql2,$arr1);
				//echo $c; echo "<br/>";
				$sqlquery1 = sqlsrv_query($conn, $c, $params, $options);      
                                if( $sqlquery1 === false ) { die( print_r( sqlsrv_errors(), true));}
//				break;			
		}
	} 
}
$arr2 = array();
$arr3 = array();
$arr4 = array();
$arr5 = array();
$arr6 = array();
$arr7 = array();
$arr8 = array();
$arr9 = array();
$sqlsrv2 = "select * from tblUsers";
$query2 = sqlsrv_query($conn, $sqlsrv2, $params, $options);
$a1 = array();
$a2 = array();
while($row2 = sqlsrv_fetch_array($query2)) {
	$s1 = $row2["UserID"];
	$s2 = $row2["Password"];
	$s3 = $row2["UserGroup"];
        $s4 = $row2["Plant"];
	$s5 = $row2["PlantDetails"];
	$s6 = $row2["EmployeeID"];
        $s7 = $row2["PrefixT"];
	$s8 = $row2["FirstNameT"];
	$s9 = $row2["LastNameT"];
        $s10 = $row2["PrefixE"];
	$s11 = $row2["FirstNameE"];
        $s12 = $row2["LastNameE"];
        $s13 = $row2["HireDate"]->format('Y-m-d H:i:s');
        $s14 = $row2["Positions"];
	$s15 = $row2["UserLevel"];
	$s16 = $row2["UserGrade"];
        $s17 = $row2["WorkType"];
	$s18 = $row2["OPSType"];
	$s19 = $row2["Department"];
        $s20 = $row2["Sex"];
	$s21 = $row2["MaritalStatus"];
        $s22 = $row2["ProbativeDate"]->format('Y-m-d H:i:s');
        $s23 = $row2["VacationDate"]->format('Y-m-d H:i:s');
	$s24 = $row2["Vocation"];
	$s25 = $row2["VocationPluse"];
        $s26 = $row2["VocationUse"];
	$s27 = $row2["Approver1"];
	$s28 = $row2["Approver2"];
        $s29 = $row2["Email"];
	$s30 = $row2["Telphone"];
	$s31 = $row2["LoginFlag"];
        $s32 = $row2["LockFlag"];
	$s33 = $row2["DelFlag"];
        $s34 = $row2["LoginDate"]->format('Y-m-d H:i:s');
        $s35 = $row2["LogoutDate"]->format('Y-m-d H:i:s');
	$s36 = $row2["CreateUser"];
        $s37 = $row2["CreateDate"]->format('Y-m-d H:i:s');
        $s38 = $row2["LastEditUser"];
        $s39 = $row2["LasteditDate"]->format('Y-m-d H:i:s');
        $s40 = $row2["F40"];
	$a1[] = "INSERT INTO tblUsers(UserID,Password,UserGroup,Plant,PlantDetails,EmployeeID,PrefixT,FirstNameT,LastNameT,PrefixE,FirstNameE,LastNameE,HireDate,Positions,UserLevel,UserGrade,WorkType,OPSType,Department,Sex,MaritalStatus,ProbativeDate,VacationDate,Vocation,VocationPluse,VocationUse,Approver1,Approver2,Email,Telphone,LoginFlag,LockFlag,DelFlag,LoginDate,LogoutDate,CreateUser,CreateDate,LastEditUser,LasteditDate,F40) VALUES('".$s1."','".$s2."','".$s3."','".$s4."','".$s5."','".$s6."','".$s7."','".$s8."','".$s9."','".$s10."','".$s11."','".$s12."','".$s13."','".$s14."','".$s15."','".$s16."','".$s17."','".$s18."','".$s19."','".$s20."','".$s21."','".$s22."','".$s23."','".$s24."','".$s25."','".$s26."','".$s27."','".$s28."','".$s29."','".$s30."','".$s31."','".$s32."','".$s33."','".$s34."','".$s35."','".$s36."','".$s37."','".$s38."','".$s39."','".$s40."')"; 
//print_r($a1);echo "<br/>";
}
	for ($x = 2;$x <= count($data->sheets[$s]["cells"]);$x++) {
		for($i=1;$i<=13;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12)
                        {
                            continue;
                        }
                            $arr3[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql3 = "%s";
                        $v1 = vsprintf($sql3,$arr3);
                        $d1 = date_create($v1)->format('Y-m-d H:i:s');
                for($i=1;$i<=22;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21)
                        {
                            continue;
                        }
                            $arr4[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql4 = "%s";
                        $v2 = vsprintf($sql4,$arr4);
                        $d2 = date_create($v2)->format('Y-m-d H:i:s');
                for($i=1;$i<=23;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21 || $i == 22)
                        {
                            continue;
                        }
                            @$arr5[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql5 = "%s";
                        $v3 = vsprintf($sql5,$arr5);
                        $d3 = date_create($v3)->format('Y-m-d H:i:s');
                for($i=1;$i<=34;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21 || $i == 22 || $i == 23 || $i == 24 || $i == 25 || $i == 26 || $i == 27 || $i == 28 || $i == 29 || $i == 30 || $i == 31 || $i == 32 || $i == 33)
                        {
                            continue;
                        }
                            @$arr6[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql6 = "%s";
                        $v4 = vsprintf($sql6,$arr6);
                        $d4 = date_create($v4)->format('Y-m-d H:i:s');
                for($i=1;$i<=35;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21 || $i == 22 || $i == 23 || $i == 24 || $i == 25 || $i == 26 || $i == 27 || $i == 28 || $i == 29 || $i == 30 || $i == 31 || $i == 32 || $i == 33 || $i == 34)
                        {
                            continue;
                        }
                            @$arr7[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql7 = "%s";
                        $v5 = vsprintf($sql7,$arr7);
                        $d5 = date_create($v5)->format('Y-m-d H:i:s');
                for($i=1;$i<=37;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21 || $i == 22 || $i == 23 || $i == 24 || $i == 25 || $i == 26 || $i == 27 || $i == 28 || $i == 29 || $i == 30 || $i == 31 || $i == 32 || $i == 33 || $i == 34 || $i == 35 || $i == 36)
                        {
                            continue;
                        }
                            @$arr8[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql8 = "%s";
                        $v6 = vsprintf($sql8,$arr8);
                        $d6 = date_create($v6)->format('Y-m-d H:i:s');
                for($i=1;$i<=39;$i++){
                    if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 20 || $i == 21 || $i == 22 || $i == 23 || $i == 24 || $i == 25 || $i == 26 || $i == 27 || $i == 28 || $i == 29 || $i == 30 || $i == 31 || $i == 32 || $i == 33 || $i == 34 || $i == 35 || $i == 36 || $i == 37 || $i == 38)
                        {
                            continue;
                        }
                            @$arr9[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }
                        $sql9 = "%s";
                        $v7 = vsprintf($sql9,$arr9);
                        $d7 = date_create($v7)->format('Y-m-d H:i:s');
                for($i=1;$i<=40;$i++){
                    if($i == 13 || $i == 22 || $i == 23 || $i == 34 || $i == 35 || $i == 37 || $i == 39)
                        {
                            continue;
                        }
                            @$arr2[$i] =  $data->sheets[$s]["cells"][$x][$i];
                        }     
		$sql2 = "INSERT INTO tblUsers(UserID,Password,UserGroup,Plant,PlantDetails,EmployeeID,PrefixT,FirstNameT,LastNameT,PrefixE,FirstNameE,LastNameE,HireDate,Positions,UserLevel,UserGrade,WorkType,OPSType,Department,Sex,MaritalStatus,ProbativeDate,VacationDate,Vocation,VocationPluse,VocationUse,Approver1,Approver2,Email,Telphone,LoginFlag,LockFlag,DelFlag,LoginDate,LogoutDate,CreateUser,CreateDate,LastEditUser,LasteditDate,F40) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','".$d1."','%s','%s','%s','%s','%s','%s','%s','%s','".$d2."','".$d3."','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','".$d4."','".$d5."','%s','".$d6."','%s','".$d7."','%s')";
		$v = vsprintf($sql2,$arr2);
                //echo $v;echo "<br/>";
		$a2[] = $v;
                //print_r($a2);echo "<br/>";
}
$z1 = array_diff($a2,$a1);echo "<br/>";
//print_r(array_diff($a2,$a1));echo "<br/>";
foreach($z1 as $z2/*value*/){
	//echo $z2;echo "<br/>";
	$sqlquery2 = sqlsrv_query($conn, $z2, $params, $options);      
        if( $sqlquery2 === false ) { die( print_r( sqlsrv_errors(), true));}
	}
        
        header("location:Main.php");
sqlsrv_close($conn);
?>