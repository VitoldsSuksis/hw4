    
<?php

require_once "db_connect.php";
//ja get pieprasiijumaa noraadiits parametrs id tad ieguustu taa veertiibu
if(isset($_GET['id'])){
    $id = $_GET['id'];
    db();
    $query = "DELETE FROM todo WHERE id = '$id'";
    $delete = mysqli_query($link, $query);
    if($delete){
        echo 'Todo izdzēsts';
        header('location: index.php');
    }
}