<?php

function login () {
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "projeto_cge";
//conexao com o banco de dados mysql ou mariadb
$conect = new mysqli($host, $db_user, $db_pass, $db_name);

    if (isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'] )) {

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

        $senha = sha1($_POST['senha']);

        $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' ";

        //fazendo a consulta no banco
        $executar = $conect->query($query);

            //verificando se existe linhas na tabela, se existir ele roda, se nao error
        if( mysqli_num_rows($executar) <= 0 ) {
           echo "<script>alert(' Credenciais invalidas! ') </script>";
        }else {
            //iniciando função de rota.
            session_start();
            //sessao user vai receber o email do usuario do banco.
            $_SESSION['user'] = $_POST['email'];
            //crio a rota quando usuario logar redirecionado para outro index php.
            header("Location: principal.php");
        }  
    }
}

function search() {
    $key = 'cbd38ca02d637f02d5e4a89837e4c01b';
    //se existir a variavel global submit no caso o name do button ele fara isso:
    if (isset($_POST['submit'])) {
        //pegando o valor literalmente do input pelo name
        $musica = $_POST['value'];
        //estruturou a url da api com a key user e variavel armazenando valor do input
        $url = "http://ws.audioscrobbler.com/2.0/?method=track.search&track={$musica}&api_key={$key}&format=json";
       

        $ch = curl_init(); // Inicia uma nova sessão cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Define a URL de destino
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Define que o retorno da requisição deve ser armazenado em uma variável
        
        // Define a proxy manualmente
        curl_setopt($ch, CURLOPT_PROXY, 'proxy.prodemge.gov.br');
        curl_setopt($ch, CURLOPT_PROXYPORT, '8080');
        
        $response = curl_exec($ch); // Executa a requisição cURL e armazena o retorno na variável $response
        
        curl_close($ch); // Encerra a sessão cURL
        
        // //fazendo a requisição pegando a url
        // $response = file_get_contents($url);
        //transformando em json a response
        $data = json_decode($response, true);
        
        //aqui da pra  ver claramente um console log kkkk, com base no valor do input apos exec a function,
        // ele me traz o *1 valor do array com base na pesquisa ex: pesquisei naldo - volta o primeiro indice 0 json do array
        // var_dump($data['results']['trackmatches']['track'][0]);
        //retornando o value do json, no caso results para
        //o resultado de name nome da music e artist para o nome dele
       
            //ESTUDAR AMANHA!!
            if(isset($data['results']['trackmatches']['track'])){

                return $data['results']['trackmatches']['track'];
      
            }else{
                echo "Música não encontrada.";
            }
       
    }
}




function update() {
    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "projeto_cge";

    $connect = new mysqli($host, $db_user, $db_pass, $db_name);

    $name = $_POST['name'];

    if (isset($_FILES['image'])) {
        $arquivo = $_FILES['image'];
    
        $pasta = "arquivo/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        if($extensao != "jpg" && $extensao != 'png') {
            die("Arquivo não suportado ;(");
        }

       $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
       $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);


       if ($deu_certo) {
        $sql = "UPDATE usuarios SET nome = '$name', nome_img = '$nomeDoArquivo', path = '$path' WHERE email = '{$_SESSION['user']}'";
        $result = $connect->query($sql);

        if ($result) {
            echo "Informações do usuário atualizadas com sucesso!";
            header("Location: login.php");
            exit;
        } else {
            echo "Erro ao atualizar informações do usuário: " . $connect->error;
        }

    } else {
        echo "Erro ao enviar o arquivo: " . $connect->error;
    }
        

    } 
    
}





     // if($result) {
        //     echo "arquivo enviado com sucesso!";
        //     header("Location: login.php");
        // }else {
        //     echo "Erro ao enviar o arquivo: " . $connect->error;
        // }





        // $sql = "INSERT INTO usuarios (nome_img, nome, path ) VALUES('$nomeDoArquivo','$name', '$path')";


       // if ($result) {
        //     // Recupera o último ID inserido
        //     $ultimoID = mysqli_insert_id($connect);

        //     // Atualiza o registro do usuário com as informações de nome e imagem
        //     $atualizacao = "UPDATE usuarios SET nome = '$name', path = '$path' WHERE id = $ultimoID";
        //     $resultado = $connect->query($atualizacao);

        //     if ($resultado) {
        //         echo "Arquivo enviado e perfil atualizado com sucesso!";
        //         header("Location: login.php");
        //         exit;
        //     } else {
        //         echo "Erro ao atualizar informações de perfil: " . $connect->error;
        //     }
        // } else {
        //     echo "Erro ao enviar o arquivo: " . $connect->error;
        // }









// function update($session) {
//     $host = "localhost";
//     $db_user = "root";
//     $db_pass = "";
//     $db_name = "projeto_cge";

//     $connect = new mysqli($host, $db_user, $db_pass, $db_name);
//     $name = $_POST['name'];
    
//     if(isset($_FILES['image'])) {

//         //pegando imagem
//         $img = $_FILES['image'];
//         //diretorio
//         $dir = "uploads/";
//         //concatenando diretorio com nome da imagem.
//         $target_file = $dir . basename($img["name"]); 
//         //enviando arquivos, para pasta com nome do arq
//         if(move_uploaded_file($img["tmp_name"], $target_file)) {
//             //atualizando o banco colocando  imagem e name e valores de imagem e diretorio e name se meu email que é user
//             $sql = "UPDATE usuarios SET (img_dir, nome) values ({$target_file}, {$name}) WHERE email = {$user}";
//             $result = $connect->query($sql);
            
//             if($result) {
//                 echo "arquivo enviado com sucesso!";
//                 header("Location: principal.php");
//             }else {
//                 echo "Erro ao enviar o arquivo: " . $connect->error;
//             }
          
//         }
//     }

// }