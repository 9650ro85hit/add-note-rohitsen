<?php
$targetDir = "./new_folder/"; // Define the target directory where you want to store the uploaded image.
$uploadFile = $targetDir . basename($_FILES["fileToUpload"]["name"]); // Get the uploaded file's name and append it to the target directory.

// Check if the file is an actual image or a fake image.
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if the file already exists in the target directory.
if (file_exists($uploadFile)) {
    echo "Sorry, the file already exists.";
    $uploadOk = 0;
}

// Check if the file size is within the allowed limit (adjust as needed).
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow only specific file formats (e.g., jpeg, jpg, png). You can modify this list as needed.
$allowedFormats = array("jpg", "jpeg", "png");
$fileExtension = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

if (!in_array($fileExtension, $allowedFormats)) {
    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error.
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// If everything is fine, try to upload the file.
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
