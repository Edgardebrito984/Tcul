<?php
include("../conecao.php");

$viagem_id = isset($_GET['viagem_id']) ? intval($_GET['viagem_id']) : 0;
$valorUnitario = 0;
$data_partida = "";
$hora_partida = "";
$hora_chegada = "";

$sql_info = "
    SELECT v.data_partida, v.hora_partida, v.hora_chegada, r.preco
    FROM viagens v
    JOIN rotas r ON v.rota_id = r.id
    WHERE v.id = ?
";

$stmt = $conn->prepare($sql_info);
$stmt->bind_param("i", $viagem_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $data_partida = $row['data_partida'];
    $hora_partida = $row['hora_partida'];
    $hora_chegada = $row['hora_chegada'];
    $valorUnitario = intval($row['preco']);
}

$ocupadas = [];
$sql = "SELECT numero FROM poltronas_viagem WHERE viagem_id = ? AND status = 'ocupado'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $viagem_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $ocupadas[] = intval($row['numero']);
}

$ocupadas_json = json_encode($ocupadas);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Reserva de Poltronas</title>
</head>
<body>
<div class="max-w-4xl mx-auto bg-white p-6 shadow rounded-lg">
  <div class="mb-6 text-center">
    <p class="text-xl font-bold text-gray-800">Viagem Selecionada</p>
    <p class="text-gray-700">Data: <strong><?= htmlspecialchars($data_partida) ?></strong></p>
    <p class="text-gray-700">Hora de Partida: <strong><?= htmlspecialchars($hora_partida) ?></strong></p>
    <p class="text-gray-700">Hora de Chegada: <strong><?= htmlspecialchars($hora_chegada) ?></strong></p>
    <p class="text-gray-700">Preço por poltrona: <strong>Kz <?= number_format($valorUnitario, 2, ',', '.') ?></strong></p>
  </div>

  <div class="flex flex-col items-center">
    <div class="flex justify-start mb-4">
      <span class="inline-block w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">🚌</span>
    </div>
    <div id="poltronas" class="grid grid-cols-5 gap-2"></div>
  </div>

  <div class="flex justify-around items-center text-sm mt-6">
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 border rounded"></div><span>Disponível</span>
    </div>
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 bg-orange-500 rounded"></div><span>Selecionado</span>
    </div>
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 bg-gray-400 rounded"></div><span>Ocupado</span>
    </div>
  </div>

  <form  action="pagamento.php" method="POST">
    <input type="hidden" name="viagem_id" value="<?= $viagem_id ?>">
    <input type="hidden" name="poltronas" id="poltronasSelecionadas">
    <input type="hidden" name="valor_total" id="valorTotal">

    <div class="mt-6 flex justify-between items-center">
      <p class="text-lg font-semibold">Valor total: <span id="valor">Kz 0,00</span></p>
      <button type="submit" disabled id="continuar" class="bg-gray-300 text-white px-6 py-2 rounded cursor-not-allowed">
        Continuar reserva
      </button>
    </div>
  </form>
</div>

<script>
  const poltronas = document.getElementById('poltronas');
  const ocupadas = <?= $ocupadas_json ?>;
  const valorUnitario = <?= $valorUnitario ?>;
  let selecionadas = [];

  for (let i = 0; i < 11; i++) {
    const base = i * 4;
    const fileira = [base + 1, base + 2, '|', base + 3, base + 4];

    fileira.forEach(n => {
      const btn = document.createElement('div');

      if (n === '|') {
        btn.className = 'w-4';
      } else {
        btn.textContent = n.toString().padStart(2, '0');
        btn.className = 'w-10 h-10 rounded border text-sm flex items-center justify-center';

        if (ocupadas.includes(n)) {
          btn.classList.add('bg-gray-400', 'cursor-not-allowed');
        } else {
          btn.classList.add('cursor-pointer', 'hover:bg-blue-100');
          btn.addEventListener('click', () => {
            if (selecionadas.includes(n)) {
              selecionadas = selecionadas.filter(p => p !== n);
              btn.classList.remove('bg-orange-500', 'text-white');
            } else {
              selecionadas.push(n);
              btn.classList.add('bg-orange-500', 'text-white');
            }
            atualizarValor();
          });
        }
      }
      poltronas.appendChild(btn);
    });
  }

  const valorSpan = document.getElementById('valor');
  const continuarBtn = document.getElementById('continuar');

  function atualizarValor() {
    const total = selecionadas.length * valorUnitario;
    document.getElementById('valorTotal').value = total;
    document.getElementById('poltronasSelecionadas').value = selecionadas.join(',');
    valorSpan.textContent = `Kz ${total.toLocaleString()}`;
    if (selecionadas.length > 0) {
      continuarBtn.disabled = false;
      continuarBtn.className = 'bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded';
    } else {
      continuarBtn.disabled = true;
      continuarBtn.className = 'bg-gray-300 text-white px-6 py-2 rounded cursor-not-allowed';
    }
  }
</script>

</body>
</html>
