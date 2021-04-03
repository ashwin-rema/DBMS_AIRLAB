<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
	<title>Read operation</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<center><div class="container" style="margin: 100px;padding-left: : 50px">
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<?php
	if(isset($_POST['back'])){
		header("Location: main.php");
		unset($_SESSION['table']);
		return;
	}
	if(isset($_SESSION['table'])){
		if($_SESSION['table'] == "Moudetails"){
			$stmt = $pdo->query("SELECT * FROM MoU_Details");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Outcome</th><th scope="col">MoU_Signal_with</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Outcome']));
			    echo("</td><td>");
			    echo(htmlentities($row['MoU_Signal_with']));
			    echo("</td></tr>\n");
			}
			echo '</table>';	
		}
		elseif($_SESSION['table'] == "private"){
			$stmt = $pdo->query("SELECT * FROM Private_Cloud");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Type</th><th scope="col">Capabilities</th><th scope="col">IaaS</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Cloud_Type']));
			    echo("</td><td>");
			    echo(htmlentities($row['Capabilities']));
			    echo("</td><td>");
			    echo(htmlentities($row['Iaas']));
			    echo("</td></tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "funds"){
			$stmt = $pdo->query("SELECT * FROM Funds_Generated");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Description</th><th scope="col">From_Year</th><th scope="col">To_Year</th><th scope="col">Grants_Received</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Description']));
			    echo("</td><td>");
			    echo(htmlentities($row['From_Year']));
			    echo("</td><td>");
				echo(htmlentities($row['To_Year']));
			    echo("</td><td>");
			    echo(htmlentities($row['Grants_Received']));
			    echo("</td></tr>\n");
			}
			echo '</table>';	
		}
		elseif($_SESSION['table'] == "datacenter"){
			$stmt = $pdo->query("SELECT * FROM Cloud_Data_Center");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Component_Name</th><th scope="col">Description</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			  
			    echo(htmlentities($row['Component_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Description']));
			    echo("</td></tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "serverconfig"){
			$stmt = $pdo->query("SELECT * FROM AIR_Lab_Server");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Name</th><th scope="col">HD</th><th scope="col">DVD</th><th scope="col">RAM</th><th scope="col">Processor</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['HD']));
			    echo("</td><td>");
			    echo(htmlentities($row['DVD']));
			    echo("</td><td>");
			    echo(htmlentities($row['RAM']));
			    echo("</td><td>");
			    echo(htmlentities($row['Processor']));
			    echo("</td><tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "security"){
			echo '<h1>Devices with Number of users and log values</h1>'; 
			$stmt = $pdo->query("SELECT Device_Name, No_of_Users, Logs, F_Name as Feature_Name FROM Devices d, Device_with_statistics s, Features f where d.Device_ID = s.Device_ID and s.F_ID = f.F_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Device_Name</th><th scope="col">F_Name</th><th scope="col">No_of_Users</th><th scope="col">Logs</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Device_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Feature_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['No_of_Users']));
			    echo("</td><td>");
			    echo(htmlentities($row['Logs']));
			    echo("</td></tr>\n");
			}
			echo '</table>';
			echo '<h1>Other devices</h1>';
			$stmt = $pdo->query("SELECT Device_Name, Quantity FROM Devices d, Device_without_statistics s where s.Device_ID = d.Device_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Device_Name</th><th scope="col">Quantity</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Device_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Quantity']));
			    echo("</td></tr>\n");
			}
			echo '</table>'; 
		}
		elseif($_SESSION['table'] == "research"){
			$stmt = $pdo->query("SELECT SNo, Title, Status, Faculty_Name FROM Faculty f, Research r where f.Faculty_ID = r.Faculty_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Faculty_Name</th><th scope="col">Title</th><th scope="col">Status</th><th scope="col">Concepts</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Faculty_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Title']));
			    echo("</td><td>");
			    echo(htmlentities($row['Status']));
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT C_Field FROM Concepts c, Concepts_research cr where cr.SNo = :param and cr.C_No = c.C_No");
			    $temp->execute(array(
        						':param' => $row['SNo']));
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo htmlentities($rowtemp['C_Field']).'    ';
			    }
			    echo("</td></tr>\n");
			}
			echo '</table>';
			echo '<p>';
			$temp = $pdo->query("SELECT C_Field, C_Title FROM Concepts c");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo  $rowtemp['C_Field'].' - '.$rowtemp['C_Title']."<br>";
			    }
			echo '</p>';
		}
		elseif($_SESSION['table'] = "project"){
			$stmt = $pdo->query("SELECT * FROM Faculty f, batches b, company c WHERE f.Faculty_ID = b.Faculty_ID AND c.Company_ID = b.Company_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Project Title</th><th scope="col">Roll number</th><th scope="col">Student Name</th><th scope="col">Faculty</th><th scope="col">Company</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Project_Title']));
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT Roll_No FROM batch_students bs where bs.Batch_No = :param");
			    $temp->execute(array(
        						':param' => $row['Batch_No']));
			    echo('<table>'."\n");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo '<tr><td>';
			    	echo htmlentities($rowtemp['Roll_No']);
			    	echo '</td></tr>';
			    }
			    echo ('</table>');
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT Student_Name FROM student s, batch_students bs where bs.Batch_No = :param and bs.Roll_No = s.Roll_Number");
			    $temp->execute(array(
        						':param' => $row['Batch_No']));
			    echo('<table>'."\n");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo '<tr><td>';
			    	echo htmlentities($rowtemp['Student_Name']);
			    	echo '</td></tr>';
			    }
			    echo '</table>';
			    echo("</td><td>");
			    echo(htmlentities($row['Faculty_Name'])); 
			    echo("</td><td>");
			    echo(htmlentities($row['Company_Name'])); 
			    echo("</td></tr>");
			}
			echo '</table>';
		}
	}
	else{
		$_SESSION['error'] = "Error occured. Please log in again";
		header("Location: main.php");
		return;
	}
?>
<form method="post">
<input class="btn btn-outline-success" type="submit" name = "back" value="Back">
	</div>
	</center>
</body>
</html>
