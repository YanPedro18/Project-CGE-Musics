<?php

function cadastrarusuario() {
    $host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "projeto_cge";

    $connect = new mysqli($host, $db_user, $db_pass, $db_name);

    
    if (isset($_POST['submit']) AND !empty($_POST['emails']) AND !empty($_POST['senhas'] )) {
        // Recebe os dados enviados pelo formulário

        $emails = filter_input(INPUT_POST, "emails", FILTER_VALIDATE_EMAIL);
        $senhas = sha1($_POST['senhas']);
        

        $sqls = "INSERT INTO usuarios (email, senha) VALUES ('$emails', '$senhas')";
        $executars = $connect->query($sqls);
        
        
                    session_start();
                    $_SESSION['user'] = $_POST['emails'];
                    header("Location: login_config.php");
                       
                
            }
    }
