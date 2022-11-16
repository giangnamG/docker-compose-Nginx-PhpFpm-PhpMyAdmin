<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        echo "<script>alert('Bạn đã đăng nhập đâu?')</script>";
        echo "<script>window.location='./index.php'</script>";
    }
    if(isset($_POST['logout'])){
        unset($_SESSION['logged']);
        echo "<script>window.location='./index.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Your welcome</h1>
    <form method="POST">
        <input type="submit" name="logout" value="logout">
    </form>
</body>
</html>