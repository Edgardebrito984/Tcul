<?php
include '../conecao.php';
session_start();
$email ="";
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
  <?php 
  include("nav.php");
  ?>
<div class="conteudo-principal">
  <!-- Barra de busca -->
  <div class="barra-de-busca">
    <input type="text" placeholder="Origem" class="campo-texto" value="<?php echo htmlspecialchars($rota['origem']); ?>">
    <span class="seta">→</span>
    <input type="text" placeholder="Destino" class="campo-texto" value="<?php echo htmlspecialchars($rota['destino']); ?>">
    
  </div>

  <h1> Viagens disponíveis para esta rota:</h1>
  <!-- Seletor de datas 
  <div class="seletor-de-datas">
    <button class="botao-data ativo">07/mai qua</button>
    <button class="botao-data">08/mai qui</button>
    <button class="botao-data">09/mai sex</button>
    <button class="botao-data">10/mai sáb</button>
    <button class="botao-data">11/mai dom</button>
  </div>-->

  <?php
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
    <div class="cartao-viagem">
      <!-- Esquerda -->
      <div class="coluna-esquerda">
        <img src="../imagens/tcul2.png" alt="TCUL">
      </div>

      <!-- Centro -->
      <div class="coluna-centro">
        <p class="data"><?php echo $data_viagem; ?></p>
        <p class="horas"><?php echo $hora_partida; ?> → <?php echo $hora_chegada; ?></p>
        <p class="rota"><?php echo $rota['origem']; ?> → <?php echo $rota['destino']; ?></p>
      </div>

      <!-- Direita -->
      <div class="coluna-direita">
        <p class="preco">Kz <?php echo number_format($rota['preco'], 2, ',', '.'); ?></p>
        <a href="consulta2.php?viagem_id=<?php echo $viagem['id']; ?>">
          <button class="botao-laranja">Selecionar poltrona</button>
        </a>
      </div>
    </div>
  <?php } ?>
</div>
<?php include("footer.php")?>


<style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  
}
  body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;

    
  }

  .conteudo-principal {
    max-width: 700px;
    margin: 20px  auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  }

  .barra-de-busca {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
  }

  .campo-texto {
    padding: 10px 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    flex: 1 1 200px;
  }

  .seta {
    font-size: 20px;
  }

  .botao-laranja {
    background-color: #f97316;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }

  .botao-laranja:hover {
    background-color: #ea580c;
  }

  .seletor-de-datas {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .botao-data {
    padding: 10px 16px;
    border-radius: 20px;
    background-color: #ddd;
    border: none;
    cursor: pointer;
    white-space: nowrap;
  }

  .botao-data.ativo {
    background-color: #2563eb;
    color: white;
  }

  .cartao-viagem {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
  }

  .coluna-esquerda,
  .coluna-centro,
  .coluna-direita {
    flex: 1;
  }

  .coluna-centro {
    text-align: center;
  }

  .coluna-direita {
    text-align: right;
  }

  .data, .rota {
    font-size: 14px;
    color: #666;
  }

  .horas {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin: 4px 0;
  }

  .preco {
    font-size: 18px;
    font-weight: bold;
    color: #16a34a;
    margin-bottom: 10px;
  }

  @media (max-width: 768px) {
    .cartao-viagem {
      flex-direction: column;
      text-align: center;
      gap: 15px;
    }

    .coluna-direita {
      text-align: center;
    }

    .barra-de-busca {
      flex-direction: column;
    }
  }
</style>

</body>
</html>