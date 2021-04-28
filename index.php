<?php
    //conexão - o php conectou no banco
    require_once'includes/bd_connect.php';
    //Sessão
    session_start();
    
    //Botão enviar
    if(isset($_POST['btn-entrar'])):
       $erros = array();
       $email = mysqli_escape_string($connect,$_POST['email']);
       $senha = mysqli_escape_string($connect,$_POST['senha']);
       
       if(isset($_POST['lembra-senha'])):
           setcookie('email', $email, time()+3600);
           setcookie('senha', $senha, time()+3600);
       endif;

       if(empty($email) || empty($senha)):
           $erros[] = "<li>O campo de login/senha precisa ser preenchido</li>";
       else:
           $sql = "SELECT email from tblogin where email = '$email'";//query
           $resultado = mysqli_query($connect, $sql);
          
           if(mysqli_num_rows($resultado)>0):
                $sql = "SELECT * from tblogin where email = '$email' and senha = '$senha'";//
                $resultado = mysqli_query($connect, $sql);
                if(mysqli_num_rows($resultado)==1):
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['íd_usuario']=$dados['pkcod'];
                    header('Location: home.php');
                else:
                    $erros[] = "<li> Usuário e senha não confere!!</li>";
                endif;
            else:
                    $erros[] = "<li> Usuário inexistente!!</li>";
            endif;
        endif;

    endif;

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>A U T E N T I C A Ç Ã O</title>
</head>
<body>
   
    <div class="container">
        <h1>Login</h1>
        <?php 
        if(!empty($erros)):
            foreach($erros as $erro):
                echo $erro;
            endforeach;
        endif;
        ?>
        <hr>
        <h3>Entre com seus dados para acessar o sistema</h3>
        <hr>
        <div class="box">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                <input type="email" name="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" class="entrada" placeholder="fulano@dominio.com"><br><br>
                <input type="password" name="senha" value="<?php echo isset($_COOKIE['senha']) ? $_COOKIE['senha'] : '' ?>" class="entrada"><br>
                Lembrar senha <input type="checkbox" name="lembrar-senha" id="lembrar-senha"><br>
                <button name="btn-entrar" type="submit">Entrar</button>
               
            </form>

        </div>
    </div>
</body>
</html>
