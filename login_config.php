<?php  
//cada vez que faço uma função passado a session user,header location, irei utilizar o session_start para iniciar a sessao
session_start();
 require_once "functions.php";

 if(isset($_POST['submit'])) {
     update(); 
 }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caralho</title>
</head>
<body>
<form action="" method="POST" class="inputs" enctype="multipart/form-data">
    <fieldset>
    <legend>Projeto CGE</legend>
        <label for="">Foto:
            <input type="file" name="image">
        </label>

        <label for="name">Nome:
            <input type="text" id="name" name="name" placeholder="Escreva seu nome" required>
        </label> 
    <button type="submit" name="submit">Salvar</button>
    </fieldset>
</form>
</body>
</html>