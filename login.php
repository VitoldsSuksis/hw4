
<?php 
require_once 'db_connect.php';
// sheit es paarbaudu/ieguustu logina formas datus un 
if (isset($_POST['login_user'])) {
    // receive all input values from the form
    $username =$_POST['username'];
    $password = $_POST['password'];
//seit paarbaudu vai eksistee taads users , autentificeeju lietotaaju
    db();
     $query = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if($user){
        session_start();
        $_SESSION['username'] = $username;
        header('location: index.php');
    }else{
        echo mysqli_error($link);
        echo "lietotaajs nav atrasts";
    }
}


    ?>


<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <div class="header">
        <h2>Login</h2>
    </div>

    <form method="post" action="login.php">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </form>
</body>

</html>