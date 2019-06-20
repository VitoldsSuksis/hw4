<?php
//uzsaaku sesiju
session_start();

// ja sesijaa nav mainiigais username tad lietotaajs nav autentificeejies
if (!isset($_SESSION['username'])) {
    //novirzu uz login lapu
    header('location: login.php');
}
// ja sanemts get pieprasijums(klikshkis uz 'a' elementu) logout
if (isset($_GET['logout'])) {
    //izniicinu sesiju
    session_destroy();
    //un novirzu uz login page
    unset($_SESSION['username']);
    header("location: login.php");
}
//lietotaajs ir autentificeejies , sanemts jauns todo pievienoshanas vaicaajums
require_once("db_connect.php");
if (isset($_POST['submit'])) {
    $title = $_POST['todoTitle']; // panem , kas pievienots virsrakstaa
    $description = $_POST['todoDescription']; //panem , kas pievienots description sarakstaa

    // savienoties ar datubaazi
    db();
    global $link;
    $query = "INSERT INTO todo(todoTitle, todoDescription, date) VALUES ('$title', '$description', now() )";
    $insertTodo = mysqli_query($link, $query);
    if ($insertTodo) {
        echo "Tu pievienoji jaunu todo";
    } else {
        echo mysqli_error($link);
    }
}
?>

<html>

<head>
   
    <title>mani todo</title>
</head>

<body>

    <style type="text/css">
        table { 
    width: 750px; 
    border-collapse: collapse; 
    margin:5px;
    }
/* Zebra striping */
tr:nth-of-type(odd) { 
    background: #eee; 
    }
th { 
    background: #3498db; 
    color: white; 
    font-weight: bold; 
    }
td, th { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-size: 18px;
    }

    </style>

    <!-- logged in user information -->
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>


    <div style="border: 1px solid green">
        <h1>Izveido ToDo saraksti</h1>
        <a class="poga" href="index.php">Rādīt visus Todo</a>
        <form method="post">
            <p>Todo tituls: </p>
            <input name="todoTitle" type="text">
            <p>Todo apraksts: </p>
            <input name="todoDescription" type="text">
            <br>
            <input type="submit" name="submit" value="submit">
        </form>

    </div>




    <?php
    db();
    $query  = "SELECT id, todoTitle, todoDescription, date FROM todo";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $title = $row['todoTitle'];
            $date = $row['date'];
            $description = $row['todoDescription'];
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Edit/delete</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $description ?></td>
                        <td><?php echo "$date"; ?></td>
                        <td><button type="button"><a href="edit.php?id=<?php echo $id ?>">Edit</a></button>
                         <button type="button" name="delete"><a href="delete.php?id=<?php echo $id ?>">Delete</a></button></td>
                    </tr>
                </tbody>
            </table>
        <?php
    }
}
?>


</body>

</html>