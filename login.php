<?php 
session_start();
 require_once "functions.php";
 
 if(isset($_POST['acessar'])) {
    login();
}
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Darumadrop+One:regular" rel="stylesheet" />
    <title>Projeto CGE - PHP</title>
</head>
<body>
    <main class="main2"> 


    <section class="section">
        <img src="./digital_artist_male.png" id="img-1" alt="imagem">
        <form action="" method="post" class="form">
            <fieldset>
                    <legend>Login</legend>
                    <label for="Email">Email</label>
                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Insirá sua senha" required>
                    <button class="btn2" type="submit" name="acessar" value="Acessar" >Entrar</button>
            </fieldset>
        </form>
    </section>
    </main>

</body>
</html>


<!-- // //sintaxe do banco de dados, eu vou selecionar todos os elementos
// da tabela usuarios MAS SE O EMAIL E SENHA FOREM  IGUALS AOS DA VARIAVEIS PASSADA -->