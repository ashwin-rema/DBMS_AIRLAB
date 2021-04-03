<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
	<title>Confirm Delete</title>
</head>
<body>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<?php
	if(isset($_POST['back'])){
		header("Location: delete_index.php");
		return;
	}
	if($_SESSION['table'] == "Moudetails"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM MoU_Details where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
			unset($_SESSION['table']);
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "private"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM Private_Cloud where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
			unset($_SESSION['table']);
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning"  type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "funds"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM Funds_Generated where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
			unset($_SESSION['table']);
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "datacenter"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM Cloud_Data_Center where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "serverconfig"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM AIR_Lab_Server where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "security"){
		if(isset($_POST['delete'])){
			if(isset($_POST['fno'])){
				$stmt = $pdo->prepare("DELETE FROM Device_with_statistics where Device_ID = :xyz AND F_ID = :fno");
				$stmt->execute(array(":xyz" => $_POST['value'],
									 ":fno" => $_POST['fno']));
			}
			else{
			    $stmt = $pdo->prepare("DELETE FROM Device_without_statistics where Device_ID = :xyz");
				$stmt->execute(array(":xyz" => $_POST['value']));
			}
			try{
				$stmt = $pdo->prepare("DELETE FROM Devices where Device_ID = :xyz");
				$stmt->execute(array(":xyz" => $_POST['value']));
				$_SESSION['success'] = 'Record deleted';
				header( 'Location: main.php');
				return;
			}
			catch(Exception $e){
				$_SESSION['success'] = 'Required record deleted';
				$_SESSION['error'] = "Warning: The device is still in the devices table";
				header( 'Location: main.php');
				return;
			}
		}
		if(isset($_GET['f_id'])){
			echo '<h1>Confirm Delete?</h1>';
			echo '<form method = "post">
				<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
				<input class="btn btn-outline-Info" type="hidden" name="fno" value="'.htmlentities($_GET['f_id']).'">
	        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
	        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
		}
		else{
			echo '<h1>Confirm Delete?</h1>';
			echo '<form method = "post">
				<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
	        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
	        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	    }
		/*$_SESSION['error'] = 'Impossible to delete the records of Security Infrastructure.';
		header( 'Location: main.php' );
		return;*/
	}
	elseif($_SESSION['table'] == "research"){
		if(isset($_POST['delete'])){
			$stmt = $pdo->prepare("DELETE FROM Concepts_research where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
			$stmt = $pdo->prepare("DELETE FROM Research where SNo = :xyz");
			$stmt->execute(array(":xyz" => $_POST['value']));
			$_SESSION['success'] = 'Record deleted';
		    header( 'Location: main.php' );
		    return;
		}
		echo '<h1>Confirm Delete?</h1>';
		echo '<form method = "post">
			<input class="btn btn-outline-Info" type="hidden" name="value" value="'.htmlentities($_GET['rec_id']).'">
        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
	}
	elseif($_SESSION['table'] == "project"){
		if(isset($_POST['delete'])){
			if(isset($_POST['rollnum'])){
				$stmt = $pdo->prepare("DELETE FROM batch_students where Batch_No = :val and Roll_no = :roll");
				$stmt->execute(array(":val" => $_POST['batchnum'],
									 ":roll" => $_POST['rollnum']));
				$_SESSION['success'] = 'Record deleted';
			    header( 'Location: main.php' );
			    return;
			}
			else{
				$stmt = $pdo->prepare("DELETE FROM batches where Batch_No = :val");
				$stmt->execute(array(":val" => $_POST['batchnum']));
				$_SESSION['success'] = 'Record deleted';
			    header( 'Location: main.php' );
			    return;
			}
		}
		if(isset($_GET['rno'])){
			echo '<h1>Confirm Delete?</h1>';
			echo '<form method = "post">
				<input class="btn btn-outline-Info" type="hidden" name="batchnum" value="'.htmlentities($_GET['rec_id']).'">
				<input class="btn btn-outline-Info" type="hidden" name="rollnum" value="'.htmlentities($_GET['rno']).'">
	        	<input class="btn btn-outline-Success" type="submit" name="delete" value="Delete"></p>
	        	<input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>';
		}
		else{
			echo '<h1>Confirm Delete?</h1>';
			echo '<form method = "post">
				<input class="btn btn-outline-Info"  type="hidden" name="batchnum" value="'.htmlentities($_GET['rec_id']).'">
	        	<input class="btn btn-outline-Success"  type="submit" name="delete" value="Delete"></p>
	        	<input class="btn btn-outline-Warning"  type="submit" name="back" value="Back"></p>';
		}
	}
	else{
		$_SESSION['error'] = "Error occured. Please log in again";
		header("Location: main.php");
		return;
	}
?>
</body>
</html>