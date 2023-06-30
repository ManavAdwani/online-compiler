<?php
$conn = mysqli_connect('localhost', 'root', '', 'college_folks');
if (!$conn) {
    echo "ERROR";
}
session_start();
$email = $_SESSION['Email'];
$lang = $_SESSION['lang'];

$a = "SELECT * FROM `registration` WHERE Email='$email'";
$b = mysqli_query($conn,$a);
$c = mysqli_fetch_assoc($b);
$ui = $c['Unique_id'];
// echo $ui;
$fp = $_SESSION['file'];
echo $fp;
$file_name = $ui.".".$lang;
$sourceFolderPath = 'C:\xampp\htdocs\online-compiler\App\temp'; // Absolute path to source file
$sourceFilePath = $sourceFolderPath . '/' . $file_name;
$targetFolderPath = 'C:\xampp\htdocs\online-compiler\App\temp2'; // Absolute path to target folder
$targetFilePath = $targetFolderPath .'/'. $file_name; // Target file path

if (copy($sourceFilePath, $targetFilePath)) { // move file from source to target folder
    unlink($sourceFilePath);
    echo 'File moved successfully!';
} else {
    echo 'Error moving file.';
}
?>
