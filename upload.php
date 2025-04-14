<?php
session_start();
$uploadDirectory = "./statics/images/";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $file = $_FILES["image"];

    if($file["error"] === UPLOAD_ERR_OK) {
        $filename = md5($_SESSION["user_id"]) . ".png";
        $destination = $uploadDirectory . $filename;

        if(move_uploaded_file($file["tmp_name"], $destination)) {
            echo "Image uploaded successfully. File name: " . $filename;
        }else{
            echo "Error: Failed to move the uploaded file.";
        }
    }else {
        echo "Error: " . $file["error"];
    }
} else {
    echo "Invalid request.";
}
?>