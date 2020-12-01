<!DOCTYPE html>
<html lang="en">
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<script>
        $(document).ready(function(){
            $('#username').blur(function(){
                
                var username = $(this).val();
                
                $.ajax({
                    url: "username.php",
                    method: "POST",
                    data:{username: username},
                    dataType: "text",
                    success:function(html)
                    {
                        $('#ava').html(html);
                    }


                });

            });

            
        });
    
    </script>
<?php

    session_start();
    

    $error = "";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);

        session_destroy();

        setcookie("id", "", time() - 60*60);

        $_COOKIE["id"] = "";  

        header('Location: index.php');
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        $query2 = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

        $link = mysqli_connect("localhost:3307", "root", "", "artgallery");
                
        $result = mysqli_query($link, $query2);
    
        $row = mysqli_fetch_array($result);

        $_SESSION['username'] = $row['fname'];

        $_SESSION['login_status'] = true;

        header("Location: index.php");
        
    }



    if (array_key_exists("submit", $_POST)) {
        
        $link = mysqli_connect("localhost:3307", "root", "", "artgallery");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }
        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        }
        
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['signUp'] == '1') {
            
                $query = "SELECT usr_id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                    $query = "INSERT INTO `users` (`fname`, `lname`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['fname'])."', '".mysqli_real_escape_string($link, $_POST['lname'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE usr_id = ".mysqli_insert_id($link)." LIMIT 1";

                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);

                        } 
                        $query2 = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                        $result = mysqli_query($link, $query2);
                    
                        $row = mysqli_fetch_array($result);

                        $_SESSION['username'] = $row['fname'];

                        $_SESSION['login_status'] = true;

                        header("Location: index.php");

                    }

                } 
                
            } else {
                    
                    $query2 = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query2);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['usr_id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['id'] = $row['usr_id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['usr_id'], time() + 60*60*24*365);

                            } 

                            $_SESSION['username'] = $row['fname'];

                            $_SESSION['login_status'] = true;

                            header("Location: index.php");
                            
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                }
            
        }
        
        
    }


?>

</body>