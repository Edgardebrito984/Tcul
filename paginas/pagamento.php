<?php
include("../conecao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['viagem_id'])) {
    $viagem_id = intval($_POST['viagem_id']);
    $poltronas = explode(',', $_POST['poltronas']);
    $valor_total = intval($_POST['valor_total']);

    // Buscar dados da viagem
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

    <form action="confirmar_pagamento.php" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
      <input type="hidden" name="viagem_id" value="<?= $viagem_id ?>">
      <input type="hidden" name="poltronas" value="<?= implode(',', $poltronas) ?>">
      <input type="hidden" name="valor_total" value="<?= $valor_total ?>">

      <label class="block">
        <span class="text-gray-700">Seu email:</span>
        <input type="email" name="email" required class="mt-1 block w-full border p-2 rounded">
      </label>

      <label class="block">
        <span class="text-gray-700">Comprovativo de pagamento (PDF ou imagem):</span>
        <input type="file" name="comprovativo" accept=".pdf,.jpg,.jpeg,.png" required class="mt-1 block w-full">
      </label>

      <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
        Confirmar pagamento
      </button>
    </form>
  </div>
</body>
</html>

