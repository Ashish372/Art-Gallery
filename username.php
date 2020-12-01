<?php
    $mysqli = new mysqli("localhost:3307", "root", "", "artgallery") or die($mysqli->connect_error);
    $table = 'users';
    //ajax continuation to check username availability.
    if(isset($_POST['first_name'])){
        $user_name = $_POST['first_name'];
        $sql  = "SELECT * FROM users WHERE fname = '$user_name'";
        $result = mysqli_query($mysqli, $sql);
        // check the number of rows with $result values in it if it is more than 1, username is not available.
        if(mysqli_num_rows($result)>0){
            echo "<span style='color: red;'>Username is already taken</span>";
        }
        else{
            echo "<span style='color: green;'>Username available</span>";
        }



    }
    
    
?>