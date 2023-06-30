<?php
$conn = mysqli_connect('localhost', 'root', '', 'college_folks');
if (!$conn) {
    echo "ERROR";
}
    session_start();
    $email = $_SESSION['Email'];
    
    // geting details
    $a = "SELECT * FROM `registration` WHERE Email='$email'";
    $b = mysqli_query($conn,$a);
    $c = mysqli_fetch_assoc($b);
    $ui = $c['Unique_id'];
    // echo $ui;

$language = strtolower($_POST['language']);
    $code = $_POST['code'];

    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $ui . "." . $language;
    $_SESSION['file']=$filePath;
    $_SESSION['lang']=$language;
    file_put_contents($filePath, $code, LOCK_EX | FILE_USE_INCLUDE_PATH);
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    if($language == "php") {
        $output = shell_exec("C:\xampp\php\php.exe");
        echo $output;
    }
    if($language == "python") {
        $output = shell_exec("C:\Users\manav\AppData\Local\Programs\Python\Python311\python.exe $filePath 2>&1");
        echo $output;
    }
    if($language == "node") {
        rename($filePath, $filePath.".js");
        $output = shell_exec("node $filePath.js 2>&1");
        echo $output;
    }
    if($language == "c") {
        $outputExe = $random . ".exe";
        shell_exec("gcc $filePath -o $outputExe");
        $output = shell_exec(__DIR__ . "//$outputExe");
        echo $output;
    }
    if($language == "cpp") {
        $outputExe = $random . ".exe";
        shell_exec("g++ $filePath -o $outputExe");
        $output = shell_exec(__DIR__ . "//$outputExe");
        echo $output;
    }
