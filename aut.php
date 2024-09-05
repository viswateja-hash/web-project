
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    setcookie("uname", $name, time() + (130), "/"); 
    setcookie("umobile", $mobile, time() + (130), "/");
    header("Location: teja.php");
    exit();
}
?>
