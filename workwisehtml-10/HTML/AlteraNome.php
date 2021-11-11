<?php
    include "conectasql.inc";
    include "autentica.inc";
    $id_usuario = $_GET["id_usuario"];
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario;";
    $res = mysqli_query($mysqli,$sql);
    $usuario = mysqli_fetch_array($res);
    $operacao = $_POST["operacao"];


    if($operacao == "atualizarNome"){
        $nome = $_POST["nome"];
        $erro = 0;

        $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario;";
        $res = mysqli_query($mysqli,$sql);
        $usuario = mysqli_fetch_array($res);

        if(empty($nome) OR strstr($nome,' ') == FALSE){
            echo "Favor digitar seu nome corretamente. <br>";
            $erro = 1;
        }
        if(strlen($nome) > 30){
            echo "O nome deve possuir no máximo 30 caracteres.<br>";
            $erro = 1;
        }
    
      // VERIFICA SE NÃO HOUVE ERRO 
       if($erro == 0) {
         $sql = "UPDATE usuario SET nome = '$nome'";
         $sql .= "WHERE id_usuario = $id_usuario;";  
         mysqli_query($mysqli,$sql);  
         echo "<br>O usuário foi atualizado com sucesso!"; 
         header("Location: my-profile-feed.html"); 
     }
     else{
        echo "<br><a href='alteracadastro.php?id_usuario=".$usuario["id_usuario"]."'>Voltar para Alterar usuário</a>";
     }

}   
    mysqli_close($mysqli);
    
?>
