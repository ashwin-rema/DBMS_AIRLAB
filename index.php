<?php
require_once "pdo.php";
session_start();
unset($_SESSION['user_cat']);
unset($_SESSION['name']);
unset($_SESSION['table']);
unset($_SESSION['device_table']);
?>
<html>
<head></head><body>
<h1><center style="font-size: 25px">WELCOME TO PSG COLLEGE OF TECHNOLOGY AIR LAB</center></h1>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<center><p style="color:red">'.$_SESSION['error']."</p></center>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<center><p style="color:green">'.$_SESSION['success']."</p>/center>\n";
    unset($_SESSION['success']);
}
?>
</table>
<a href="login.php"><center style="font-size: 20px">Log in</center></a><br><br>
<center><p><h4>Not an existing user?</h4><a href="signup.php">Sign Up here</a></p><center>
</body>
</html>

