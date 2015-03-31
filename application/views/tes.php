<html>
<head>
<title>Upload Form</title>
</head>
<body>

<ul>
<?php
if(isset($upload_data)){
 foreach ($upload_data as $item => $value){
?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php } }?>
</ul>
<hr />
<?php echo $error;?>

</body>
</html>