<!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="/Project/static/css/payment1.css"  media="screen,projection"/>
      <title>Explore</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

    <?php include ('nav.php');?>

    <?php include ('payment_validate.php');?>

    <div class="paymentgateway">

      <div class="payop">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="address">
        <h3>Deliver to :</h3>
        <textarea name="address" style="height: 200px; padding: 20px; resize: none;"></textarea><br><br>
      </div>

        <h3>Payment method :</h3>

          <div class="choice">
            <input type="radio" name="paymethod" <?php if (isset($paymethod) && $paymethod=="COD") echo "checked";?> value="COD">
            <p>Cash On Delivery</p>
            <img src="/Project/static/images/cash.png" width="auto" height="35" style="margin-left:10px;">
          </div><br>

          <div class="choice">
            <input type="radio" name="paymethod" <?php if (isset($paymethod) && $paymethod=="Paytm") echo "checked";?> value="Paytm">
            <p>Paytm</p>
            <img src="/Project/static/images/Paytm.png" width="auto" height="30" style="margin-left:10px;">
          </div><br>

          <div class="paytm">
            <p>Paytm ID :</p><br>
            <input type="number" name="payId">
            <br><br><span class="error"><?php echo $payErr;?></span><br><br>
          </div>

          <input type="radio" name="paymethod" <?php if (isset($paymethod) && $paymethod=="Card") echo "checked";?> value="Card">Credit/Debit Card<br>
          <img src="/Project/static/images/Cards.png" width="auto" height="40" style="margin-left:50px;">

            <div class="card">
              <p>Card Number :</p><br>
              <input type="number" name="cardnumber">
              <br><br><span class="error"><?php echo $cardnumErr;?></span><br><br>

              <p>Card Holder's Name :</p><br>
              <input type="text" name="cardname">
              <br><br><span class="error"><?php echo $cardnameErr;?></span><br><br>

              <p>Expiry Month :</p><br>
              <input type="number" name="expirymonth" placeholder="MM">
              <br><br><span class="error"><?php echo $expmonErr;?></span><br><br>

              <p>Expiry Year :</p><br>
              <input type="number" name="expiryyear" placeholder="YY">
              <br><br><span class="error"><?php echo $expyearErr;?></span><br><br>

              <p>CVV :</p><br>
              <input type="password" name="CVV">
              <br><br><span class="error"><?php echo $cvvErr;?></span><br><br>
            </div>




      </div>
        <center><input type="submit" name="submit" value="Proceed to Checkout"><center><br><br>
      </form>
    </div>

    </body>
  </html>
