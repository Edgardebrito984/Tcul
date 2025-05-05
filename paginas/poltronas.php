<?php 
include("../conecao.php");

// Carregar poltronas do banco de dados
$sql = "SELECT * FROM poltronas ORDER BY numero";
$result = $conn->query($sql);
$poltronas = [];

while ($row = $result->fetch_assoc()) {
    $poltronas[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Poltronas</title>
   
    <script>
        function selecionarPoltrona(el) {
            if (el.classList.contains('ocupada')) return; 
            el.classList.toggle('selecionada');

            let selecionadas = document.querySelectorAll('.selecionada');
            let ids = Array.from(selecionadas).map(e => e.dataset.id);
            document.getElementById('poltronasSelecionadas').value = ids.join(',');
        }

        function filtrarPoltronas(tipo) {
            let todas = document.querySelectorAll('.poltrona');
            todas.forEach(p => {
                if (tipo === 'todas') {
                    p.classList.remove('hidden');
                } else {
                    p.classList.toggle('hidden', !p.classList.contains(tipo));
                }
            });
        }
    </script>
</head>
<body>

    <h2>Escolha sua poltrona</h2>

    <!-- Botões para filtrar -->
    <button onclick="filtrarPoltronas('livre')">Mostrar Livres</button>
    <button onclick="filtrarPoltronas('ocupada')">Mostrar Ocupadas</button>
    <button onclick="filtrarPoltronas('selecionada')">Mostrar Selecionadas</button>
    <button onclick="filtrarPoltronas('todas')">Mostrar Todas</button>

    <!-- Poltronas -->
    <div class="poltronas">
        <?php foreach ($poltronas as $p): ?>
            <div class="poltrona <?= $p['status'] ?>" 
                 data-id="<?= $p['id'] ?>" 
                 onclick="selecionarPoltrona(this)">
                <?= str_pad($p['numero'], 2, '0', STR_PAD_LEFT) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Formulário para enviar a reserva -->
    <form action="reservar.php" method="POST">
        <input type="hidden" name="poltronas" id="poltronasSelecionadas">
        <button type="submit">Reservar</button>
    </form>

</body>
<style>
        body { font-family: Arial, 
            sans-serif; 
            text-align: center; 
        
        }

        .poltronas {
            display: grid;
            grid-template-columns: repeat(4, 60px);
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .poltrona {
            width: 60px; 
            height: 60px; 
            text-align: center;
            line-height: 60px; 
            border-radius: 5px; 
            font-weight: bold;
            cursor: pointer; 
            border: 2px solid #000;
        }

        .livre { 
            background-color: green; 
            color: white; 
        }

        .ocupada { 
            background-color: red; 
            color: white; 
            cursor: not-allowed;
         }

        .selecionada {
             background-color: blue; 
            color: white; 
        }

        .hidden { 
            display: none; 
        }

        button { 
            margin-top: 10px; 
            padding: 10px; 
            font-size: 16px; 
            cursor: pointer;
         }
         
    </style>
</html>
