<?php
    include "conectasql.inc";
    $id_usuario = $_GET["id_usuario"];
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario;";
    $res = mysqli_query($mysqli,$sql);
    $usuario = mysqli_fetch_array($res);



    if($operacao == "atualizar"){
        $id_usuario = $_POST["id_usuario"];
        $senha_atual = $_POST["senha_atual"];
        $senha_nova = $_POST["senha_nova"];
        $senha_nova_rep = $_POST["senha_nova_rep"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $erro = 0;

        $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario;";
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
         $sql .= "WHERE id_usuario = $id_usuario;";  
         mysqli_query($mysqli,$sql);  
         echo "<br>O usuário foi atualizado com sucesso!"; 
         echo "<br><br><a href='index.html'>Tela Inicial</a>"; 
     }
     else{
        echo "<br><a href='alteracadastro.php?id_usuario=".$usuario["id_usuario"]."'>Voltar para Alterar usuário</a>";
     }

}   
    mysqli_close($mysqli);
    
?>
