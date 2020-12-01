<!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="/Project/static/css/confirm.css"  media="screen,projection"/>
      <title>Explore</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

    <?php
			include ('nav.php');
		?>

    <div class="product">
      <div class="productleft">
        <h4>Confirm Your Order</h4>
        <p>Quantity: <?php echo $_SESSION['payment_qty'] ; ?></p>
        <p>Order ID: <?php echo(rand(10,100));?></p>
      </div>
      <h2>Total : <?php echo $_SESSION['payment_price'] ; ?></h2>
          <br><br>
              <br><br>
                  <br><br>
                      <br><br>
      <center><button onclick="window.location='payment.php'">Proceed to Buy</button></center>
          <br><br>
    </div>


    <?php include ('footer.php');?>

    </body>
  </html>
