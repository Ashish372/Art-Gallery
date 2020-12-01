<?php
session_start();
require_once("config.php");


//code for Cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	//code for adding product in cart
	case "add":
		if(!empty($_POST["quantity"])) {
			$pid=$_GET["pid"];
			$result=mysqli_query($con,"SELECT * FROM tblproduct WHERE prod_id='$pid'");
	          while($productByCode=mysqli_fetch_array($result)){
			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			}  else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	}
	break;

	// code for removing product from cart
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	// code for if cart is empty
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
	<style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
body {
    font-family: Arial;
    color: #211a1a;
    font-size: 0.9em;
}

#shopping-cart {
    margin: 40px;
}

@media screen and (max-width: 450px){
    #shopping-cart {
    margin: 0px;
}
}

#product-grid {
    margin: 40px;
}

#shopping-cart table {
    width: 100%;
    background-color: #F0F0F0;
}

#shopping-cart table td {
    background-color: #FFFFFF;
}

.txt-heading {
    color: #211a1a;
    border-bottom: 1px solid #E0E0E0;
    overflow: auto;
}

#btnEmpty {
    background-color: #ffffff;
    border: #d00000 1px solid;
    padding: 5px 10px;
    color: #d00000;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;
}

#chkout{
    background-color: #ffffff;
    border: #3366ff 1px solid;
    padding: 5px 10px;
    color: #3366ff;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;
}

.btnAddAction {
    padding: 5px 10px;
    margin-left: 5px;
    background-color: #efefef;
    border: #E0E0E0 1px solid;
    color: #211a1a;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    cursor: pointer;
}

#product-grid .txt-heading {
    margin-bottom: 18px;
}

.product-item {
    float: left;
    background: #ffffff;
    margin: 30px 30px 0px 0px;
    border: #E0E0E0 1px solid;
}

.product-image {
    height: 155px;
    width: 250px;
    background-color: #FFF;
}

.clear-float {
    clear: both;
}

.demo-input-box {
    border-radius: 2px;
    border: #CCC 1px solid;
    padding: 2px 1px;
}

.tbl-cart {
    font-size: 0.9em;
}

.tbl-cart th {
    font-weight: normal;
}

.product-title {
    margin-bottom: 20px;
}

.product-price {
    float: left;
}

.cart-action {
    float: right;
}

.product-quantity {
    padding: 5px 10px;
    border-radius: 3px;
    border: #E0E0E0 1px solid;
}

.product-tile-footer {
    padding: 15px 15px 0px 15px;
    overflow: auto;
}

.cart-item-image {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: #E0E0E0 1px solid;
    padding: 5px;
    vertical-align: middle;
    margin-right: 15px;
}

.no-records {
    text-align: center;
    clear: both;
    margin: 38px 0px;
}

main {
    width: 100%;
    font-family: 'Montserrat', sans-serif;
}

.card {
    -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
}

.card {
    position: relative;
    margin: 0.5rem 0 1rem 0;
    background-color: white;
    -webkit-transition: -webkit-box-shadow .25s;
    transition: -webkit-box-shadow .25s;
    transition: box-shadow .25s;
    transition: box-shadow .25s, -webkit-box-shadow .25s;
	border-radius: 2px;
	display: block;
}

.card form{
    width: 100%;
}

.card .card-title {
    font-size: 24px;
    font-weight: 300;
}

.card .card-image {
    margin: 20px auto;
    width: 100%;
}

.card .card-image img {
    display: block;
    border-radius: 2px 2px 0 0;
    position: relative;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
	width: 100%;
	display: block;
}

.card .card-content {
    padding: 24px;
    border-radius: 0 0 2px 2px;
}

.card .card-content p {
    margin: 0;
}

.card .card-content .card-title {
    display: block;
    line-height: 32px;
    margin-bottom: 8px;
}

.card .card-content .card-title i {
    line-height: 32px;
}

.card .card-action {
    background-color: inherit;
    border-top: 1px solid rgba(160, 160, 160, 0.2);
    position: relative;
    padding: 16px 24px;
}

.card .card-action:last-child {
    border-radius: 0 0 2px 2px;
}

.card .card-action a:not(.btn):not(.btn-large):not(.btn-small):not(.btn-large):not(.btn-floating) {
    color: #ffab40;
    margin-right: 24px;
    -webkit-transition: color .3s ease;
    transition: color .3s ease;
    text-transform: uppercase;
}

.card .card-action a:not(.btn):not(.btn-large):not(.btn-small):not(.btn-large):not(.btn-floating):hover {
    color: #ffd8a6;
}

.row {
    margin: 20px auto;
    max-width: 700px;
}


/* .row:after {
  content: "";
  display: table;
  clear: both;
} */

.row .col {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    min-height: 1px;
}

.row .col.s12 {
    width: 100%;
}
</style>
<TITLE>Shopping Cart</TITLE>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</HEAD>
<BODY>
<?php
			include ('navonlyforsignuppage.php');
		?>

<!-- Cart ---->
<main>
<div id="shopping-cart">
<div class="txt-heading" style="color: black;font-size:200%;text-align:center">SHOPPING CART</div>

<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
   
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "Rs.".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "Rs. ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="/Project/static/images/icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
        }
        if(!empty($_SESSION["cart_item"])){
            $_SESSION['payment_price'] = $total_price;
            $_SESSION['payment_qty'] = $total_quantity;
        }
        
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "Rs. ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
<a id="chkout" href="confirm.php">Proceed to Checkout</a>	

  <?php
} else {
        $_SESSION['payment_price'] = 0;
        $_SESSION['payment_qty'] = 0;
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>




<div id="product-grid">
	<div class="txt-heading" style="color: black;font-size:150%;">ARTS</div>
	<?php
	$product= mysqli_query($con,"SELECT * FROM tblproduct ORDER BY prod_id ASC");
	if (!empty($product)) { 
		while ($row=mysqli_fetch_array($product)) {
		
	?>
		
        <div class="row">
        <div class="card">
            <div class="col s12 m">
			<form method="post" action="cart.php?action=add&pid=<?php echo $row["prod_id"]; ?>">
			<div class="card-image"><img src="<?php echo $row["image"]; ?>"></div>
			<div class="card-title" style="padding: 20px; text-align: center;"><?php echo $row["name"]; ?></div>
			<div class="card-price" style="padding: 20px"><?php echo "Rs. ".$row["price"]; ?></div>
			<div class="card-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" style="font-size: 16px;" value="Add to Cart" class="btnAddAction" /></div>
			</form>
            </div>
            </div>
		</div>
	<?php
		}
	}  else {
 echo "No Records.";

	}
	?>
</div>
</main>
<?php
			include ('footer.php');
		?>

</BODY>
</HTML>