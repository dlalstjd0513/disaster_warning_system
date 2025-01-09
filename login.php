<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "login";
a
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 로그인 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_start();
        $_SESSION["username"] = $username;
        header("location: welcome.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}

mysqli_close($conn);
?>
