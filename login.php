
<?php

?>
<?php
if(isset($_POST['cancel'])){
	header('Location: index.php');
	die();
}

$num = 0;
$cat = "None";

if(isset($_POST['email']) && isset($_POST['pass'])){
	if(isset($_POST['category'])){
		$cat = $_POST['category'];
		if($cat == "student"){
			$num = 1;
		}
		if($cat == "faculty"){
			$num = 2;
		}
		if($cat == "admin"){
			$num = 3;
		}
		else{
			echo "Not found";
		}
	}
	else{
		$_SESSION['error'] = 'Please select a category and proceed';
		header("Location: login.php");
		die();
	}
	if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = 'Enter the email id and password';
        header("Location: login.php");
        die();
    }
	if(strpos($_POST['email'],'@') === false){
		$_SESSION['error'] = 'Please enter a valid Email address containing @';
		header("Location: login.php");
		die();
	}
	$stmt = $pdo->prepare("SELECT * FROM login where email = :xyz");
	$stmt->execute(array(":xyz" => $_POST['email']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row === false){
		$_SESSION['error'] = 'EmailID not found';
		header("Location: login.php");
		die();
	}
	if(!($row['cat'] == $num)){
		$_SESSION['error'] = 'Select the correct category';
		header("Location: login.php");
		die();
	}
	else{
		if($row['pass'] == $_POST['pass']){
			$name = $row['name'];
			$_SESSION['user_cat'] = $num;
			$_SESSION['name'] = $name;
			header("Location: main.php");
			die();
		}
		else{
			$_SESSION['error'] = 'Enter the correct password';
			header("Location: login.php");
			die();
		}
	}
}

if (isset($_SESSION['error']) ) {
    echo '<div class="alert alert-primary" role="alert">'.$_SESSION['error']."</div>\n";
    unset($_SESSION['error']);
}
?>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Login Page</title>
</head>
<body>
	<center><div class="container" style="margin: 100px;padding-left: : 50px">
<h1>Please Log In</h1>
<form method="post" action="login.php">
	    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" >
        <label class="btn btn-outline-primary" for="option1">Student</label>
        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" >
        <label class="btn btn-outline-primary" for="option2">Faculty</label>
        <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" >
        <label class="btn btn-outline-primary" for="option3">Admin</label><br>
        <br>
        <div class="form-floating col-5">
        	   <input type="email" class="form-control" id="floatingInput" placeholder="name@gmail.com">
               <label for="floatingInput">Email address</label>         
        </div>
        <br>
        <div class="form-floating col-5">
               <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
               <label for="floatingPassword">Password</label>
        </div>
		<br>
		<input class="btn btn-outline-success" type="submit" name ="login" value="Log In">
		<input class="btn btn-outline-danger" type="submit" name="cancel" value="Cancel">
</form>
</div>
</center>
</body>
</html>