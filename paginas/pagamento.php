<?php 
$email="";
?>
<?php 
include("../conecao.php");
$viagem_id = $_POST['viagem_id'] ?? 0;


$sql = "SELECT 
            a.placa,
            a.modelo,
            m.nome AS nome_motorista
        FROM viagens v
        JOIN autocarros a ON v.autocarro_id = a.id
        JOIN motorista m ON a.motorista_id = m.id
        WHERE v.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $viagem_id);
$stmt->execute();
$result = $stmt->get_result();

$dadosAutocarro = $result->fetch_assoc();




?>

<?php
include("../conecao.php");
require '../vendor/autoload.php'; // arquivos do PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

// Função para gerar código único
function gerarCodigoReserva($tamanho = 8) {
    return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $tamanho));
}

// Verifica se os dados vieram do POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $viagem_id = intval($_POST['viagem_id']);
    $poltronas = explode(',', $_POST['poltronas']);
    $valor_total = intval($_POST['valor_total']);
     $nome_passageiro = $_POST['nome_passageiro'];
    $email = $_POST['email'];
    
    $codigo_reserva = gerarCodigoReserva();
    $poltronas_str = implode(',', $poltronas);

    // Inserir reserva
    $sql = "INSERT INTO reserva (codigo_reserva, viagem_id, poltronas, email, valor_total, nome_passageiro,status)
            VALUES (?, ?, ?, ?, ?, ?,'confirmada')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissds", $codigo_reserva, $viagem_id, $poltronas_str, $email, $valor_total,$nome_passageiro);
    $stmt->execute();

    // Atualizar status das poltronas
    foreach ($poltronas as $p) {
        $update = $conn->prepare("UPDATE poltronas_viagem SET status = 'ocupado' WHERE viagem_id = ? AND numero = ?");
        $update->bind_param("ii", $viagem_id, $p);
        $update->execute();
    }

    // Enviar e-mail com QR Code
    $qr_link = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($codigo_reserva);
    $mensagem = "
        <p>Sua reserva foi confirmada com sucesso!</p>
        <p><strong>Código da reserva:</strong> $codigo_reserva</p>
        <p><strong>Poltronas:</strong> $poltronas_str</p>
            <h3>Informações do Autocarro</h3>
    <p><strong>Modelo:</strong> {$dadosAutocarro['modelo']}</p>
    <p><strong>Placa:</strong> {$dadosAutocarro['placa']}</p>
    <p><strong>Motorista:</strong> {$dadosAutocarro['nome_motorista']}</p>
        <p>Dirija-se até a agência do Grafanil bar, para fazer embarbar</p>
        <p><strong>Valor:</strong> Kz $valor_total</p>
        <p>Apresente o seguinte QR Code na hora do embarque:</p>
        <p><img src='$qr_link' alt='QR Code'></p>
        
        
    ";

    $mail = new PHPMailer(true);

    try {
      $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ferreiraedgar2022@gmail.com';
        $mail->Password = 'cosd dwmd kewn rmgs'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('ferreiraedgar2022@gmail.com', 'TCUL ');
        $mail->addAddress($email); 

        $mail->isHTML(true);
        $mail->Subject = "Reserva Confirmada - Código $codigo_reserva";
        $mail->Body = $mensagem;

        $mail->send();
        $_SESSION['mensagem'] = "Reserva feita com sucesso! Código: $codigo_reserva!";
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Erro ao enviar o e-mail: {$mail->ErrorInfo}</p>";
    }
}

// Buscar dados da viagem (caso necessário renderizar novamente a página)
if (isset($_POST['viagem_id'])) {
    $viagem_id = intval($_POST['viagem_id']);
    $poltronas = explode(',', $_POST['poltronas']);
    $valor_total = intval($_POST['valor_total']);

    $sql = "
        SELECT v.data_partida, v.hora_partida, v.hora_chegada, r.origem, r.destino, r.preco
        FROM viagens v
        JOIN rotas r ON v.rota_id = r.id
        WHERE v.id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $viagem_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $viagem = $result->fetch_assoc();

    if (!$viagem) {
        echo "<p>Viagem não encontrada.</p>";
        exit;
    }
} else {
    echo "<p>Dados inválidos.</p>";
    exit;
}
?>



<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head> 
<?php 
  include("nav.php");
  ?>
<body class="">
 
 <div class="container">
    <h1 class="titulo">Confirmação de Pagamento</h1>

    <p><strong>Origem:</strong> <?= htmlspecialchars($viagem['origem']) ?></p>
    <p><strong>Destino:</strong> <?= htmlspecialchars($viagem['destino']) ?></p>
    <p><strong>Data da viagem:</strong> <?= htmlspecialchars($viagem['data_partida']) ?></p>
    <p><strong>Hora de partida:</strong> <?= htmlspecialchars($viagem['hora_partida']) ?></p>
    <p><strong>Hora de chegada:</strong> <?= htmlspecialchars($viagem['hora_chegada']) ?></p>
    <p><strong>Preço por poltrona:</strong> Kz <?= number_format($viagem['preco'], 2, ',', '.') ?></p>
    <p><strong>Poltronas selecionadas:</strong> <?= implode(', ', $poltronas) ?></p>
    <p class="total"><strong>Total a pagar:</strong> <span class="valor">Kz <?= number_format($valor_total, 2, ',', '.') ?></span></p>
    <?php
$nome_passageiro = $_SESSION['nome'] ?? 'Desconhecido';
$numero_bilhete = $_SESSION['numero_bilhete'] ?? 'Desconhecido';
?>
    <form method="post" class="formulario">
         <input type="hidden" name="nome_passageiro" value="<?= $nome_passageiro ?>">
          <input type="hidden" name="nome_passageiro" value="<?= $numero_bilhete ?>">
        <input type="hidden" name="viagem_id" value="<?= $viagem_id ?>">
        <input type="hidden" name="poltronas" value="<?= implode(',', $poltronas) ?>">
        <input type="hidden" name="valor_total" value="<?= $valor_total ?>">

        <label class="rotulo">
            <span>Seu email:</span>
            <input type="email" name="email" required class="campo-texto">
        </label>

        <button type="submit" class="botao">fazer pagamento</button>
    </form>
    <p>Obs: Será enviado um código de confirmação para o seu email</p>

    <div id="resposta" class="resposta"></div>
</div>

<?php 
include("footer.php");
?>

<style>

  
.container {
    max-width: 600px;
    margin: 40px auto;
    background-color: #fff;
    padding: 24px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    font-family: sans-serif;
}

.titulo {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.total {
    font-size: 18px;
    margin-top: 10px;
}

.valor {
    color: green;
    font-weight: bold;
}

.formulario {
    margin-top: 24px;
}

.rotulo {
    display: block;
    margin-bottom: 16px;
}

.campo-texto {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid #aaa;
    border-radius: 4px;
    margin-top: 4px;
}

.botao {
    width: 100%;
    background-color: #2f9e44;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.botao:hover {
    background-color: #237a36;
}

.resposta {
    margin-top: 20px;
    font-size: 14px;
    color: #444;
}

</style>



</body>
</html>

