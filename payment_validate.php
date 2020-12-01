<?php
$user = $_SESSION['username'];
$qty = $_SESSION['payment_qty'];
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$payErr = $cardnumErr =$cardnameErr = $expmonErr = $expyearErr = $cvvErr ="";

if (isset($_POST['submit']))
{
  if (empty($_POST["paymethod"]))
    {
        echo "<p style='color:red;margin:20px;'><br>* Enter Method Of Payment</p>";
    }
    else
    {
      $paymethod = test_input($_POST["paymethod"]);
      $address = test_input($_POST["address"]);

      if($paymethod == "Paytm")
      {
        if (empty($_POST["payId"]))
        {
          $payErr ="* Enter Paytm ID";
        }
        else
        {
          $payId = test_input($_POST["payId"]);
          if (strlen($payId) != 4)
          {
          $payErr ="* Enter a 4-digit Number";
          }
        }
      }

      if($paymethod == "Card")
      {
        if (empty($_POST["cardnumber"]))
        {
          $cardnumErr ="* Enter Card Number";
        }
        else
        {
          $cardnum = test_input($_POST["cardnumber"]);
          if (strlen($cardnum) != 16)
          {
            $cardnumErr ="* Enter a 16-digit Number";
          }
        }

        if (empty($_POST["cardname"]))
        {
          $cardnameErr ="* Enter Card Number";
        }
        else
        {
          $cardname = test_input($_POST["cardname"]);
          if (!preg_match("/^[a-zA-Z-' ]*$/",$cardname))
          {
            $cardnameErr ="* Only letters and whites space allowed";
          }
        }

        $expires = \DateTime::createFromFormat('my', $_POST['expirymonth'].$_POST['expiryyear']);
        $now     = new \DateTime();

        if ($expires < $now)
        {
            $expmonErr=$expyearErr= "Card has expired";
        }

        if (empty($_POST["expirymonth"]))
        {
          $expmonErr= "* Enter Month of Expiry";
        }

        if (empty($_POST["expiryyear"]))
        {
          $expyearErr= "* Enter Year of Expiry";
        }

        if (empty($_POST["CVV"]))
        {
          $cvvErr = "* Enter CVV";
        }
        else
        {
          $cvv = test_input($_POST["CVV"]);
          if (strlen($cvv) != 3)
          {
            $cvvErr ="* Invalid CVV";
          }
        }
      }

      if($payErr == "" and $cardnumErr == "" and $cardnameErr == "" and $expmonErr == "" and $expyearErr == "" and $cvvErr == "")
      {

            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";

            $conn = new mysqli("localhost:3307", "root","", "artgallery");
            if (mysqli_connect_error())
            {
              die("Database connection failed: " . mysqli_connect_error());
            }
            else
            {
              //echo "Connected successfully to database";
                $sql = "INSERT INTO payment (username ,paymethod, address, qty)
                VALUES ('$user', '$paymethod', '$address', '$qty')";

                if ($conn->query($sql) === TRUE)
                {
                  echo "<br>New record created successfully";
                }
                else
                {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }

            }
            header("Location: thankyou.html");
            $conn -> close();
          }
    }
}

?>
