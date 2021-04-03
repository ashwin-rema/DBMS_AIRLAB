<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
	<title>Main Page</title>
</head>
<body>
<?php 
if(isset($_POST['logout'])){
	header("Location: logout.php");
	return;
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}

if(isset($_POST['submit'])){
	if(isset($_POST['table']) || isset($_POST['operation'])){
		if(!isset($_POST['table'])){
			$_SESSION['error'] = "Please select a table";
			header("Location: main.php?");
			return;
		}
		elseif(!isset($_POST['operation'])){
			$_SESSION['error'] = "Please select an operation";
			header("Location: main.php?");
			return;
		}

		if($_POST['table'] == "project"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "research"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "Moudetails"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "funds"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "private"){
			$_SESSION['table'] =$_POST['table'];
		}
		elseif($_POST['table'] == "datacenter"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "security"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "serverconfig"){
			$_SESSION['table'] = $_POST['table'];
		}
		else{
			$_SESSION['error'] = "Please select a table";
			header("Location: main.php");
			return;
		}

		if($_POST['operation'] == "insert"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: insert.php");
			return;
		}
		elseif($_POST['operation'] == "delete"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: delete_index.php");
			return;
		}
		elseif($_POST['operation'] == "update"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: edit_index.php");
			return;
		}
		elseif($_POST['operation'] == "read"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: read.php");
			return;
		}
		else{
			$_SESSION['error'] = "Please select an operation";
			header("Location: main.php?");
			return;
		}
	}
	else{
		$_SESSION['error'] = "Please select a table or category";
		header("Location: main.php?");
		return;
	}
}


if(!(isset($_SESSION['name']) && isset($_SESSION['user_cat']))){ 
		$_SESSION['error'] = "Required parameters not available. Please Log in again";
		header("Location: index.php");
		return;
}
?>

<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
    //var_dump($_SESSION);
}
?>

<div class="container">
<?php
echo '<h1>Welcome to AIR LAB Website'." - ".$_SESSION['name']." ".'</h1>';
?>
<div>
	<h3>Select an operation: </h3>
</div>
<?php
if($_SESSION['user_cat'] == 3){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio" id="ins" name="operation" value="insert">
		<label for="ins">Insert</label><br>
		<input type="radio" id="upd" name="operation" value="update">
		<label for="upd">Update</label><br>
		<input type="radio" id="del" name="operation" value="delete">
		<label for="del">Delete</label><br>
		<input type="radio" id="rea" name="operation" value="read">
		<label for="rea">Read</label>
	</div>
	<div>
		<h3>Tables available: </h3>
	</div>
	<div>
		<input type="radio" id="proj" name="table" value="project">
		<label for="proj">Project Table</label><br>
		<input type="radio" id="phd" name="table" value="research">
		<label for="research">Research Table</label><br>
		<input type="radio" id="Mou" name="table" value="Moudetails">
		<label for="Mou">Memorandum of Understanding Table</label><br>
		<input type="radio" id="fund" name="table" value="funds">
		<label for="fund">Funds Received Table</label><br>
		<input type="radio" id="priv" name="table" value="private">
		<label for="priv">Private Cloud Details Table</label><br>
		<input type="radio" id="data" name="table" value="datacenter">
		<label for="data">Cloud Data Center Table</label><br>
		<input type="radio" id="sec" name="table" value="security">
		<label for="sec">Security Infrastructure Table</label><br>
		<input type="radio" id="ser" name="table" value="serverconfig">
		<label for="ser">AIR LAB Server Configuration Table</label><br>
	</div>';
}
elseif ($_SESSION['user_cat'] == 2){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio" id="upd" name="operation" value="update">
		<label for="upd">Update</label><br>
		<input type="radio" id="rea" name="operation" value="read">
		<label for="rea">Read</label>
	</div>
	<div>
		<h3>Tables available: </h3>
	</div>
	<div>
		<input type="radio" id="proj" name="table" value="project">
		<label for="proj">Project Table</label><br>
		<input type="radio" id="phd" name="table" value="research">
		<label for="research">Research Table</label><br>
		<input type="radio" id="Mou" name="table" value="Moudetails">
		<label for="Mou">Memorandum of Understanding Table</label><br>
		<input type="radio" id="fund" name="table" value="funds">
		<label for="fund">Funds Received Table</label><br>
		<input type="radio" id="priv" name="table" value="private">
		<label for="priv">Private Cloud Details Table</label><br>
		<input type="radio" id="data" name="table" value="datacenter">
		<label for="data">Cloud Data Center Table</label><br>
		<input type="radio" id="sec" name="table" value="security">
		<label for="sec">Security Infrastructure Table</label><br>
		<input type="radio" id="ser" name="table" value="serverconfig">
		<label for="ser">AIR LAB Server Configuration Table</label><br>
	</div>';
}
elseif($_SESSION['user_cat'] == 1){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio" id="rea" name="operation" value="read">
		<label for="rea">Read</label>
	</div>
	<div>
		<h3>Tables available: </h3>
	</div>
	<div>
		<input type="radio" id="proj" name="table" value="project">
		<label for="proj">Project Table</label><br>
		<input type="radio" id="phd" name="table" value="research">
		<label for="research">Research Table</label><br>
		<input type="radio" id="Mou" name="table" value="Moudetails">
		<label for="Mou">Memorandum of Understanding Table</label><br>
		<input type="radio" id="fund" name="table" value="funds">
		<label for="fund">Funds Received Table</label><br>
		<input type="radio" id="priv" name="table" value="private">
		<label for="priv">Private Cloud Details Table</label><br>
		<input type="radio" id="data" name="table" value="datacenter">
		<label for="data">Cloud Data Center Table</label><br>
		<input type="radio" id="sec" name="table" value="security">
		<label for="sec">Security Infrastructure Table</label><br>
		<input type="radio" id="ser" name="table" value="serverconfig">
		<label for="ser">AIR LAB Server Configuration Table</label><br>
	</div>';
}
?>
	<p>
		<input type="submit" name = "submit" value="Submit">
		<input type="submit" name = "logout" value="Log Out">
	</p>
</form>
</div>
</body>
</html>