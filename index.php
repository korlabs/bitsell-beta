<?php
//BitSell ATM beta software
// Copyright BitSell team
include("includes/main.php");
if($setup == "no") {
header("location: setup");
}
else 
{
$filename = 'setup';
if (file_exists($filename)) {
    die("Security error! <b>Please delete the 'setup' folder for this software to function.");
} 
// continue on with system 
$type = $_GET[type];
echo " 
";
}
?>
<!DOCTYPE HTML>
<!--
    Helios 1.5 by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>BitSell</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <script src="js/init.js"></script>
        <noscript>
            <link rel="stylesheet" href="css/skel-noscript.css" />
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/style-desktop.css" />
            <link rel="stylesheet" href="css/style-noscript.css" />
        </noscript>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
    </head>

<?php
if($_GET[page]=="" OR $_GET[page]=="index") {
   ?> <body class="homepage">

        <!-- Header -->
            <div id="header">
                        
                <!-- Inner -->
                    <div class="inner">
                        <header>


                        <h1 id="logo">BitSellATM</h1><br />
Please choose your currency.<br /><br />
<a href=order/?page=1&type=BTC class="button circled scrolly">BTC</a> 
<a href=order/?page=1&type=DOGE class="button circled scrolly">DGC</a>   
<a href=order/?page=1&type=DRK class="button circled scrolly">DRK</a>
<a href=order/?page=1&type=LTC class="button circled scrolly">LTC</a>
<a href=order/?page=1&type=NMC class="button circled scrolly">NMC</a>
<a href=order/?page=1&type=QRK class="button circled scrolly">QRK</a>

<!-- Close tags !-->
</div>
</body>
<?php
}

// Page one of order 
elseif ($_GET[page]=="1") {
?>
<body>
<h1>BitSellATM</h1>
Let's fetch your coin address.
  <form id="result" method="get" action="">
    <fieldset>
        <input type="hidden" name="page" value="2">
<input type="hidden" name="type" value="<? Echo "$type"; ?>">
<legend>Amount of coins you wish to orde</legend><input name="amount">
      <legend>Please create a shortname at bit.co.in.</legend>

      
        <label for="shortname">Shortname</label>
        <input name="shortname" id="shortname" >
   <br /><input type=submit class="button circled scrolly">
      

    </fieldset>
  </form>


</body>
<?php
}
// end of page 1
elseif($_GET[page]=="2")
{
    ?>

<body class="homepage">

        <!-- Header -->
            <div id="header">
                        
                <!-- Inner -->
                    <div class="inner">
                        <header>
                        
<body>
<h1>BitSellATM</h1>
Please confirm your order!<br /><br />



<?
$coin_address = $_GET[address];
$email = $_GET[email];
$amount = $_GET[amount];
$price = file_get_contents("https://bleutrade.com/api/v1/calculator?from_coin=$type&value=$amount&to_coin=USD"); // Convert BitCoin to USD
$price_rounded = round($price, 2); // Round price to 2 decimal places
$price_rounded_with_fees = $transaction_fee+$price_rounded; // Add up, with operators fees
echo "
<u>Your e-Receipt</u><br/>
Item: <i>$amount</i><br/>
Sub-total: $price_rounded USD<br/>
Fees: $transaction_fee USD<br/>
Total: $price_rounded_with_fees USD
";
echo "
<br/>
<a href='?page=3&address=$coin_address&pay=$price_rounded&coins=$amount&email=$email&type=$type'>Pay Now</a>";

}
elseif ($_GET[page] =="3") {
?>


    <body class="homepage">

        <!-- Header -->
            <div id="header">
                        
                <!-- Inner -->
                    <div class="inner">
                        <header>
                        
<body>
<h1>BitSellATM</h1>

Please proceed to pay.



<?
$type = $_GET[type];
$coin_address = $_GET[address];
$rand = rand(1882,2099);
$pay = $_GET[pay];
$coins = $_GET[coins];
$email = $_GET[email];
echo "<br/>Your order:
<br/>
$coins $type's ";
echo " = $$pay USD</b>
";
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<? echo $paypal_address; ?>">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="item_name" value="<?php echo "$coin_address"; ?> ">
<input type="hidden" name="notify_url" value="http://<?php echo $address; ?>/api/paypal/ipn.php">
<input type="hidden" name="item_number" value="<?php echo $rand; ?>">
<input type="hidden" name="amount" value="<?php echo $pay; ?>">
<input type="hidden" name="return" value="http://<? echo "$address/?page=4&coins=$coins&money=$pay&coin_address=$coin_address&type=$type";  ?>">
<br/><input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_pp_142x27.png" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>

<br/><br/>
<?php
}
elseif ($_GET[page]=="4") {
?>
<body class="homepage">

        <!-- Header -->
            <div id="header">
                        
                <!-- Inner -->
                    <div class="inner">
                        <header>
                        
<body>
<h1>BitSell ATM</h1>

Please check your wallet within the next 5 minutes.<br />



<?
$coin_address = $_GET[coin_address];
$coins = $_GET[coins];
$type = $_GET[type];
$email = $_GET[email];
 
include("../api/coinpay/coinpayments.inc.php");
     $cps = new CoinPaymentsAPI();
       $cps->Setup($coinpay_private, $coinpay_public);
       $result = $cps->CreateWithdrawal($coins, $type, $coin_address, 1);
        if ($result['error'] == 'ok') {
                print ' Coins sent with transaction ID: '.$result['result']['id'];
mail("paypal@bitsellatm.com","Transaction completed","A transaction with the API Key: $api_key has been completed. $coins $type have been sent!"); 
mail("$paypal_address","Transaction completed","A transaction with the API Key: $api_key has been completed. $coins $type have been sent!"); 
     } else {
Die('Error: '.$result['error']."\n");
     }
?><br />
<a href="?page=index">Start another transaction</a>
<br/><br/>
<?php
}
else 
{
}
?>
</html>