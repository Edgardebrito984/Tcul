<?php
session_start();
require('../conecao.php');

if(isset($_POST['criar_motorista'])) {

    $Nome=htmlentities(mysqli_real_escape_string($conn, $_POST['Nome']));
    $Data_nascimento=htmlentities(mysqli_real_escape_string($conn, $_POST['Data_nascimento']));
    $Contacto=htmlentities(mysqli_real_escape_string($conn, $_POST['Contacto']));
    $email=htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    
    

    $insert="INSERT INTO motorista(Nome, Data_nascimento, Contacto, email ) 
    VALUES ('$Nome','$Data_nascimento','$Contacto','$email')";

        mysqli_query($conn,$insert);
        if(mysqli_affected_rows($conn)>0){
            $_SESSION['mensagem']='Motorista cadastrado com sucesso';
            header('Location: tabela-motorista.php');
            exit;
        }else{
            $_SESSION['mensagem']='Erro ao cadastrar motorista';
            header('Location: tabela-motorista.php');
            exit;
        }
}


if(isset($_POST['actualizar_motorista'])) {
    $motorista_id = htmlentities(mysqli_real_escape_string($conn,$_POST['motorista_id']));


    $Nome=htmlentities(mysqli_real_escape_string($conn, $_POST['Nome']));
    $Data_nascimento=htmlentities(mysqli_real_escape_string($conn, $_POST['Data_nascimento']));
    $Contacto=htmlentities(mysqli_real_escape_string($conn, $_POST['Contacto']));
    $email=htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    
    

    $insert="UPDATE motorista SET Nome= '$Nome', Data_nascimento='$Data_nascimento', Contacto='$Contacto', email='$email'";

    $insert .=" where id='$motorista_id'";
        mysqli_query($conn,$insert);
        if(mysqli_affected_rows($conn)>0){
            $_SESSION['mensagem']='Motorista Actualizado com sucesso';
            header('Location: tabela-motorista.php');
            exit;
        }else{
            $_SESSION['mensagem']='Erro ao Actualizar motorista';
            header('Location: tabela-motorista.php');
            exit;
        }
}

if(isset($_POST['delete_motorista'])){
    $motorista_id = htmlentities(mysqli_real_escape_string($conn,$_POST['delete_motorista']));

    $insert="DELETE FROM motorista where id='$motorista_id'";
    mysqli_query($conn,$insert);

    if(mysqli_affected_rows($conn)>0){
        $_SESSION['mensagem']='Motorista excluido com sucesso com sucesso';
        header('Location: tabela-motorista.php');
        exit;
    }else{
        $_SESSION['mensagem']=' motorista não excluido';
        header('Location: tabela-motorista.php');
        exit;
    }
}
if(isset($_POST['delete_rota'])){
    $rota_id = htmlentities(mysqli_real_escape_string($conn,$_POST['delete_rota']));

    $insert="DELETE FROM rotas where id='$rota_id'";
    mysqli_query($conn,$insert);

    if(mysqli_affected_rows($conn)>0){
        $_SESSION['mensagem']='Rota excluida com sucesso.';
        header('Location: tabela_rota.php');
        exit;
    }else{
        $_SESSION['mensagem']=' Rota não excluido';
        header('Location: tabela_rota.php');
        exit;
    }
}


