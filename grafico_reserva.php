<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tcul";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT DAYNAME(data_reserva) AS dia_semana, COUNT(*) AS total_reservas
        FROM reserva
        WHERE YEARWEEK(data_reserva, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY dia_semana
        ORDER BY FIELD(dia_semana, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$result = $conn->query($sql);

$dias = [];
$totais = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dias[] = $row['dia_semana'];
        $totais[] = $row['total_reservas'];
    }
} else {
    $dias[] = "Sem dados";
    $totais[] = 0;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Reservas na Semana</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <h1>Reservas Feitas na Semana Atual</h1>
    <div class="grafico-container">
        <canvas id="graficoReservas"></canvas>
    </div>

    <script>
        const labels = <?php echo json_encode($dias); ?>;
        const data = <?php echo json_encode($totais); ?>;

        const ctx = document.getElementById('graficoReservas').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservas feitas',
                    data: data,
                    fill: true,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Quantidade de Reservas por Dia na Semana Atual'
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
                            text: 'Número de Reservas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Dias da Semana'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
