<?php
include('conecao.php');

// Inicia a sessão apenas se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

    $selecionar_passageiro = "SELECT * FROM `passageiros` WHERE email ='$email' AND password ='$password'";
    $query = mysqli_query($conn, $selecionar_passageiro);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $nivel = $row['nivel'];

        // Redireciona de acordo com o nível
        if ($nivel === 'admin') {
            // Sessão apenas para admin
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_nome'] = $row['nome'];
            header("Location: ../painel_administrador/index.PHP");
            exit();
        } elseif ($nivel === 'supervisor') {
            // Sessão apenas para supervisor
            $_SESSION['supervisor_id'] = $row['id'];
            $_SESSION['supervisor_email'] = $row['email'];
            $_SESSION['supervisor_nome'] = $row['nome'];
            header("Location: ../supervisor.php");
            exit();
        } else {
            // Sessão apenas para passageiro
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email']   = $row['email'];
            $_SESSION['nome']    = $row['nome'];
            header("Location: ../paginas/index.php");
            exit();
        }
    } else {
        echo "<script>alert('POR FAVOR VERIFIQUE O EMAIL OU SENHA.');</script>";
    }
}

