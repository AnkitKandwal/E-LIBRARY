<?php

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "images/". $filename;
move_uploaded_file($tempname, $folder);
echo "<img src=''height='' width='' >";

?>