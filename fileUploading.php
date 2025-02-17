<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    } else {
        echo "File is not an image.";
    }
    $uploadOk = 1;

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "html") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .fixed-width {
            display: inline-block;
            width: 100px; /* Set the desired width */
            padding: 10px; /* Optional: adds space inside the span */
            /*border: 1px solid #ddd; /* Optional: adds a border for better visibility */
            text-align: center; /* Optional: centers text inside the span */
            box-sizing: border-box; /* Ensures padding and border are included in the width */
            text-align: left;
        }

        td {
            padding: 10px; /* Add padding inside cells */
            vertical-align: top; /* Align content to the top */
        }
        .error{
            color: red;
        }

    </style>
</head>
<body>
<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
    Enter file<input type="file" id = "fileToUpload" name = "fileToUpload">
    <input type="submit" name = "submit" value="Upload Image">
</form>
</body>
</html>








