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
	</head>
	<body>
		<form action="student_edit.php" method="post">
			<input type="text" name="onyen" />
			<input type="text" name="classcode" />
			<input type="submit" name="action" value="Add" />
			<input type="submit" name="action" value="Delete" />
		</form>
		<form action = "student_report.php" method="post"/>
			<select name="searchtype">
				<option value="nofilter"> No Filter </option>
				<option value="onyen"> Onyen </option>
				<option value="name"> Name </option>
				<option value="lesshrs"> Hours less than or equal to </option>
				<option value="greaterhrs"> Hours greater than or equal to </option>
				<option value="equalhrs"> Hours equal to </option>
			</select>
			<input type="text" name="filtertext" />
			<input type="submit" value="Filter" />
		</form> 
		<?php
			selectDB(getConnection());
			function filter($onyen, $name, $hrs){
				if(!isset($_POST['searchtype'])){
					return False;
				}else{
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
				if(!$filter){
				echo"
					<table border =\"1\">
						<tr>
						<td> $onyen </td>
						<td> <a href=\"javascript:void();\" onclick=\"\"> $name </a>
						<td> $hrs </td>
						</tr>
					</table>
					";
				}
			}
			if(!$resultgiven){
				echo 'No Results <br />';
			}
		?>
		
	</body>
</html>