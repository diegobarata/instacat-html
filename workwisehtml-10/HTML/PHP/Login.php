<?php
   include "cadastrar.php";
   // Recebe os campos do formulário
   $email = $_POST["email"];
   $senha = $_POST["senha"];

   // Realiza a consulta no banco de dados
   include "conectasql.inc";
   $sql = "SELECT * FROM usuarios WHERE email = '$email';";
   $res = mysqli_query($mysqli, $sql);

   if(mysqli_num_rows($res) != 1){ // testa se não encontrou o username
       echo "Email inválido!";
       //echo "<p><a href='sign-in.html'>Página de login</a></p>";
   }
   else{
       $usuario = mysqli_fetch_array($res);
       if($senha != $usuario["senha"]){ // testa se a senha está errada
           echo "Senha inválida!";
           //echo "<p><a href='sign-in.html'>Página de login</a></p>";
       }
       else{ // usuário e senha corretos, abre a sessão
           session_start();
           $_SESSION["username"] = $username;
           $_SESSION["senha"] = $senha;
           // direciona à página inicial
           header("Location: index.html");
       }
   }
   mysqli_close($mysqli);

?>