<?php 
session_start();

$email ="";
?>

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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Reserva de Poltronas</title>
</head>
<body>
  <?php 
  include("nav.php");
  ?>
  <div class="p-20">
<div class="max-w-4xl mx-auto m-20px bg-white  shadow rounded-lg ">
  <div class="mb-6 text-center">
    <p class="text-xl font-bold text-gray-800">Viagem Selecionada</p>
    <p class="text-gray-700">Data: <strong><?= htmlspecialchars($data_partida) ?></strong></p>
    <p class="text-gray-700">Hora de Partida: <strong><?= htmlspecialchars($hora_partida) ?></strong></p>
    <p class="text-gray-700">Hora de Chegada: <strong><?= htmlspecialchars($hora_chegada) ?></strong></p>
    <p class="text-gray-700">Preço por poltrona: <strong>Kz <?= number_format($valorUnitario, 2, ',', '.') ?></strong></p>
  </div>

  <div class="flex flex-col items-center">
    <div class="flex justify-start mb-4">
      <span class=""><br><br></span>
    </div>
    <div id="poltronas" class="flex flex-col gap-2">
  <?php
    include("../conecao.php");
    $viagem_id = $_GET['viagem_id'];

    $query = $conn->prepare("SELECT numero, status FROM poltronas_viagem WHERE viagem_id = ?");
    $query->bind_param("i", $viagem_id);
    $query->execute();
    $result = $query->get_result();

    $poltronas = [];
    while ($row = $result->fetch_assoc()) {
        $poltronas[] = $row;
    }

    // Exibir 4 por linha
    $total = count($poltronas);
    for ($i = 0; $i < $total; $i += 12) {
        echo '<div class="flex gap-2 justify-center">';
        for ($j = 0; $j < 12; $j++) {
            $index = $i + $j;
            if ($index < $total) {
                $numero = str_pad($poltronas[$index]['numero'], 2, '0', STR_PAD_LEFT);
                $status = $poltronas[$index]['status'];
                $classe = ($status === 'ocupado') 
                    ? 'bg-gray-400 cursor-not-allowed'
                    : 'bg-green-500 text-black cursor-pointer hover:bg-gray-600 poltrona';

                echo "<div class='w-10 h-10 rounded bg- flex items-center justify-center text-sm $classe' data-numero='$numero'>$numero</div>";
            }
        }
        echo '</div>';
    }
  ?>
</div>


  </div>

  <div class="flex justify-around items-center text-sm mt-6 ">
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 bg-green-500 rounded"></div><span>Disponível</span>
    </div>
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 bg-white-500 border rounded"></div><span>Selecionado</span>
    </div>
    <div class="flex items-center gap-1">
      <div class="w-6 h-6 bg-gray-400 rounded"></div><span>Ocupado</span>
    </div>
  </div>

  <form  action="pagamento.php" method="POST">
    <input type="hidden" name="viagem_id" value="<?= $viagem_id ?>">
    <input type="hidden" name="poltronas" id="poltronasSelecionadas">
    <input type="hidden" name="valor_total" id="valorTotal">

    <div class="mt-6 flex justify-between items-center p-6">
      <p class="text-lg font-semibold">Valor total: <span id="valor">Kz 0,00</span></p>
      <button type="submit" disabled id="continuar" class="bg-gray-300 text-white px-6 py-2 rounded cursor-not-allowed">

        Fazer reserva
      </button>
    </div>
  </form>
</div>
  </div>
 <?php 
 include("footer.php");
 ?>

   
        
<script>
  const poltronas = document.querySelectorAll('.poltrona');
  const campoPoltronas = document.getElementById('poltronasSelecionadas');
  const campoValorTotal = document.getElementById('valorTotal');
  const valorTexto = document.getElementById('valor');
  const continuarBtn = document.getElementById('continuar');

  const valorUnitario = <?= $valorUnitario ?>;
  let selecionadas = [];

  poltronas.forEach(poltrona => {
    poltrona.addEventListener('click', () => {
      const numero = poltrona.dataset.numero;

       if (selecionadas.includes(numero)) {
      // Desmarcar
      selecionadas = selecionadas.filter(p => p !== numero);
      poltrona.classList.remove('bg-white', 'text-black');
      poltrona.classList.add('bg-green-500', 'text-black');
    } else {
      // Marcar
      selecionadas.push(numero);
      poltrona.classList.remove('bg-green-500', 'text-black');
      poltrona.classList.add('bg-white', 'text-black');
    }

      // Atualizar total e inputs
      const total = selecionadas.length * valorUnitario;
      valorTexto.textContent = `Kz ${total.toLocaleString('pt-AO')}`;
      campoPoltronas.value = selecionadas.join(',');
      campoValorTotal.value = total;

      // Ativar botão
      if (selecionadas.length > 0) {
        continuarBtn.disabled = false;
        continuarBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
        continuarBtn.classList.add('bg-orange-500', 'hover:bg-orange-600', 'cursor-pointer');
      } else {
        continuarBtn.disabled = true;
        continuarBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
        continuarBtn.classList.remove('bg-orange-500', 'hover:bg-orange-600', 'cursor-pointer');
      }
    });
  });

</script>


</body>
</html>