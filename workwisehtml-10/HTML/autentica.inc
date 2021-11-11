<?php
    session_start();

    if(isset($_SESSION["email"])){

        $email = $_SESSION["email"];
    }
    if(isset($_SESSION["senha"])){

        $senha = $_SESSION["senha"];
    }
    if(empty($email) OR empty($senha)){
        echo "Você não fez o login!";
        header("Location : sign-in.html");
    exit;
    }

     else{
        include "conecta_mysql.inc";
        $sql = "SELECT * FROM usuario WHERE email ='$email';";
        $res = mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($res) != 1){ // testa se não encontrou o email
            unset($_SESSION["email"]);
            unset($_SESSION["senha"]);
            echo "Você não fez o login!";
            header("Location : sign-in.html");
            exit;
        }
        else{
            $usuario = mysqli_fetch_array($res);
            if($senha != $usuario["senha"]){ //testa se a senha está errada
                unset($_SESSION["email"]);
                unset($_SESSION["senha"]);
                echo "Você não fez o login!";
                header("Location : sign-in.html");
                exit;
            }
        }
        mysqli_close($mysqli);
}
?>
