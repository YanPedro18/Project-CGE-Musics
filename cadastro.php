<?php  require_once "cadastraruser.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Darumadrop+One:regular" rel="stylesheet" />
    <title>DTIC - Musics</title>
</head>
<body>

    <main class="main">
    <h1>DTIC - Musics</h1>
  
    <section class="section">
        <img src="./709.png" id="img-2" alt="imagem">
        <form action="" method="post" class="form2">
            <fieldset>
                    <legend>Cadastro</legend>
                    <label for="Email">Email</label>
                    <input type="email" name="emails" placeholder="Digite seu e-mail" required>
                    <label for="senha">Senha</label>
                    <input type="password" name="senhas" placeholder="Insirá sua senha" required>
                    <button class="btn1" type="submit" name="submit">Cadastrar</button>
            </fieldset>
            
        </form>
        <?php
       if (isset($_POST['submit'])) {
        echo "<script>alert(' Credenciais invalidas! ') </script>";
            cadastrarusuario();
         }
        ?>
    </section>
    </main>

</body>
</html>


<!-- // //sintaxe do banco de dados, eu vou selecionar todos os elementos
// da tabela usuarios MAS SE O EMAIL E SENHA FOREM  IGUALS AOS DA VARIAVEIS PASSADA -->