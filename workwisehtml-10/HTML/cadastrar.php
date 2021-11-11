<?php
    include "autentica.inc";
    include "conectasql.inc";
    $operacao = $_POST["operacao"];

    if($operacao == "inserir"){
        $senha = $_POST["senha"];
        $confSenha = $_POST["confSenha"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $erro = 0;

        
        if(strlen($senha) < 5 OR strlen($senha) > 10){
            echo "A senha deve possuir no mínimo 5 e no máximo 10 caracteres.<br>";
            $erro = 1;
        }
        if(empty($nome) OR strstr($nome,' ') == FALSE){
            echo "Favor digitar seu nome corretamente. <br>";
            $erro = 1;
        }
        if(strlen($nome) > 30){
            echo "O nome deve possuir no máximo 30 caracteres.<br>";
            $erro = 1;
        }
        if(strlen($email) < 8 || strstr($email,'@') == FALSE){
            echo "Favor digitar seu email corretamente. <br>";
            $erro = 1;
        }
        if(strlen($email) > 30){
            echo "O email deve possuir no máximo 30 caracteres.<br>";
            $erro = 1;
        }
        // VERIFICA SE NÃO HOUVE ERRO 
        if($erro == 0) {
            $senha_cript = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (senha,nome,email)";
            $sql .= "VALUES ('$senha_cript','$nome','$email');";  
            mysqli_query($mysqli,$sql);   
            header("Location: sign-in.html");  
        }
    }
    /*elseif($operacao == "exibir"){
        $sql = "SELECT * FROM usuario;";
        $res = mysqli_query($mysqli,$sql);
        $linhas = mysqli_num_rows($res);
        for($i=0; $i < $linhas; $i++){
            $usuario = mysqli_fetch_array($res);
            echo "Username: ".$usuario["username"]."<br>";
            echo "Senha: ".$usuario["senha_cript"]."<br>";
            echo "Nome: ".$usuario["nome"]."<br>";
            echo "Idade: ".$usuario["idade"]."<br>";
            echo "Email: ".$usuario["email"]."<br>";
            echo "<a href='altera.php?cod_usuario=".$usuario["cod_usuario"]."'>Alterar usuário</a>";
            echo "<br>----------------------------------<br>";
        }
    }*/
      
    mysqli_close($mysqli);
   
?>