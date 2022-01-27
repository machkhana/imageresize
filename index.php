<?php
include('imageresize.php');
if(isset($_POST['addimage']))
{
    $file = $_FILES['file']['name'];
    $imagePath = $_FILES['file']['tmp_name'];
    $saveToDir ='uploads/';
    if($image->ImageResize('700','500', $file)){
    //if($image->saveThumbnail($saveToDir, $imagePath, $file,'700','500')){
        header('location:index.php');
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="addimage">damateba</button>
</form>
</body>
</html>