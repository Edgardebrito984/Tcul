<?php
include("../conecao.php");
require '../vendor/autoload.php'; // ou inclua manualmente os arquivos do PHPMailer

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
    $email = $_POST['email'];
    $codigo_reserva = gerarCodigoReserva();
    $poltronas_str = implode(',', $poltronas);

    // Inserir reserva
    $sql = "INSERT INTO reserva (codigo_reserva, viagem_id, poltronas, email, valor_total, status)
            VALUES (?, ?, ?, ?, ?, 'confirmada')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissd", $codigo_reserva, $viagem_id, $poltronas_str, $email, $valor_total);
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
        <p><strong>Valor:</strong> Kz $valor_total</p>
        <p>Apresente o seguinte QR Code na hora do embarque:</p>
        <p><img src='$qr_link' alt='QR Code'></p>
        <p>Dirija-se até a agência do Grafanil bar, para fazer embarbar</p>
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
        echo "<script>alert('Reserva feita com sucesso! Código: $codigo_reserva'); window.location.href='index.php';</script>";
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
<body class="bg-gray-100 p-6">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-center">Confirmação de Pagamento</h1>

    <p><strong>Origem:</strong> <?= htmlspecialchars($viagem['origem']) ?></p>
    <p><strong>Destino:</strong> <?= htmlspecialchars($viagem['destino']) ?></p>
    <p><strong>Data da viagem:</strong> <?= htmlspecialchars($viagem['data_partida']) ?></p>
    <p><strong>Hora de partida:</strong> <?= htmlspecialchars($viagem['hora_partida']) ?></p>
    <p><strong>Hora de chegada:</strong> <?= htmlspecialchars($viagem['hora_chegada']) ?></p>
    <p><strong>Preço por poltrona:</strong> Kz <?= number_format($viagem['preco'], 2, ',', '.') ?></p>
    <p><strong>Poltronas selecionadas:</strong> <?= implode(', ', $poltronas) ?></p>
    <p class="text-lg mt-2"><strong>Total a pagar:</strong> <span class="text-green-600">Kz <?= number_format($valor_total, 2, ',', '.') ?></span></p>


 



  <form method="post" class="mt-6 space-y-4">
  <input type="hidden" name="viagem_id" value="<?= $viagem_id ?>">
  <input type="hidden" name="poltronas" value="<?= implode(',', $poltronas) ?>">
  <input type="hidden" name="valor_total" value="<?= $valor_total ?>">

  <label class="block">
    <span class="text-gray-700">Seu email:</span>
    <input type="email" name="email" required class="mt-1 block w-full border p-2 rounded">
  </label>

  <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
    Simular pagamento
  </button>
</form>


<div id="resposta" class="mt-4 text-sm text-gray-700"></div>

  </div>




</body>
</html>

