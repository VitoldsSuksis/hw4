<?php
require_once 'db_connect.php';

if (isset($_POST['username'])) {

    
    
    $password = $_POST['password'];
    $username = $_POST['username'];
// datu baazee izveido jaunu lietotaaju
    db();
    $query = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
    $insertUser = mysqli_query($link, $query);
    if ($insertUser) {
        session_start();
        $_SESSION['username'] = $username;
        header('location: index.php');
    } else {
        echo mysqli_error($link);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>

</html>