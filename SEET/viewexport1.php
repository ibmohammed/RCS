<?php error_reporting(-1); ?>
<?php ini_set('display_errors', true); ?>
<?php require("includes/header.php");
    include("includes/thehead.php");//this is common to all
	//require("includes/header.php"); 
    $time = date("h:i:sa");
    $name = "Notice Board Result".$time.".doc";
    header("Content-Type: application/vnd.msword");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=$name");

    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="icon" href="images/nipoly2 (1).GIF" type="image/x-jpg"/>

<title>Result Sheet</title>
</head>

<body>
    
<?php 
$academic_res = 2;
include("result_views.php");
?>   
	
</body>

</html>
