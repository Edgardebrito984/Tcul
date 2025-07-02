<?php
include '../conecao.php';
session_start();

$rota = null;
$viagens = [];

// ------------------------------
// Caso 1: Pesquisa por origem, destino e data
if (isset($_GET['origem'], $_GET['destino'], $_GET['data'])) {
    $origem = mysqli_real_escape_string($conn, $_GET['origem']);
    $destino = mysqli_real_escape_string($conn, $_GET['destino']);
    $data = $_GET['data'];

    // Buscar a rota
    $stmt_rota = $conn->prepare("SELECT * FROM rotas WHERE origem = ? AND destino = ?");
    $stmt_rota->bind_param("ss", $origem, $destino);
    $stmt_rota->execute();
    $result_rota = $stmt_rota->get_result();

    if ($result_rota->num_rows > 0) {
        $rota = $result_rota->fetch_assoc();
        $rota_id = $rota['id'];

        // Buscar viagens por data
        $stmt_viagens = $conn->prepare("SELECT * FROM viagens WHERE rota_id = ? AND data_partida = ?");
        $stmt_viagens->bind_param("is", $rota_id, $data);
        $stmt_viagens->execute();
        $viagens = $stmt_viagens->get_result();
    }

} 
// ------------------------------
// Caso 2: Acesso direto com rota_id
elseif (isset($_GET['rota_id'])) {
    $rota_id = intval($_GET['rota_id']);

    // Buscar rota
    $stmt = $conn->prepare("SELECT * FROM rotas WHERE id = ?");
    $stmt->bind_param("i", $rota_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rota = $result->fetch_assoc();

    // Buscar viagens dessa rota
    $stmt_viagens = $conn->prepare("SELECT * FROM viagens WHERE rota_id = ? ORDER BY data_partida ASC");
    $stmt_viagens->bind_param("i", $rota_id);
    $stmt_viagens->execute();
    $viagens = $stmt_viagens->get_result();
} 
else {
    die("Parâmetros inválidos.");
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Viagens</title>
    <link rel="stylesheet" href="seu-estilo.css"> <!-- Teu CSS -->
</head>
<body>
<?php include("nav.php"); ?>

<div class="conteudo-principal">

    <?php if ($rota): ?>
        <!-- Barra de busca -->
        <div class="barra-de-busca">
            <input type="text" class="campo-texto" value="<?= htmlspecialchars($rota['origem']); ?>" readonly>
            <span class="seta">→</span>
            <input type="text" class="campo-texto" value="<?= htmlspecialchars($rota['destino']); ?>" readonly>
            <?php if (isset($data)): ?>
                <input type="text" class="campo-texto" value="<?= date("d/m/Y", strtotime($data)); ?>" readonly>
            <?php endif; ?>
        </div>

        <h1>Viagens disponíveis para esta rota:</h1>

        <?php if ($viagens && $viagens->num_rows > 0): ?>
            <?php while ($viagem = $viagens->fetch_assoc()): ?>
                <div class="cartao-viagem">
                    <div class="coluna-esquerda">
                        <img src="../imagens/tcul2.png"  clas="empresa">
                    </div>
                    <div class="coluna-centro">
                        <p class="data"><?= date("d/m/Y", strtotime($viagem['data_partida'])); ?></p>
                        <p class="horas"><?= date("H:i", strtotime($viagem['hora_partida'])); ?> → <?= date("H:i", strtotime($viagem['hora_chegada'])); ?></p>
                        <p class="rota"><?= htmlspecialchars($rota['origem']); ?> → <?= htmlspecialchars($rota['destino']); ?></p>
                    </div>
                    <div class="coluna-direita">
                        <p class="preco">Kz <?= number_format($rota['preco'], 2, ',', '.'); ?></p>
                        <a href="poltronas.php?viagem_id=<?= $viagem['id']; ?>">
                            <button class="botao-laranja">Selecionar poltrona</button>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color:red; text-align:center;">Nenhuma viagem disponível para esta rota<?php if (isset($data)) echo " na data selecionada"; ?>.</p>
        <?php endif; ?>

    <?php else: ?>
        <p style="color:red; text-align:center;">Rota não encontrada.</p>
    <?php endif; ?>

</div>

<?php include("footer.php"); ?>

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
  h1{
    font-size: 20px;
    padding: 20px;
    font-weight: none;
    text-align: center;
  }
.coluna-esquerda img {
  width: 200px;
  height: auto;
  object-fit: contain;
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