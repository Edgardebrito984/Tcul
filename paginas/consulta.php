<?php
include '../conecao.php';
//setlocale(LC_TIME, 'pt_PT.UTF-8', 'pt_BR.UTF-8', 'Portuguese_Portugal.1252');

// Verifica se foi passado rota_id
if (!isset($_GET['rota_id'])) {
    die("Rota não especificada.");
    
    
}

$rota_id = $_GET['rota_id'];

// Buscar dados da rota
$stmt = $conn->prepare("SELECT * FROM rotas WHERE id = ?");
$stmt->bind_param("i", $rota_id);
$stmt->execute();
$result = $stmt->get_result();
$rota = $result->fetch_assoc();



// Buscar as poltronas do autocarro
$sql_poltronas = "SELECT numero, status FROM poltronas WHERE autocarro_id = ?";
$stmt_poltrona = $conn->prepare($sql_poltronas);
$stmt_poltrona->bind_param("i", $autocarro_id);
$stmt_poltrona->execute();
$result_poltrona = $stmt_poltrona->get_result();


?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Viagens</title>
</head>
<body>
<div class="bg-white p-20 max-w-5xl mx-auto font-sans shadow rounded-lg">
  <!-- Barra de busca -->
  <div class="bg-white border rounded-lg shadow p-4 flex flex-wrap items-center gap-4">
    <input type="text" placeholder="Origem" class="border rounded px-4 py-2 w-full sm:w-auto" value="<?php echo htmlspecialchars($rota['origem']);?>">
    <span class="text-xl">→</span>
    <input type="text" placeholder="Destino" class="border rounded px-4 py-2 w-full sm:w-auto" value="<?php echo htmlspecialchars($rota['destino']);?>">
    <input type="date" class="border rounded px-4 py-2 w-full sm:w-auto" value="2025-05-07">
    <button class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
      Procurar passagens
    </button>
  </div>

  <!-- Seletor de datas -->
  <div class="mt-6 flex gap-2 overflow-x-auto pb-2 text-sm">
    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">07/mai qua</button>
    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full">08/mai qui</button>
    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full">09/mai sex</button>
    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full">10/mai sáb</button>
    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full">11/mai dom</button>
    <!-- Adicione dinamicamente -->
  </div>

<?php
  // Exemplo: listar viagens da rota atual
$rota_id = $_GET['rota_id']; // ou outro método para capturar a rota

$sql = "SELECT * FROM viagens WHERE rota_id = ? ORDER BY data_partida ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rota_id);
$stmt->execute();
$result = $stmt->get_result();

while ($viagem = $result->fetch_assoc()) {

    $data_viagem = date("d/m/Y", strtotime($viagem['data_partida']));
    $hora_partida = date("H:i", strtotime($viagem['hora_partida']));
    $hora_chegada = date("H:i", strtotime($viagem['hora_chegada']));
    ?>
    
    <!-- CARD -->
    <div class="border rounded-lg shadow p-4 flex justify-between items-center bg-white mt-4">
      <!-- Esquerda -->
      <div class="w-1/3">
        <p class="font-semibold text-blue-800">
        <img src="../imagens/tcul2.png" alt=""></p>
      </div>

      <!-- Centro -->
      <div class="w-1/3 text-center">
        <p class="text-sm text-gray-500"><?php echo $data_viagem; ?></p>
        <p class="text-xl font-medium text-gray-800"><?php echo $hora_partida; ?> → <?php echo $hora_chegada; ?></p>
        <p class="text-sm text-gray-500"><?php echo $rota['origem']; ?> → <?php echo $rota['destino']; ?></p>
      </div>

      <!-- Direita -->
      <div class="w-1/3 text-right">
      <p class="text-lg font-bold text-green-600">Kz <?php echo number_format($rota['preco'], 2, ',', '.'); ?></p>

        <a href="consulta2.php?viagem_id=<?php echo $viagem['id']; ?>">
          <button class="mt-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Selecionar poltrona
          </button>
        </a>
      </div>
    </div>

    <?php
    }
  ?>

</body>
</html>