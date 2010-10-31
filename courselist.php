<html>
<!--
Author: Hanna Palmerton
A page that lists the courses from the database
-->
<head>
<title>Capstone</title>

<link rel="stylesheet" type="text/css" href="default.css">

</head>
<body>

<table id="header">
    <tr valign='top'>
        <td><img src='somLogo.gif' alt="Userpic" height='50px'></td>
    </tr>
</table>

<ul id="tabmenu">
    <li><a href="index.html">Student</a></li>
    <li><a class="active" href="courselist.php">Administrator</a></li>
</ul>

<div id="content">
    
<?php
    //Set up db connection and select db
    include("db_connect.php");
    $con = getConnection();
    selectDB($con); 

    //Enter classes' information into report table
    echo '<br><br>
            <table id="studentsched" class="schedule">
            <th class="invishead"></th><th>Code</th><th>Session</th><th>Faculty</th><th>Date</th><th>Day</th><th>Start time</th><th>End time</th><th>Credit hours</th>';

    $counter = 0;
    $result = mysql_query("SELECT * FROM Classes");
    while($class = mysql_fetch_array($result)){
        if($counter%2 == 0){ echo '<tr>'; }
        else{ echo '<tr id="altbackground">'; }
        
        echo '<td id="studschedinvis"><input type="checkbox" name="checkbox[]"></input></td>
                <td>' . $class['ClassCode'] . '</td>
                <td>' . $class['ClassName'] . '</td>
                <td>' . $class['Faculty'] . '</td>';
                
        //Split date from StartTime, EndTime
        $startTime = $class['StartTime'];
        $endTime = $class['EndTime'];
        $date = substr($startTime, 0, 10);
        $startTime = substr($startTime, 11, strlen($startTime));
        $endTime = substr($endTime, 11, strlen($endTime));
        
        //Define day of week
        $weekDay = date(l, mktime(0, 0, 0, substr($date, 6, 7), substr($date, 9, 10), substr($date, 0, 4)));
        
        echo '<td>' . $date . '</td>
                <td>' . $weekDay . '</td>
                <td>' . $startTime . '</td>
                <td>' . $endTime . '</td>
                <td id="schedhours">' . (float)$class['CreditHrs'] . '</td></tr>';
                
        $counter++;
    }

    echo '</table>';
    echo '<div id="dbadd">
            &nbsp;<form action="add_class.php"><input type="submit" value="ADD A COURSE" id="addsearchbutton"></form>
            &nbsp;<input type="submit" value="EDIT A SELECTED COURSE" name="delete" id="addsearchbutton">
            &nbsp;<input type="submit" value="DELETE SELECTED COURSE(S)" id="addsearchbutton">
            &nbsp;<form action="adminreport.html"><input type="submit" value="RETURN TO ADMIN HOME" id="addsearchbutton"></form>
            </div>';
?>

</div>
</body>
</html>