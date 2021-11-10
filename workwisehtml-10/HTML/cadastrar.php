<?php
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
     elseif($operacao == "buscar"){
        $nome = $_POST["nome"];
        $sql = "SELECT * FROM usuario WHERE nome like '%$nome%';";
        $res = mysqli_query($mysqli,$sql);
        $linhas = mysqli_num_rows($res);
        for($i=0; $i < $linhas; $i++){
            $usuario = mysqli_fetch_array($res);
            echo "Nome: ".$usuario["nome"]."<br>";
            echo "----------------------------------<br>";
        }
    }
    elseif($operacao == "atualizar"){
        $cod_usuario = $_POST["cod_usuario"];
        $senha_atual = $_POST["senha_atual"];
        $senha_nova = $_POST["senha_nova"];
        $senha_nova_rep = $_POST["senha_nova_rep"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $erro = 0;

        $sql = "SELECT * FROM usuario WHERE cod_usuario = $cod_usuario;";
        $res = mysqli_query($mysqli,$sql);
        $usuario = mysqli_fetch_array($res);


        if(!password_verify($senha_atual,$usuario["senha_cript"])){
            echo "A senha atual está errada.<br>";
            $erro = 1;
        }
        if(strlen($senha_nova) < 5 OR strlen($senha_nova) > 10){
            echo "A senha nova deve possuir no mínimo 5 e no máximo 10 caracteres.<br>";
            $erro = 1;
        }
        if($senha_nova != $senha_nova_rep){
            echo "A senha nova não foi repetida corretamente.<br>";
            $erro = 1;
        }
        if($nome == $senha_nova){
            echo "O seu nome e a senha nova devem ser diferentes.<br>";
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
            $senha_cript = password_hash($senha_nova, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET senha_cript = '$senha_cript', nome = '$nome',";
            $sql .= "email = '$email'";
            $sql .= "WHERE cod_usuario = $cod_usuario;";  
            mysqli_query($mysqli,$sql);  
            echo "<br>O usuário foi atualizado com sucesso!"; 
            echo "<br><br><a href='index.php'>Tela Inicial</a>"; 
        }
        else{
            echo "<br><a href='altera.php?cod_usuario=".$usuario["cod_usuario"]."'>Voltar para Alterar usuário</a>";
        }
    } 
    mysqli_close($mysqli);
   
?>