<?php

    include_once 'dbconnection.php';

    if(isset($_POST['submit'])){
        $username = $_POST['uid'];
        $password = $_POST['pwd'];

        //TO ALERT SUBMISSION OF BLANK FIELDS(IT DOESN'T PREVENT SUBMISSION OF BLANK FIELD THOUGH)
        if (!$username && !$password){
            echo "Enter a username or password.";
        }

        //TO INSERT username and password from field to jossyusers database
        $query = "INSERT INTO passwd(user,password,enabled) VALUES('$username','$password',1)";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed ".mysqli_error($conn));
        }
    }

    header('location: ../index.php?signup=success');

?>
