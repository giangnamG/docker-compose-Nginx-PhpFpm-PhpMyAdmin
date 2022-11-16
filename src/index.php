<?php
    session_start();
    if(isset($_SESSION['logged'])){
        echo "<script>window.location='./home.php'</script>";
    }
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(Validate($username,$password)){
            $username = antiSQLi($username);
            $password = antiSQLi($password);
            if(userExited($username)){
                $_SESSION['logged']=1;
                echo "<script>window.location='./home.php'</script>";
            }else{
                echo "<script>alert('Username or password is wrong')</script>";
                echo "<script>window.location='./index.php'</script>";
            }
        }
    }
    function antiSQLi($string){
        $conn = mysqli_connect("db","ngn","ngn@ngn","web");
        return htmlspecialchars(strip_tags(addslashes(mysqli_real_escape_string($conn,$string))));
    }
    function userExited($username){
        $conn = mysqli_connect("db","ngn","ngn@ngn","web");
        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result))
            return true;
        return false;
    }
    function Validate($username,$password){
        $validate = '/^[a-zA-Z0-9]+$/i';
        if(!preg_match($validate, $username)) {
            echo "<script>alert('Username is invalid')</script>";
            echo "<script>window.location='./index.php'</script>";
            return false;
        }
        if(!preg_match($validate, $password)) {
            echo "<script>alert('Password is invalid')</script>";
            echo "<script>window.location='./index.php'</script>";
            return false;
        }
        return true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Login</h3><br>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username">
        <br><label>Password</label>
        <input type="text" name="password" placeholder="Password">
        <br><input type="submit" name="login" value="login">
        <button><a href="./register.php">Register</a></button>
    </form>
</body>
</html>