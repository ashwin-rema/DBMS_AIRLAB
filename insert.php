<?php
require_once "pdo.php";
session_start();?>
<html>
<head>
    <title>Record to be inserted</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <center><div class="container" style="margin: 100px;padding-left: : 50px">
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
if(isset($_SESSION['table'])){
    if($_SESSION['table'] == "Moudetails"){
        echo '<h1>Inserting the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['outcome']) && isset($_POST['MoUSignal'])){
            if (strlen($_POST['outcome']) < 1 || strlen($_POST['MoUSignal']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM MoU_Details");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO mou_details (SNo, Outcome, MoU_Signal_with) VALUES (:val, :out, :mousig)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':out' => $_POST['outcome'],
                ':mousig' => $_POST['MoUSignal']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text"  placeholder="outcome"><br>
        <input class="form-control" type="text"  placeholder="MoUSignal"><br>
        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
        </form>';
    }
    elseif($_SESSION['table'] == "private"){
        echo '<h1>Inserting the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['cloud']) && isset($_POST['capab']) && isset($_POST['Iaas'])){
            if (strlen($_POST['cloud']) < 1 || strlen($_POST['capab']) < 1 || strlen($_POST['Iaas']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM private_cloud");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO private_cloud (SNo, Cloud_Type, Capabilities, Iaas) VALUES (:val, :cloud, :capab, :iaas)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':cloud' => $_POST['cloud'],
                ':capab' => $_POST['capab'],
                ':iaas' => $_POST['Iaas']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" placeholder="Cloud_Type"><br>
        <input class="form-control" type="text" placeholder="Capabilities"><br>
        <input class="form-control" type="text" placeholder="Iaas"><br>
        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
        </form>';
    }
    elseif($_SESSION['table'] == "funds"){
        echo '<h1>Inserting the record for table - '.$_SESSION['table'].'</h1>';
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
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM funds_generated");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO funds_generated (SNo, Description, From_Year, To_Year, Grants_Received) VALUES (:val, :descr, :fromy, :to, :grants)";
            $stmt = $pdo->prepare($sql);
            $sim = $_POST['grants']." Lakhs";
            $stmt->execute(array(
                ':val' => $sno,
                ':descr' => $_POST['desc'],
                ':fromy' => $_POST['from'],
                ':to' => $_POST['to'],
                ':grants' => $sim));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" placeholder="Description"><br>
        <input class="form-control" type="text" placeholder="From_Year"><br>
        <input class="form-control" type="text" placeholder="To_Year"><br>
        <input class="form-control" type="text" placeholder="Grants_Received (Enter only the numeric value in Lakhs)"><br>
        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
        </form>';
    }
    elseif($_SESSION['table'] == "datacenter"){
        echo '<h1>Inserting the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['comp']) && isset($_POST['desc'])){
            if (strlen($_POST['comp']) < 1 || strlen($_POST['desc']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM cloud_data_center");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO cloud_data_center (SNo, Component_Name, Description) VALUES (:val, :comp, :descr)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':comp' => $_POST['comp'],
                ':descr' => $_POST['desc']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text" placeholder="Component_Name"><br>
        <input class="form-control" type="text" placeholder="Description"><br>
        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
        </form>';
    }
    elseif($_SESSION['table'] == "serverconfig"){
        echo '<h1>Inserting the record for table - '.$_SESSION['table'].'</h1>';
        if(isset($_POST['hd']) && isset($_POST['dvd']) && isset($_POST['ram']) && isset($_POST['processor']) && isset($_POST['name'])){
            if (strlen($_POST['ram']) < 1 || strlen($_POST['processor']) < 1 || strlen($_POST['name']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM air_lab_server");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO air_lab_server (SNo, HD, DVD, RAM, Processor, Name) VALUES (:val, :hd, :dvd, :ram, :pro, :name)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':hd' => $_POST['hd'],
                ':dvd' => $_POST['dvd'],
                ':ram' => $_POST['ram'],
                ':pro' => $_POST['processor'],
                ':name' => $_POST['name']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" placeholder="Name"><br>
        <input class="form-control" type="text" placeholder="HD"><br>
        <input class="form-control" type="text" placeholder="DVD"><br>
        <input class="form-control" type="text" placeholder="RAM"><br>
        <input class="form-control" type="text" placeholder="Processor"><br>
        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
        </form>';
    }
    elseif($_SESSION['table'] == "security"){
        if(isset($_POST['device_table']) || isset($_SESSION['device_table'])){
            if(!isset($_SESSION['device_table'])){$_SESSION['device_table'] = $_POST['device_table'];}
            if($_SESSION['device_table'] == "with_statistics"){
                echo '<h1>Inserting the record for table - '.$_SESSION['table'].'('.$_SESSION['device_table'].')</h1>';
                if(isset($_POST['device']) && isset($_POST['feature']) && isset($_POST['users']) && isset($_POST['logs'])){
                    if (strlen($_POST['device']) < 1 || strlen($_POST['feature']) < 1 || strlen($_POST['users']) < 1 || strlen($_POST['logs']) < 1) {
                        $_SESSION['error'] = 'Missing data';
                        header("Location: insert.php");
                        return;
                    }
                    if(!(is_numeric($_POST['users']) && is_numeric($_POST['logs']))){
                        $_SESSION['error'] = 'Enter numeric values in No. of Users and Logs fields';
                        header("Location: insert.php");
                        return;
                    }
                    $stmt = $pdo->prepare("SELECT Device_ID FROM Devices where Device_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['device']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(Device_ID) AS dno FROM devices");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $sno = "D01";
                        }
                        else{
                            $temp = substr($row1['dno'],2) + 1;
                            $sno = substr($row1['dno'],0,2).$temp;
                        }
                        $sql = "INSERT INTO Devices (Device_ID, Device_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $sno,
                        ':name' => $_POST['device']));
                    }
                    else{
                        $sno = $row['Device_ID'];
                    }
                    $stmt = $pdo->prepare("SELECT F_ID FROM Features where F_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['feature']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(F_ID) AS dno FROM features");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $fno = "F_1";
                        }
                        else{
                            $temp = substr($row['dno'],2) + 1;
                            $fno = substr($row['dno'],0,2).$temp;
                        }
                        $sql = "INSERT INTO Features (F_ID, F_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $fno,
                        ':name' => $_POST['feature']));
                    }
                    else{
                        $fno = $row['F_ID'];
                    }
                    try{
                        $sql = "INSERT INTO device_with_statistics (Device_ID, F_ID, No_of_Users, Logs) VALUES (:dno, :fno, :user, :log)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                            ':dno' => $sno,
                            ':fno' => $fno,
                            ':user' => $_POST['users'],
                            ':log' => $_POST['logs']));
                        $_SESSION['success'] = 'Record Added Successfully';
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                    catch(Exception $e){
                        $_SESSION['error'] = "This combination is already available";
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                }
                else{
                    echo '<form method="post">
                    <input class="form-control" type="text" placeholder="Device_Name"><br>
                    <input class="form-control" type="text" placeholder="Feature Name"><br>
                    <input class="form-control" type="text" placeholder="Number of Users (in numbers)"><br>
                    <input class="form-control" type="text" placeholder="logs (in numbers)"><br>
                    <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
                    <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
                    </form>';
                }
            }
            elseif($_SESSION['device_table'] == "without_statistics"){
                echo '<h1>Inserting the record for table - '.$_SESSION['table'].'('.$_SESSION['device_table'].')</h1>';
                if(isset($_POST['device']) && isset($_POST['quantity'])){
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
                    $stmt = $pdo->prepare("SELECT Device_ID FROM Devices where Device_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['device']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(Device_ID) AS dno FROM devices");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $dno = "D01";
                        }
                        else{
                            $temp = substr($row1['dno'],2) + 1;
                            $dno = substr($row1['dno'],0,2).$temp;
                        }
                        $sql = "INSERT INTO Devices (Device_ID, Device_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $dno,
                        ':name' => $_POST['device']));
                    }
                    else{
                        $dno = $row['Device_ID'];
                    }
                    $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM device_without_statistics");
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $sno = 1;
                    }
                    else{
                        $sno = $row['maxno'] + 1;
                    }
                    try{
                        $sql = "INSERT INTO device_without_statistics (SNo, Quantity, Device_ID) VALUES (:sno, :quan, :dno)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                            ':dno' => $dno,
                            ':sno' => $sno,
                            ':quan' => $_POST['quantity']));
                        $_SESSION['success'] = 'Record Added Successfully';
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                    catch(Exception $e){
                        $_SESSION['error'] = "This combination is already available";
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                }
                echo '<form method="post">
                <input class="form-control" type="text" placeholder="Device Name"><br>
                <input class="form-control" type="text" placeholder="Quantity"><br>
                <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br>
                </form>'; 
            }   
            else{
                $_SESSION['error'] = 'Error occured. Choose the tables again and proceed';
                unset($_SESSION['device_table']);
                unset($_SESSION['table']);
                header("Location: main.php");
                return;
            }
        }
        if(!isset($_SESSION['device_table'])){
            echo '<form method = "post">
            <input type="radio"  class="btn-check" id="with" name="device_table" value="with_statistics" autocomplete="off">
            <label class="btn btn-outline-primary" for="with">Device With Statistics Table</label><br>
            <input type="radio"  class="btn-check" id="without" name="device_table" value="without_statistics" autocomplete="off">
            <label class="btn btn-outline-primary" for="without">Device without Statistics Table</label><br>
            <input class="btn btn-outline-success" type="submit" name="submit" value="Submit"><br>
            <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"><br></form>';
        }
    }
    elseif($_SESSION['table'] == "research"){
        $_SESSION['error'] = 'Table under maintenance. Sorry for the inconvinience';
        header('Location: main.php') ;
        return;
    }
    elseif($_SESSION['table'] == "project"){
        $_SESSION['error'] = 'Table under maintenance. Sorry for the inconvinience';
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
</div>
</center>
</body>
</html>
