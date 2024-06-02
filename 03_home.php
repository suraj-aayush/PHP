<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="post">
        <input type="text" name="name" placeholder="enter name">
        <input type="text" name="sec" placeholder="enter section">
        <input type="text" name="roll" placeholder="roll">
        <input type="text" name="uid" placeholder="university id">

        <input type="submit" name ="submit" value="Submit">
        <input type="submit" name="register" value="REGISTER">
    </form>

    <a href="./03_home.php">Login Page</a>

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "college";

    $conn = mysqli_connect($host, $user, $password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['name'];
    $section = $_POST['sec'];
    $roll = $_POST['roll'];
    $uid = $_POST['uid'];

    $submit = $_POST['submit'];
    $register = $_POST['register'];

    if(isset($_POST['submit']))
    {
        $stmt = $conn->prepare("SELECT * FROM students WHERE username = ? AND sec = ? AND roll = ? AND uid = ?");
    $stmt->bind_param("ssss", $username, $section, $roll, $uid);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        header("Location: 02_register.php");
        exit; // Exit to prevent further execution of PHP code
    } else {
        echo "<h1>No user found</h1>";
    }
    $stmt->close();
    }
    else if( isset($_POST['register']))
    {
        $stmt = $conn->prepare("INSERT INTO `students` (`username`, `sec`, `roll`, `uid`) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $username, $section, $roll, $uid);
        $stmt->execute();
        $stmt->store_result();
    }

    // if ($stmt->num_rows == 1) {
    //     header("Location: 02_register.php");
    //     exit; // Exit to prevent further execution of PHP code
    // } else {
    //     echo "<h1>No user found</h1>";
    // }

    // $stmt->close();
    $conn->close();
}

?>
