<!DOCTYPE html>
<html>
<head>
    <title>PHP Login Page</title>
</head>
<body>

<form action="" method="POST">
    <label> UserName: </label>
    <input type="text" name="user">

    <label> Password: </label>
    <input type="password" name="pass">

    <input type="submit" value="Login">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost"; // Replace "provided_host" with your actual host
    $user = "root"; // Replace "provided_user" with your actual username
    $password = ''; // Replace "provided_password" with your actual password
    $db_name = "mydb"; // Replace "provided_db_name" with your actual database name

    $conn = mysqli_connect($host, $user, $password, $db_name);
    // if (mysqli_connect_errno()) {
        if(!$conn){
        die("Failed to connect with MySQL: " . mysqli_connect_error());
    }

    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Secure the query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM userdetails WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) 
    {
        header("Location: register.php");
        echo "<h1><center>Login successful</center></h1>";
    } else {
        echo "<h1>Login failed. Invalid username or password.</h1>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
