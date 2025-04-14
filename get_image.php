<?php
$imagePath = $_GET["imagesrc"];
$imageData = file_get_contents($imagePath);

echo $imageData;
?>