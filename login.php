<?php 
require 'function.php';

if(isset($_SESSION["id"])){
    header("Location: index.php");
}

$login = new Login();

if(isset($_POST["submit"])){
    $result = $login->login($_POST["usernameemail"], $_POST["password"]);

    if($result == 1){
        $_SESSION["login"] = true;
        $_SESSION["id"] = $login->idUser();
        header("Location: index.php");
    }
    elseif($result == 10){
        echo
        "<script> alert('Wrong Password'); </script>";
    }
    elseif($result == 100){
        echo
        "<script> alert('User Not Registered'); </script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" class="" method="post" autocomplete="off">
        <label for="">Username or Email : </label>
        <input type="text" name="usernameemail" required value=""> <br>
        <label for="">Password : </label>
        <input type="password" name="password" required value=""> <br>
        <button type="submit" name="submit">Login</button>
    </form>
    <br> <br>
    <a href="registration.php">Registration</a>
</body>
</html>