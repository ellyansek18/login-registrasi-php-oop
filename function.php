<?php 
session_start();

class Connection{
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "reglog";
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
    }
}

class Register extends Connection{
    public function registration($name, $username, $email, $password, $confirmpassword){
        $duplicate = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email' ");
        if(mysqli_num_rows($duplicate) > 0 ){
            return 10;
            // Username atau email has token
        }
        else{
            if($password == $confirmpassword){
                $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$email', '$password')";
                mysqli_query($this->conn, $query);
                return 1;
                // registrasi sukses
            }
            else{
                return 100;
            }
        }
    }
}

class Login extends Connection{
    public $id;
    public function login($usernameemail, $password){
        $result = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail' ");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            if($password == $row["password"]){
                $this->id = $row["id"];
                return 1;
                // login successfull
            }
            else{
                return 10;
                // wrong password
            }
        }
        else{
            return 100;
            // User not register
        }
    }
    public function idUser(){
        return $this->id;
    }
}

class Select extends Connection{
    public function selectUserById($id){
        $result = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }
}


?>