if(isset($_POST['criar_autocarro'])) {
    require '../conecao.php';

    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $placa = mysqli_real_escape_string($conn, $_POST['placa']);
    $motorista_id = intval($_POST['motorista_id']);

    // Verificar se um motorista foi selecionado
    if ($motorista_id <= 0) {
        $_SESSION['mensagem'] = "Erro: Selecione um motorista válido!";
        header('Location: tabela-autocarro.php');
        exit;
    }

    // Verificar se a placa já existe
    $verifica = "SELECT id FROM autocarros WHERE placa = '$placa'";
    $result = mysqli_query($conn, $verifica);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['mensagem'] = "Erro: Já existe um autocarro com esta placa!";
        header('Location: tabela-autocarro.php');
        exit;
    }

    // Inserir autocarro
    $insert = "INSERT INTO autocarros (modelo, placa, motorista_id) VALUES ('$modelo', '$placa', '$motorista_id')";
    
    if ($conn->query($insert) === TRUE) {
        $autocarro_id = $conn->insert_id; // Obtém o ID do autocarro recém-cadastrado
    
        // Criar 48 poltronas automaticamente
        $values = [];
        for ($i = 1; $i <= 48; $i++) {
            $values[] = "($i, 'livre', $autocarro_id)";
        }

        // Se houver valores, insere na tabela
        if (!empty($values)) {
            $insert_poltronas = "INSERT INTO poltronas (numero, status, autocarro_id) VALUES " . implode(", ", $values);
        
            if ($conn->query($insert_poltronas) === TRUE) {
                $_SESSION['mensagem'] = 'Autocarro e poltronas cadastrados com sucesso';
                header('Location: tabela-autocarro.php');
                exit;
            } else {
                echo "Erro ao inserir poltronas: " . $conn->error;
            }
        }
    } else {
        echo "Erro ao cadastrar o autocarro: " . $conn->error;
    }
}
if(isset($_POST['delete_autocarro'])){
    $autocarro_id = htmlentities(mysqli_real_escape_string($conn,$_POST['delete_autocarro']));

    $insert="DELETE FROM autocarros where id='$autocarro_id'";
    mysqli_query($conn,$insert);

    if(mysqli_affected_rows($conn)>0){
        $_SESSION['mensagem']='autocarro excluido com sucesso.';
        header('Location: tabela-autocarro.php');
        exit;
    }else{
        $_SESSION['mensagem']=' autocarro excluida';
        header('Location: tabela-autocarro.php');
        exit;
    }
}

if(isset($_POST['criar_rota'])){

    $origem =htmlentities( mysqli_real_escape_string($conn,$_POST['origem']));
    $destino = mysqli_real_escape_string($conn, $_POST['destino']);
    $data_partida = htmlentities(mysqli_real_escape_string($conn, $_POST['data_partida']));
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $autocarro_id = intval($_POST['autocarro_id']);


    $insert="INSERT INTO rotas (origem, destino,data_partida, preco,autocarro_id)
    VALUES('$origem','$destino', '$data_partida','$preco','$autocarro_id')";

    mysqli_query($conn, $insert);
    if(mysqli_affected_rows($conn)>0){
        $_SESSION['mensagem'] = 'rota criada com sucesso';
        header('LOCATION: tabela_rota.php');
        exit;
    }else{
        $_SESSION['mensagem']='Erro ao criar rota';
        header('LOCATION: tabela_rota.php');
        exit;
    }
}

if(isset($_POST['cadastrar_data'])){
    $data_viagem = htmlentities( mysqli_real_escape_string( $conn, $_POST['data_viagem']));
    $autocarro_id = intval($_POST['autocarro_id']);

    $insert= "INSERT INTO datas_viagens (data_viagem, autocarro_id) 
    values ('$data_viagem','$autocarro_id')";

    mysqli_query($conn,$insert);
    if(mysqli_affected_rows($conn)>0){
        $_SESSION['mensagem']='Data criada com sucesso';
        header('Location: tabela_data.php');
        exit;
    }else{
        $_SESSION['mensagem']='Erro ao criar data';
        header('Location: tabela_data.php');
        exit;
    }
}
if(isset($_POST['criar_poltronas'])){

include '../conecao.php'; // ou ajuste o caminho da conexão

// ID da data_viagem para qual você quer gerar as poltronas
$data_viagem_id = 1; // 🔁 Altere para a data_viagem_id desejada

// Verifica se já existem poltronas para essa data
$verifica = $conn->prepare("SELECT COUNT(*) as total FROM poltronas WHERE data_viagem_id = ?");
$verifica->bind_param("i", $data_viagem_id);
$verifica->execute();
$resultado = $verifica->get_result();
$row = $resultado->fetch_assoc();

if ($row['total'] > 0) {
    echo "⚠ Já existem poltronas cadastradas para essa data_viagem_id.";
    exit;
}

// Inserir 48 poltronas com status 'livre'
$stmt = $conn->prepare("INSERT INTO poltronas (data_viagem_id, numero, status) VALUES (?, ?, 'livre')");

for ($i = 1; $i <= 48; $i++) {
    $stmt->bind_param("ii", $data_viagem_id, $i);
    $stmt->execute();
}

echo "✅ 48 poltronas criadas com sucesso para data_viagem_id = $data_viagem_id";

$conn->close();

}
?>