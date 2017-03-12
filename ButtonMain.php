
<?php if ($_SESSION["UserGroup"] == "1") { ?>               
    <!-- User -->
    <div align="center"><input  class="button" value="Apply Leave" onclick="window.location = 'RF_Leave.php'">
    <input class="button" value="View Leave" onclick="window.location = 'V_Leave.php'"></div>
<?php } ?>
<!-- Admin -->
<?php if ($_SESSION["UserGroup"] == "9") { ?>    
    <div align="center"><input class="button" value="Apply Leave" onclick="window.location = 'RF_Leave.php'"> <input class="button" value="View Leave" onclick="window.location = 'V_Leave.php'"><br></div>
    <div align="center"><input class="button" value="Maintenance" onclick="window.location = 'MTN.php'"> <input class="button" value="Import" onclick="window.location = 'ImportExcle.php'"><br></div>
    <div align="center"><input class="button" value="Appover" onclick="window.location = 'V_LeaveAppover.php'"> <input class="button" value="Apply Leave Others" onclick="window.location = 'S_Appove.php'"><br></div>
    <div align="center"><input class="button" value="HR View Leave" onclick="window.location = 'HR_VLeave.php'"> <input class="button" value="View Report" onclick="window.location = 'HR_VReport.php'"><br></div>
    <br/>
<?php } ?>
<!-- Super  -->
<?php if ($_SESSION["UserGroup"] == "4") { ?>   
    <div align="center">
        <input class="button" value="Apply Leave" onclick="window.location = 'RF_Leave.php'">  
        <input class="button" value="View Leave" onclick="window.location = 'V_Leave.php'">
        <input class="button" value="Appover" onclick="window.location = 'V_LeaveAppover.php'">
        <input class="button" value="Apply Leave Others" onclick="window.location = 'S_Appove.php'">
    </div>
<?php } ?>
<!-- HR -->
<?php if ($_SESSION["UserGroup"] == "7") { ?>   
    <div align="center">
        <input class="button" value="Apply Leave" onclick="window.location = 'RF_Leave.php'">  
        <input class="button" value="View Leave" onclick="window.location = 'V_Leave.php'">
    </div>
    <div align="center">
        <input class="button" value="HR View Leave" onclick="window.location = 'HR_VLeave.php'">
        <input class="button" value="View Report" onclick="window.location = 'HR_VReport.php'">
    </div>
    <div align="center">
        <input class="button" value="Import" onclick="window.location = 'ImportExcle.php'">
    </div>
<?php } ?>