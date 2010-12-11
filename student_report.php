<?php
	session_start();
	include('db_connect.php');
	include('ClassGateway.php');
	include('LDAPHelper.php');
	include('StudentClassGateway.php');
	include('TM.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<script src="util.js" type="text/javascript"></script>
		<script type="text/javascript">
			window.onload = function(){
			
			}
		</script>
	</head>
	<body>
		<form action="student_edit.php" method="post">
			<input type="text" name="onyen" />
			<input type="text" name="classcode" />
			<input type="submit" name="action" value="Add" />
			<input type="submit" name="action" value="Delete" />
		</form>
		<form action = "student_report.php" />
			<select name="searchtype">
				<option value="lesshrs"> Hours less then </option>
				<option value="namelike"> Name </option>
			</select>
			<input type="text" name="filtertext" />
			<input type="submit" value="Search" />
		</form> 
		<?php
			selectDB(getConnection());
			$a = StudentClassGateway::selectAllStudentClasses();
			$studentclasses = $a[0];
			$sortedList = $a[1];
			foreach ($sortedList as $onyen => $lastname){
				$name = LDAPHelper::getName($onyen);
				$classcodes = $studentclasses[$onyen];
				$hrs = 0;
				foreach($classcodes as $code){
					$class = ClassGateway::selectClassByClassCode($code);
					$classes[] = $class;
					$hrs = $hrs + $class['CreditHrs'];
				}
				echo"
				<table>
					<tr>
					<td> $onyen </td>
					<td> <a href=\"javascript:void();\" onclick=\"show_hide('$onyen')\"> $name </a>
					<td> $hrs </td>
					</tr>
				</table>
				";
			}
		?>
		
	</body>
</html>