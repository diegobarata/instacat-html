<?php
   // Recebe os campos do formulário
   $email = $_POST["email"];
   $senha = $_POST["senha"];

   // Realiza a consulta no banco de dados
   include "conectasql.inc";
   $sql = "SELECT * FROM usuario WHERE email = '$email';";
   $res = mysqli_query($mysqli, $sql);

   if(mysqli_num_rows($res) != 1){ // testa se não encontrou o email
       echo "Email inválido!";
       //echo "<p><a href='sign-in.html'>Página de login</a></p>";
   }
   else{
       $usuario = mysqli_fetch_array($res);
       if(!password_verify($senha, $usuario["senha"])){ // testa se a senha está errada
           echo "Senha inválida!";
           //echo "<p><a href='sign-in.html'>Página de login</a></p>";
       }
       else{ // usuário e senha corretos, abre a sessão
           session_start();
           $_SESSION["email"] = $email;
           $_SESSION["senha"] = $usuario["senha"];
           // direciona à página inicial
           header("Location: my-profile-feed.html");
       }
   }
   mysqli_close($mysqli);

?>