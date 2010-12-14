<?php
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
	include('LDAPHelper.php');
	include('StudentClassGateway.php');
	include('TM.php');
        include error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"<html>
<head>
<title>Capstone</title>

<meta http-equiv="Content-Type" content="text/html">

<!--Modified code, originally written by COBOLdinosaur on snippets.dzone.com, "Expand and collapse effect for data grids"-->
<script type="text/javascript"> 
    var ELpntr=false;
    function hideall() {
        locl = document.getElementsByName('schedule');
        for (i=0;i<locl.length;i++) {
            locl[i].style.display='none';
        }
    }

    function showHide(EL,PM)
    {
        ELpntr=document.getElementById(EL);
        if (ELpntr.style.display=='none')
        {
            document.getElementById(PM);
            ELpntr.style.display='block';
        }
        else
        {
            document.getElementById(PM);
            ELpntr.style.display='none';
        }
    }
    onload=hideall;
</script>
<script type = "text/javascript" src="validate.js"></script>

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
    <li><a class="active" href="adminreport.php">Administrator</a></li>
</ul>

<div id="content">

<div id="addsearch" align="right">

<form action="student_edit.php" method="post" onsubmit="return validate_form( this )">
    <input type="text" id="addsearchtext" value="Onyen">
        &nbsp;<input type="text" id="addsearchtext" value="Class code">
        &nbsp;<input type="submit" value="Add" name="action" id="addsearchbutton">
        &nbsp;<input type="submit" value="Delete" name="action" id="addsearchbutton">
</form>

    <br><form action="adminreport.php" method="post" align="right">
        <select name="searchtype" style="color: color: #103d66;">
            <option value="nofilter">No filter</option>
            <option value="onyen">Student onyen</option>
            <option value="name">Student name</option>
            <option value="greaterhrs">Student hours greater than or equal to</option>
            <option value="lesshrs">Student hours less than or equal to</option>
            <option value="equalhrs">Student hours equal to</option>
        </select>
    <input type="text" name="filtertext" id="addsearchtext">&nbsp;<input type="submit" value="FILTER" id="addsearchbutton">
    </form>
</div>

<?php

    $adminonyen = $_SESSION['adminonyen'];
    $adminname = LDAPHelper::getName($adminonyen);
    
    echo '<form action="admintools.php"><input type="submit" value="ADMIN HOME" id="addsearchbutton"></form><br><br>
            <table id="adminreport">
                <tr>
                    <td id="admin">' . $adminname . '</td>
                </tr>
                <tr class="vis">
                    <th id="pid">Onyen</th>
                    <th id="name">Student name <span style="font-weight: normal;">(Click on name to expand/collapse)</span></th>
                    <th id="hours">Hours</th>
                </tr>
            </table>';
            
    selectDB(getConnection());
    function filter($onyen, $name, $hrs){
        if(!isset($_POST['searchtype'])){
            return False;
        }
        else{
            $filterType = $_POST['searchtype'];
            $filterString = $_POST['filtertext'];
            if($filterType == 'nofilter')
                    return False;
            elseif($filterType =='onyen')
                    return strpos(strtolower($onyen), strtolower($filterString)) === False;
            elseif($filterType =='name')
                    return strpos(strtolower($name), strtolower($filterString)) === False;
            elseif($filterType =='lesshrs')
                    return $hrs > (int)$filterString;
            elseif($filterType=='greaterhrs')
                    return $hrs < (int)$filterString;
            elseif($filterType=='equalhrs')
                    return $hrs != (int)$filterString;
            else
                    return False;					
        }
    }
//  Snagged by javierarce, from Snipplr
    function getUniqueCode($length = "") {	
	$code = md5(uniqid(rand(), true));
	if ($length != "") return substr($code, 0, $length);
	else return $code;
    }
    $a = StudentClassGateway::selectAllStudentClasses();
    $studentclasses = $a[0];
    $sortedList = $a[1];
    $resultgiven = False;
    foreach ($sortedList as $onyen => $lastname){
            $name = LDAPHelper::getName($onyen);
            $classcodes = $studentclasses[$onyen];
            $hrs = 0;
            foreach($classcodes as $code){
                    $class = ClassGateway::selectClassByClassCode($code);
                    $classes[] = $class;
                    $hrs = $hrs + $class['CreditHrs'];
            }
            $filter = filter($onyen, $name, $hrs);
            $resultgiven = $resultgiven || !$filter;
            $str1 = getUniqueCode(6);
            $str2 = getUniqueCode(6);
            if(!$filter){
                echo '<table id="adminreport">
                        <tr class="vis">
                            <td id="pid">' . $onyen . '</td>
                            <td id="name"><a href="#" onclick="showHide(\'' . $str1 . '\',\'' . $str2 . '\')"><span id="' . $str2 . '">' . $name . '</span></td>
                            <td id="hours">' . $hrs . '</td>
                        </tr>
                        
                        <table id="' . $str1 . '" class="schedule" name="schedule" style="width: 80%; margin-left: 20%; margin-top: 4px; margin-bottom: 4px;">
                            <tr><th>Code</th><th>Session(s) attended</th><th>Faculty</th><th>Date and time</th><th>Credit hours</th>';
                            
                $studentClasses = StudentClassGateway::selectStudentClassesByOnyen($onyen);
                foreach($studentClasses as $sc){
                    $class = ClassGateway::selectClassByClassCode($sc['ClassCode']);
                    $et_split = explode(" ", $class['EndTime']);
                    $newET = TM::getStandardTime($et_split[1]);

                    echo '<tr><td>' . $class['ClassCode'] . '</td><td>' . $class['ClassName'] . '</td><td>' . $class['Faculty'] . '</td><td>' . TM::getStandardDateAndTime($class['StartTime']) . '-' . $newET . $et_12Hr[1] . '</td><td id="schedhours">' . $class['CreditHrs'] . '</td></tr>';
                }
                echo '</table>
                    </table>';
            }
    }
    if(!$resultgiven){
        echo '';
    }
?>
		
</div>

</body>
</html>