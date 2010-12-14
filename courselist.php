<?php        
	session_start();
	if(!isset($_SESSION['adminonyen'])){
		header('Location: adminlogin.html');
	}
        include error_reporting(0);
?>
<html>
<!--
Author: Hanna Palmerton
A page that lists the courses from the database
-->
<head>
<title>Capstone</title>

<link rel="stylesheet" type="text/css" href="default.css">

<!--Modified code by Kiran Pai, from codetoad.com-->
<SCRIPT LANGUAGE = "JavaScript">

var totalboxes;

function setCount(count, target){
 
totalboxes=count;

if(target == 0) document.myform.action="add_class.php";
if(target == 1) document.myform.action="edit_class.php";
if(target == 2) document.myform.action="delete_class.php"; 
 
}

function isReady(form) {

if(totalboxes == -1) return true;

var c = form['boxes[]'];    
for(var x=0 ; x<totalboxes ; x++){
    //If even one box is checked then return true
    if(c[x].checked) return true;
}     
    
//Default: When even one was not checked then...
alert("Please check at least one checkbox.");    
return false;

}

</SCRIPT>

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
    echo '<form action="admintools.php"><input type="submit" value="ADMIN HOME" id="addsearchbutton"></form><br><br>
            <table id="studentsched" class="schedule">
            <th class="invishead"></th><th>Code</th><th>Session</th><th>Faculty</th><th>Date</th><th>Day</th><th>Start time</th><th>End time</th><th>Standard grace</th><th>Credit hours</th>';
    echo '<FORM onSubmit="return isReady(this)" METHOD="post" NAME="myform" ACTION="">';
    
    include("TM.php");
    $counter = 0;
    $result = mysql_query("SELECT * FROM Classes");
    while($class = mysql_fetch_array($result)){
        if($counter%2 == 0){ echo '<tr>'; }
        else{ echo '<tr id="altbackground">'; }
        
        echo '<td id="studschedinvis"><input type="checkbox" value="' . $class['ClassCode'] . '" name="boxes[]"></input></td>
                <td>' . $class['ClassCode'] . '</td>
                <td>' . $class['ClassName'] . '</td>
                <td>' . $class['Faculty'] . '</td>';
                
        //Split date from StartTime, EndTime
        $startTime = $class['StartTime'];
        $endTime = $class['EndTime'];
        $date = substr($startTime, 0, 10);
        
        //Define times
        $st_split = explode(" ", $startTime);
        $et_split = explode(" ", $endTime);
        $st_12Hr = TM::changeTo12Hr($st_split[1]);
        $et_12Hr = TM::changeTo12Hr($et_split[1]);
                
        //Define day of week
        $weekDay = TM::getDayOfWeek($startTime);
        
        //Grace period
        $grace = $class['Grace'];
        if($grace == 1){ $graceValue = "15 minutes"; }
        else{ $graceValue = "All day"; }
        
        echo '<td>' . $date . '</td>
                <td>' . $weekDay . '</td>
                <td>' . $st_12Hr[0] . ' ' . $st_12Hr[1] . '</td>
                <td>' . $et_12Hr[0] . ' ' . $et_12Hr[1] . '</td>
                <td>' . $graceValue . '</td>
                <td id="schedhours">' . (int)$class['CreditHrs'] . '</td></tr>';
                
        $counter++;
    }

    echo '</table>';
    echo '<div id="addsearch">
            &nbsp;<input onClick="setCount(-1,0)" type="submit" value="ADD A CLASS" id="addsearchbutton"></input>
            &nbsp;<input onClick="setCount(' . $counter . ',1)" type="submit" value="EDIT A SELECTED CLASS" id="addsearchbutton"></input>
            &nbsp;<input onClick="setCount(' . $counter . ',2)" type="submit" value="DELETE SELECTED CLASS(ES)" id="addsearchbutton"></input>
            </div>
            </FORM>';
?>

</div>
</body>
</html>