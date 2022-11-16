<?php
    session_start();
    if(isset($_SESSION['logged'])){
        echo "<script>window.location='./home.php'</script>";
    }
    $conn = mysqli_connect("db","ngn","ngn@ngn","web");
    if(isset($_POST['register'])){
        $username = antiSQLi($conn,$_POST['username']);
        $email = antiSQLi($conn,$_POST['email']);
        $password = antiSQLi($conn,$_POST['password']);
        $cfPasswd = antiSQLi($conn,$_POST['cf-password']);
        echo "<script>alert('1')</script>";
        if(Validate($username,$password,$email)){
            if($password===$cfPasswd){
                if(!userExited($conn,$username,$email)){
                    insert($conn,$username,$email,$password);
                    echo "<script>alert('Success')</script>";
                    echo "<script>window.location='./login.php'</script>";
                }else{
                    echo "<script>alert('User already exited')</script>";
                    echo "<script>window.location='./register.php'</script>";
                }
            }else{
                echo "<script>alert('Password Not Same')</script>";
                echo "<script>window.location='./register.php'</script>";
            }

        }
    }
    function insert($conn,$username,$email,$password){
        $sql = "insert into users (username,password,email) values ($username,$password,$email)";
        mysqli_query($conn,$sql);
    }
    function antiSQLi($conn,$string){
        $conn = mysqli_connect("db","ngn","ngn@ngn","web");
        return htmlspecialchars(strip_tags(addslashes(mysqli_real_escape_string($conn,$string))));
    }
    function userExited($conn,$username,$email){
        $sql = "select * from users where username = '$username' or email = '$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result))
            return true;
        return false;
    }
    function Validate($username,$password,$email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            echo "<script>alert('Email is invalid')</script>";
            echo "<script>window.location='./register.php'</script>";
            return false;
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
    <h3>Register</h3><br>
    <form method="POST">
        <label>Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="email" placeholder="email"><br><br>
        <label>Username</label>&nbsp;&nbsp;
        <input type="text" name="username" placeholder="Username"><br>
        <br><label>Password</label>&nbsp;&nbsp;&nbsp;
        <input type="password" name="password" placeholder="Password">&nbsp;&nbsp;&nbsp;
        <label>Confirm Password</label>&nbsp;&nbsp;
        <input type="password" name="cf-password" placeholder="Confirm Password"><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="register" value="register">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button><a href="./index.php">login</a></button>
    </form>
</body>
</html>