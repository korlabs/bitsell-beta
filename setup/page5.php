<?php
ob_start();
include("../includes/configuration.php");
if($setup == "yes") {
die("An error occurred while processing your request.");
}
else 
{
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
    <body class="homepage">

        <!-- Header -->
            <div id="header">
                        
                <!-- Inner -->
                    <div class="inner">
                        <header>
                        
<body>
<h1 id="logo">Setup</h1><br />
<font size="3">Please enter your website address where the BitSell ATM software  is installed to. <br />(Please make sure that you include the public directory of BitSell.)<br/><br/>
<?php


$url = $_POST["url"];
if($url == "") {
?>
<form action="" method="post">
URL: http://<input name="url"> <br />(do not add http:// to your url) <br/><br /><input type="submit" class="button circled scrolly"></form>
<?php
}
else {
$file = "../includes/configuration.php";
$content = file_get_contents($file);
$content = preg_replace("/website-just-here/", $url, $content);
file_put_contents($file, $content);

?>
<p>
<center>
<a href="page6.php">URL is valid. Tap to proceed. ></a>
<?php 
}
?>
</center>
</p>
</font>
</body>
</html>
<?php
}
?>
