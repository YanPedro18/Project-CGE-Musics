<?php
  session_start();

  require_once "functions.php";
  
  // Verifica se o usuário está logado
  if (isset($_SESSION['user'])) {
      $email = $_SESSION['user'];
  
      // Recupera os dados do usuário
      $host = "localhost";
      $db_user = "root";
      $db_pass = "";
      $db_name = "projeto_cge";
  
      $connect = new mysqli($host, $db_user, $db_pass, $db_name);
      //seleciono a tabela com as linha de nome, nome_img, path SE meu email do banco for = ao email do user
      $query = "SELECT nome, nome_img, path FROM usuarios WHERE email = '$email'";
      //fazendo a consulta
      $result = $connect->query($query);
  
      if ($result->num_rows > 0) {
        //puxando nome do user e caminha da imagem cadastrada por ele
          $row = $result->fetch_assoc();
          $nomeUsuario = $row['nome'];
          $caminhoImagem = $row['path'];
      } else {
          // Usuário não encontrado
          echo "Usuário não encontrado.";
          exit;
      }
  } else {
      // Se o usuário não estiver logado, redireciona para a página de login
      header("Location: login.php");
      exit();
  }
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Projeto CGE</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="principal.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Favoritos</a>
      </li>
    </ul>
    
  </div>
  <div class="user-profile">
        <span><?php echo $nomeUsuario; ?></span>
        <img src="<?php echo $caminhoImagem; ?>" alt="Imagem do usuário">
    </div>
</nav>


<section class="section-02">
    <h1>PROJETO CGE</h1>
  <div class="input-group mb-1">
    <form action="" method="post">
        <input type="text" class="form-control" placeholder="Escreva uma música" name="value" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" name="submit" type="submit">Enviar</button>
      </div>
    </form>
    <?php
        if(isset($_POST['submit'])) {
          $searchs = search();
        } else {
          $searchs = null;
        }
        
            //ESTUDAR AMANHA!!
        ?>
  </div>
  <div class="m-5">
              <table class="table table-bg">
                  <thead>
                    <tr>
                      <th scope="col" ><i class="ph ph-headphones"></i>Música</th>
                      <th scope="col"><i class="ph ph-vinyl-record"></i>Artistas</th>
                      <th scope="col"><i class="ph ph-music-notes-plus"></i>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  // se minha funçaõ for diferente de null
                  if($searchs !== null) {
                    // pega a funçaõ searchs que retorna...
                    //o meu json track, que vai me dar a variavel $search com valor name e artist
                    //rodando um loop e colocando tudo dentro de tr e td dentro de tbody dentro de table HTML
                    foreach($searchs as $search){
                      echo "<tr>";
                      //a função vira tipo um json, entao search['name] === search.name ou json.name 
                      echo "<td>".$search['name']."</td>";
                      echo "<td>".$search['artist']."</td>";
                      echo "<td>+</td>";
                    }
                  }
                
            //ESTUDAR AMANHA!!
            //ESTUDAR AMANHA!!
                  ?>
                  </tbody>
              </table>
  </div>
  </div>
</section>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>