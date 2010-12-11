<html>
<!--
Author: Logan Wilkerson
A page to add a class into the database
-->
<head>
<title>Capstone</title>
<script type = "text/javascript"src="validate.js"></script>
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
    <li><a class="active" href="addacourse.html">Administrator</a></li>
</ul>

<div id="content">

<br><br><table id="dbtable">
    <tr><td>ADD A COURSE</td></tr></table><br>

<form id="addclassform" name="classForm" action="class_ver.php" onsubmit = 'return validate_form( this )' method="post"><br>
<label>Session:</label><input type="text" name="classname" title="Class Name" value=""><br>
<label>Faculty:</label><input type="text" name="faculty" title="Faculty" value=""><br>
<label>Date:</label><input class="dateinput" type="text" name="year" title="Year" value="yyyy">
                    <input class="dateinput" type="text" name="month" title="Month" value="mm">
                    <input class="dateinput" type="text" name="day" title="Day" value="dd"><br>
<label>Start time:</label><input type="text" class="timeinput" name="starttimehr" title="Start time Hour" value="hh">
                    <input class="timeinput" type="text" name="starttimemin" title="Start Time Minute" value="mm">
                    &nbsp;<input type="radio" name="amstart" value=True> AM
                    &nbsp;&nbsp;<input type="radio" name="amstart" value=False> PM<br>
<label>End time:</label><input type="text" class="timeinput" name="endtimehr" title="End Time Hour" value="hh"> 
                    <input type="text" class="timeinput" name="endtimemin" title="End Time Minute" value="mm">
                    &nbsp;<input type="radio" name="amend" value=True> AM
                    &nbsp;&nbsp;<input type="radio" name="amend" value=False> PM<br>
<label>Credit hours:</label><input type="text" name="credits" title="Credits"><br><br>
<label></label><input type="submit" value="ADD COURSE" id="addsearchbutton">
</form>

<div id="dbadd"><form action="courselist.php"><input type="submit" value="RETURN TO COURSELIST" id="addsearchbutton"></form></div>
        
</div>
</body>
</html>