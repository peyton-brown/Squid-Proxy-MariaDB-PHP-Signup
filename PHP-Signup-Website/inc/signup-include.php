<?php

    include_once 'dbconnection.php';

    if(isset($_POST['submit'])){
        $username = $_POST['uid'];
        $password = $_POST['pwd'];

        //TO ALERT SUBMISSION OF BLANK FIELDS(IT DOESN'T PREVENT SUBMISSION OF BLANK FIELD THOUGH)
        if (!$username && !$password){
            echo "can't submit blank fields";
        }

        //TO INSERT username and password from field to jossyusers database
        $query = "INSERT INTO passwd(user,password) VALUES('$username','$password')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed".mysqli_error($conn));
        }
    }

    header('location: ../index.php?signup=success');

?>
