<?php
//session_start();
include('conecao.php');

if(isset($_POST['cadastrar'])){
    $nome = htmlentities(mysqli_real_escape_string($conn, $_POST['nome']));
    $data_nascimento = htmlentities(mysqli_real_escape_string($conn, $_POST['data_nascimento']));
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    $telefone = htmlentities(mysqli_real_escape_string($conn, $_POST['telefone']));
    $numero_bilhete = htmlentities(mysqli_real_escape_string($conn, $_POST['numero_bilhete']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

    if(strlen($password) < 8){
        echo "<script>alert('O mínimo de caracteres para a senha é 8! por-favor tente novamente');</script>";
        exit();
    }

    
    $verificar_email = "SELECT * FROM `passageiros` WHERE email = '$email'";
    $run_email = mysqli_query($conn, $verificar_email);

    if(mysqli_num_rows($run_email) > 0){
        echo "<script>alert('O email inserido já foi cadastrado.');</script>";
        echo "<script>window.open('../paginas/cadastro_modal.php', '_self');</script>";
        exit();
    }

    
    $insert = "INSERT INTO `passageiros` (nome, data_nascimento, email, telefone, numero_bilhete, password) 
               VALUES ('$nome', '$data_nascimento', '$email', '$telefone', '$numero_bilhete', '$password')";
    $query = mysqli_query($conn, $insert);

    if($query){
        echo "<script>alert('$nome, sua conta foi criada com sucesso!');</script>";
        echo "<script>window.open('../paginas/index.php', '_self');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar.');</script>";
    }
}
?>
