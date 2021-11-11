<?php
    include "autentica.inc";
    include "conectasql.inc";
    $operacao = $_POST["operacao"];

    if($operacao == "buscar"){
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
    mysqli_close($mysqli);

?>  
    
