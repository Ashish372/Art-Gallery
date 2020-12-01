
<?php

    include ('signup_validate.php');

?>

<html lang="en">
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Project/static/css/signup.css">
        <title>Sign Up</title>
    </head>
    <body>
    <script>
        $(document).ready(function(){
            $('#first_name').blur(function(){
                
                var first_name = $(this).val();
                
                $.ajax({
                    url: "username.php",
                    method: "POST",
                    data:{first_name: first_name},
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
			include ('navonlyforsignuppage.php');
		?>

    <main style="padding: 30px;">
    <div id="error" style="color: red;"><?php echo $error;?></div>

      <center>

      <div class="row">
        <h1>LOGIN</h1>
        <form method="post">
                <div class="col s3">
                    <input type="email" name="email" class="validate">
                    <label for="email">Email</label>
                  </div>
                <div class="col s3">
                    <input type="password" name="password" class="validate">
                    <label for="password">Password</label>
                  </div>
              <div class=remme>
                <label>
                  <input type="checkbox" name="stayLoggedIn" value=1/>
                  <span>Remember Me</span>
                </label>
              </div>
              <input type="hidden" name="signUp" value="0">
              <input type="submit" name="submit" value="Log In!" class="button">
        </form>
      </div>

  <h2>OR</h2>


        <div class="row">
        <h1>SIGNUP</h1>
            <form method="POST">
                <div class="col s3">
                  <input id="first_name" type="text" name="fname" class="validate">
                  <span id="ava"></span>
                  <label for="first_name">First Name</label>
                </div>
                
                <div class="col s3">
                  <input id="last_name" type="text" name="lname" class="validate">
                  <label for="last_name">Last Name</label>
                </div>
                <div class="col s3">
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                  </div>
                <div class="col s3">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                  </div> 
              <div class=remme>
                <label>
                  <input type="checkbox" name="stayLoggedIn" value=1/>
                  <span>Remember Me</span>
                </label>
              </div>
              <input type="hidden" name="signUp" value="1">
                <input type="submit" name="submit" value="Sign Up!" class="button">
              
            </form>
          </div>
          </center>
          
      </main>
          <?php
			include ('footer.php');
		?>
        
    </body>
</html>