  
<?php
require_once "pdo.php";
session_start();?>
<html>
<head>
    <title>Record to be updated</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<?php
if (isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if(isset($_POST['back'])){
    header("Location: main.php");
    unset($_SESSION['device']);
    unset($_SESSION['table']);
    return;
}
if(isset($_SESSION['table']) && isset($_GET['rec_id'])){
	if($_SESSION['table'] == "Moudetails"){
		echo '<h1>Updating the record for table - '.$_SESSION['table'].'</h1>';
		if(isset($_POST['outcome']) && isset($_POST['MoUSignal'])){
            if (strlen($_POST['outcome']) < 1 || strlen($_POST['MoUSignal']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE mou_details SET Outcome = :out, MoU_Signal_with = :mousig WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':out' => $_POST['outcome'],
                ':mousig' => $_POST['MoUSignal']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
		$stmt = $pdo->prepare("SELECT * FROM mou_details where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p>Outcome:
        <input type="text" name="outcome" value = "'.htmlentities($row['Outcome']).'"></p>
        <p>MoU_Signal_with:
        <input class="btn btn-outline-Info" type="text" name="MoUSignal" value = "'.htmlentities($row['MoU_Signal_with']).'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
	}
	elseif($_SESSION['table'] == "private"){
        echo '<h1>Updating the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['cloud']) && isset($_POST['capab']) && isset($_POST['Iaas'])){
            if (strlen($_POST['cloud']) < 1 || strlen($_POST['capab']) < 1 || strlen($_POST['Iaas']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE private_cloud SET Cloud_Type = :cloud, Capabilities = :capab, Iaas = :iaas WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':cloud' => $_POST['cloud'],
                ':capab' => $_POST['capab'],
                ':iaas' => $_POST['Iaas']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM private_cloud where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p>Cloud_Type:
        <input class="btn btn-outline-Info" type="text" name="cloud" value="'.htmlentities($row['Cloud_Type']).'"></p>
        <p>Capabilities:
        <input class="btn btn-outline-Info" type="text" name="capab" value="'.htmlentities($row['Capabilities']).'"></p>
        <p>IaaS:
        <input class="btn btn-outline-Info" type="text" name="Iaas" value="'.htmlentities($row['Iaas']).'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "funds"){
    	echo '<h1>Updating the record for table - '.$_SESSION['table'].'</h1>';
    	if(isset($_POST['desc']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['grants'])){
            if (strlen($_POST['desc']) < 1 || strlen($_POST['from']) < 1 || strlen($_POST['to']) < 1 || strlen($_POST['grants']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            if(!(is_numeric($_POST['from']) && is_numeric($_POST['to']) && is_numeric($_POST['grants']))){
                $_SESSION['error'] = 'Enter numeric values in From_year, To_year and Grants_Received fields';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE funds_generated SET Description = :descr, From_year = :fromy, To_year = :toy, Grants_Received = :gra WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ":val" => $_POST['SNo'],
                ":descr" => $_POST['desc'],
                ":fromy" => $_POST['from'],
                ":toy" => $_POST['to'],
                ":gra" => $_POST['grants']." Lakhs"));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM funds_generated where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		$match = preg_replace('/[^0-9\.]/', '', $row['Grants_Received']);
		echo '<form method="post">
        <p>Description:
        <input class="btn btn-outline-Info"type="text" name="desc" value="'.htmlentities($row['Description']).'"></p>
        <p>From_Year:
        <input class="btn btn-outline-Info" type="text" name="from" value="'.htmlentities($row['From_Year']).'"></p>
        <p>To_Year:
        <input class="btn btn-outline-Info" type="text" name="to" value="'.htmlentities($row['To_Year']).'"></p>
        <p>Grants_Received (Enter only the numeric value in Lakhs):
        <input class="btn btn-outline-Info" type="text" name="grants" value="'.$match.'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "datacenter"){
    	echo '<h1>Updating the record for table - '.$_SESSION['table'].'</h1>';
    	if(isset($_POST['comp']) && isset($_POST['desc'])){
            if (strlen($_POST['comp']) < 1 || strlen($_POST['desc']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE cloud_data_center SET Component_Name = :comp, Description = :descr WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':comp' => $_POST['comp'],
                ':descr' => $_POST['desc']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM cloud_data_center where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p>Component_Name:
        <input class="btn btn-outline-Info" type="text" name="comp" value="'.htmlentities($row['Component_Name']).'"></p>
        <p>Description:
        <input class="btn btn-outline-Info" type="text" name="desc" value="'.htmlentities($row['Description']).'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "serverconfig"){
    	echo '<h1>Updating the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['hd']) && isset($_POST['dvd']) && isset($_POST['ram']) && isset($_POST['processor']) && isset($_POST['name'])){
            if (strlen($_POST['ram']) < 1 || strlen($_POST['processor']) < 1 || strlen($_POST['name']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE air_lab_server SET HD = :hd, DVD = :dvd, RAM = :ram, Processor = :pro, Name = :name WHERE SNo = :val)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':hd' => $_POST['hd'],
                ':dvd' => $_POST['dvd'],
                ':ram' => $_POST['ram'],
                ':pro' => $_POST['processor'],
                ':name' => $_POST['name']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM air_lab_server where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p>Name:
        <input class="btn btn-outline-Info" type="text" name="name" value="'.htmlentities($row['Name']).'"></p>
        <p>HD:
        <input class="btn btn-outline-Info" type="text" name="hd" value="'.htmlentities($row['HD']).'"></p>
        <p>DVD:
        <input class="btn btn-outline-Info" type="text" name="dvd" value="'.htmlentities($row['DVD']).'"></p>
        <p>RAM:
        <input class="btn btn-outline-Info" type="text" name="ram" value="'.htmlentities($row['RAM']).'"></p>
        <p>Processor:
        <input class="btn btn-outline-Info" type="text" name="processor" value="'.htmlentities($row['Processor']).'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "security"){
    	if(isset($_POST['device']) && isset($_POST['feature']) && isset($_POST['users']) && isset($_POST['logs'])){
            if (strlen($_POST['device']) < 1 || strlen($_POST['users']) < 1 || strlen($_POST['logs']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            if(!(is_numeric($_POST['users']) && is_numeric($_POST['logs']))){
                $_SESSION['error'] = 'Enter numeric values in No. of Users and Logs fields';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE devices SET Device_Name = :dname WHERE Device_ID = :val)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':dname' => $_POST['device']));
            $sql = "UPDATE features SET F_Name = :fname WHERE F_ID = :val)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['FNo'],
                ':fname' => $_POST['feature']));
            $sql = "UPDATE devices_with_statistics SET No_of_Users = :use, Logs = :log WHERE Device_ID = :val AND F_ID = :fno)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':use' => $_POST['users'],
            	':log' => $_POST['logs'],
            	':fno' => $_POST['FNo']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        elseif(isset($_POST['device']) && isset($_POST['quantity'])){
            if (strlen($_POST['device']) < 1 || strlen($_POST['quantity']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            if(!(is_numeric($_POST['quantity']))){
                $_SESSION['error'] = 'Enter numeric values in quantity field';
                header("Location: insert.php");
                return;
            }
            $sql = "UPDATE devices SET Device_Name = :dname WHERE Device_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':dname' => $_POST['device']));
            $sql = "UPDATE device_without_statistics SET Quantity = :quan WHERE Device_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':quan' => $_POST['quantity']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }

        if(isset($_GET['f_id'])){
        	$stmt = $pdo->prepare("SELECT * FROM device_with_statistics, Devices, Features where Device_ID = :xyz AND F_ID = :val");
			$stmt->execute(array(
				":xyz" => $_GET['rec_id'],
				":val" => $_GET['f_id']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ( $row === false ) {
			    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
			    header( 'Location: index.php' ) ;
			    return;
			}
        	echo '<form method="post">
                <p>Device Name:
                <input class="btn btn-outline-Info" type="text" name="device" value="'.htmlentities($row['Name']).'"></p>
                <p>Feature Name:
                <input class="btn btn-outline-Info" type="text" name="feature" value="'.htmlentities($row['F_Name']).'"></p>
                <p>Number of Users (in numbers):
                <input class="btn btn-outline-Info" type="text" name="users" value="'.htmlentities($row['No_of_Users']).'"></p>
                <p>Logs (in numbers):
                <input class="btn btn-outline-Info" type="text" name="logs" value="'.htmlentities($row['Logs']).'"></p>
                <input class="btn btn-outline-Info" type="hidden" name="FNo" value="'.htmlentities($row['F_ID']).'">
                <input class="btn btn-outline-Info" type="hidden" name="DevNo" value="'.htmlentities($row['Device_ID']).'">
                <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
                </form>';
        }
        else{
        	$stmt = $pdo->prepare("SELECT * FROM device_without_statistics dws, Devices d where d.Device_ID = :xyz AND d.Device_ID = dws.Device_ID");
			$stmt->execute(array(":xyz" => $_GET['rec_id']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ( $row === false ) {
			    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
			    header( 'Location: index.php' ) ;
			    return;
			}
        	echo '<form method="post">
                <p>Device Name:
                <input class="btn btn-outline-Info" type="text" name="device" value="'.htmlentities($row['Device_Name']).'"></p>
                <p>Quantity:
                <input class="btn btn-outline-Info" type="text" name="quantity" value="'.htmlentities($row['Quantity']).'"></p>
                <input class="btn btn-outline-Info" type="hidden" name="DevNo" value="'.htmlentities($row['Device_ID']).'">
                <input class="btn btn-outline-Success" type="submit" name="submit" value="Submit"></p>
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
                </form>'; 
        }
    }
    elseif($_SESSION['table'] == "research"){
    	$_SESSION['error'] = 'Table under maintenance. Sorry for the inconvinience';
		header('Location: main.php') ;
		return;
    }
    elseif($_SESSION['table'] == "project"){
    	$_SESSION['error'] = 'Table under maintenance. Sorry for the inconvenience';
		header('Location: main.php') ;
		return;
    }
    else{
        $_SESSION['error'] = 'Some error occured. Try again';
        header('Location: main.php') ;
        return;
    }
}
else{
    $_SESSION['error'] = "Error occured. Try again";
    header("Location: main.php"); 
}
?>
</body>
</html>