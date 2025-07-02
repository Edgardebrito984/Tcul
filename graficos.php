<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tcul";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT r.origem, r.destino, COUNT(res.id) AS total_reservas
        FROM reserva res
        JOIN rotas r ON res.rota_id = r.id
        GROUP BY res.rota_id
        ORDER BY total_reservas DESC
        LIMIT 10";
$result = $conn->query($sql);

$rotas = [];
$totais = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rotas[] = $row['origem'] . " - " . $row['destino'];
        $totais[] = $row['total_reservas'];
    }
} else {
    $rotas[] = "Sem dados";
    $totais[] = 0;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Rotas Mais Reservadas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="seu-estilo.css"> <!-- Seu CSS personalizado -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f7f7f7;
        }
        h1 {
            text-align: center;
        }
        .grafico-container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h1>Top 10 Rotas Mais Reservadas</h1>
    <div class="grafico-container">
        <canvas id="graficoRotas"></canvas>
    </div>

    <script>
        const labels = <?php echo json_encode($rotas); ?>;
        const data = <?php echo json_encode($totais); ?>;

        const ctx = document.getElementById('graficoRotas').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservas feitas',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Rotas Mais Reservadas'
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantidade de Reservas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rotas'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>



