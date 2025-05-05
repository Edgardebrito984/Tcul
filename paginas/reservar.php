<?php 

include("../conecao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['poltronasSelecionadas']) && !empty($_POST['poltronasSelecionadas'])) {
    
    $poltronas = explode(',', $_POST['poltronasSelecionadas']);

    foreach ($poltronas as $numero) {
        $numero = intval($numero); // Sanitiza

        // Aqui estamos assumindo que a coluna "numero" é única por autocarro.
        $sql = "UPDATE poltronas SET status = 'ocupado' WHERE numero = $numero";

        if (!$conn->query($sql)) {
            die("Erro ao atualizar poltrona número $numero: " . $conn->error);
        }
    }

    echo "<script>alert('Reserva feita com sucesso!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Nenhuma poltrona selecionada!'); window.location='detalhes_viagem.php';</script>";
}

$conn->close();
?>


