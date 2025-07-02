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
if(isset($_POST['actualizar_rota'])) {
    $rota_id = htmlentities(mysqli_real_escape_string($conn,$_POST['rota_id']));


    $origem=htmlentities(mysqli_real_escape_string($conn, $_POST['origem']));
    $destino=htmlentities(mysqli_real_escape_string($conn, $_POST['destino']));
    $preco=htmlentities(mysqli_real_escape_string($conn, $_POST['preco']));

    
    $insert="UPDATE rotas SET origem= '$origem', destino='$destino', preco='$preco'";
    $insert .=" where id='$rota_id'";
        mysqli_query($conn,$insert);
        if(mysqli_affected_rows($conn)>0){
            $_SESSION['mensagem']='Rota Actualizado com sucesso';
            header('Location: tabela_rota.php');
            exit;
        }else{
            $_SESSION['mensagem']='Erro ao Actualizar Rota';
            header('Location: tabela_rota.php');
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
if(isset($_POST['actualizar_autocarro'])) {
    $autocarro_id = htmlentities(mysqli_real_escape_string($conn,$_POST['autocarro_id']));


    $modelo=htmlentities(mysqli_real_escape_string($conn, $_POST['modelo']));
    $placa=htmlentities(mysqli_real_escape_string($conn, $_POST['placa']));
    $motorista_id=htmlentities(mysqli_real_escape_string($conn, $_POST['motorista_id']));

    
    // Verifica se o autocarro já possui um motorista atribuído
    $sql_check_autocarro = "SELECT motorista_id FROM autocarros WHERE id='$autocarro_id'";
    $result_autocarro = mysqli_query($conn, $sql_check_autocarro);
    $row_autocarro = mysqli_fetch_assoc($result_autocarro);

    if ($row_autocarro && !is_null($row_autocarro['motorista_id'])) {
        $_SESSION['mensagem'] = 'Erro: Este autocarro já possui um motorista atribuído. Não é possível trocar.';
        header('Location: tabela-autocarro.php');
        exit;
    }

    // Verifica se o motorista existe
    $sql_check_motorista = "SELECT id FROM motorista WHERE id='$motorista_id'";
    $result_motorista = mysqli_query($conn, $sql_check_motorista);

    if (mysqli_num_rows($result_motorista) == 0) {
        $_SESSION['mensagem'] = 'Erro: O motorista selecionado não existe.';
        header('Location: tabela-autocarro.php');
        exit;
    }

    $insert="UPDATE autocarros SET modelo= '$modelo', placa='$placa', motorista_id='$motorista_id'";

    $insert .=" where id='$autocarro_id'";
        mysqli_query($conn,$insert);
        if(mysqli_affected_rows($conn)>0){
            $_SESSION['mensagem']='Autocarro Actualizado com sucesso';
            header('Location: tabela-autocarro.php');
            exit;
        }else{
            $_SESSION['mensagem']='Erro ao Actualizar autocarro';
            header('Location: tabela-autocarro.php');
            exit;
        }
}

if (isset($_POST['delete_motorista'])) {
    $motorista_id = htmlentities(mysqli_real_escape_string($conn, $_POST['delete_motorista']));

    // Primeiro, checar se há autocarros usando este motorista
    $sql_check = "SELECT COUNT(*) AS total FROM autocarros WHERE motorista_id='$motorista_id'";
    $result_check = mysqli_query($conn, $sql_check);
    $row = mysqli_fetch_assoc($result_check);

    if ($row['total'] > 0) {
        // Existem autocarros vinculados: não permite excluir
        $_SESSION['mensagem'] = 'Erro: Não é possível excluir o motorista. Existem autocarros atribuídos a ele.';
        header('Location: tabela-motorista.php');
        exit;
    }

    // Se não tiver autocarros, pode excluir o motorista
    $delete = "DELETE FROM motorista WHERE id='$motorista_id'";
    mysqli_query($conn, $delete);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = 'Motorista excluído com sucesso.';
    } else {
        $_SESSION['mensagem'] = 'Erro: motorista não excluído.';
    }

    header('Location: tabela-motorista.php');
    exit;
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

if (isset($_POST['criar_rota'])) {

    $origem = htmlentities(mysqli_real_escape_string($conn, $_POST['origem']));
    $destino = htmlentities(mysqli_real_escape_string($conn, $_POST['destino']));
    $preco = htmlentities(mysqli_real_escape_string($conn, $_POST['preco']));

    // Verifica se já existe uma rota com a mesma origem e destino
    $verificar = "SELECT * FROM rotas WHERE origem = '$origem' AND destino = '$destino'";
    $resultado = mysqli_query($conn, $verificar);


           if (strtolower(trim($origem)) === strtolower(trim($destino))) {
        $_SESSION['mensagem'] = 'A origem e o destino não podem ser iguais.';
        header('Location: tabela_rota.php');
        exit;
    }


    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['mensagem'] = 'Já existe uma rota com essa origem e destino!';
        header('Location: tabela_rota.php');
        exit;
    }

    // Se não existir, insere a nova rota
    $insert = "INSERT INTO rotas (origem, destino,preco) VALUES ('$origem', '$destino','$preco')";
    mysqli_query($conn, $insert);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = 'Rota criada com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar rota!';
    }

    header('Location: tabela_rota.php');
    exit;
}

if (isset($_POST['criar_viagem'])) {

    $rota_id = intval($_POST['rota_id']);
    $data_partida = htmlentities(mysqli_real_escape_string($conn, $_POST['data_partida']));
    $hora_partida = mysqli_real_escape_string($conn, $_POST['hora_partida']);
    $hora_chegada = htmlentities(mysqli_real_escape_string($conn, $_POST['hora_chegada']));
    $autocarro_id = intval($_POST['autocarro_id']);

    // Verificação: impedir datas passadas
    $data_atual = date('Y-m-d');
    if ($data_partida < $data_atual) {
        $_SESSION['mensagem'] = 'Não é possível cadastrar uma viagem com data passada.';
        header('Location: tabela_viagens.php');
        exit;
    }

    // Inserir a viagem
    $insert = "INSERT INTO viagens (rota_id, data_partida, hora_partida, hora_chegada, autocarro_id)
               VALUES ('$rota_id', '$data_partida', '$hora_partida', '$hora_chegada', '$autocarro_id')";

    if (mysqli_query($conn, $insert)) {
        $viagem_id = $conn->insert_id;

        if ($viagem_id) {
            for ($i = 1; $i <= 48; $i++) {
                $stmt = $conn->prepare("INSERT INTO poltronas_viagem (viagem_id, numero) VALUES (?, ?)");
                $stmt->bind_param("ii", $viagem_id, $i);
                $stmt->execute();
            }

            $_SESSION['mensagem'] = 'Viagem criada com sucesso, com poltronas!';
        } else {
            $_SESSION['mensagem'] = 'Erro: ID da viagem não foi gerado.';
        }

        header('Location: tabela_viagens.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar a viagem.';
        header('Location: tabela_viagens.php');
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