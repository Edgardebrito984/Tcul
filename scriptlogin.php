<?php
    
    include('conecao.php');


    if(isset($_POST['login'])){
        $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
        $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

        $selecionar_passageiro ="SELECT * FROM `passageiros` where email ='$email' AND password ='$password'";

        $query = mysqli_query($conn, $selecionar_passageiro);
       
        if(mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['id'];       // Guarda o ID do usuário na sessão
            $_SESSION['email']   = $row['email'];  // Guarda o email do usuário na sessão
            $_SESSION['nome'] = $row['nome'] ;   
     // Redireciona para a página do sistema
     header("Location: ../paginas/index.php");
     
     exit();
        }
        else {
            echo "<script>alert('POR FAVOR VERIFIQUE O EMAIL OU SENHA.');</script>";
        }
    }
?>