<?php
include("conecao.php");

$mensagem = "";
$reserva = null;

// Marcar como embarcado
if (isset($_POST['embarcar'])) {
    $id = $_POST['id_reserva'];

    // Verificar estado atual
    $sql = "SELECT status FROM reserva WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    if ($dados && $dados['status'] === 'Embarcado') {
        $mensagem = " Este passageiro já foi embarcado.";
    } else {
        $update = $conn->prepare("UPDATE reserva SET status = 'Embarcado' WHERE id = ?");
        $update->bind_param("i", $id);
        if ($update->execute()) {
            $mensagem = " Passageiro marcado como embarcado com sucesso!";
        } else {
            $mensagem = " Erro ao atualizar a reserva.";
        }
    }
}

// Buscar reserva
// Buscar reserva com autocarro
if (isset($_GET['codigo_reserva'])) {
    $codigo = $_GET['codigo_reserva'];
    $sql = "
    SELECT r.*, a.placa AS nome_autocarro 
    FROM reserva r
    JOIN viagens v ON r.viagem_id = v.id
    JOIN autocarros a ON v.autocarro_id = a.id
    WHERE r.codigo_reserva = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $reserva = $resultado->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Controle de Embarque</title>
  
</head>
<body>

<h2>Controle de Embarque</h2>

<?php if (isset($mensagem)) : ?>
    <p class="mensagem"><?= $mensagem ?></p>
<?php endif; ?>

<form method="GET" action="">
    <label>Código da reserva:</label>
    <input type="text" name="codigo_reserva" placeholder="Ex: ABC123" required>
    <button type="submit">Pesquisar</button>
</form>

<?php if ($reserva): ?>
    <div class="reserva" style="margin-top: 20px;">
        <h3>Dados da Reserva</h3>
        <p><strong>Passageiro:</strong> <?= htmlspecialchars($reserva['nome_passageiro']) ?></p>
        <p><strong>Autocarro:</strong> <?= htmlspecialchars($reserva['nome_autocarro']) ?></p>

        <p><strong>Código:</strong> <?= htmlspecialchars($reserva['codigo_reserva']) ?></p>
        <p><strong>Poltrona:</strong> <?= $reserva['poltronas'] ?></p>
        <p><strong>Estado:</strong> <?= $reserva['status'] ?></p>

        <?php if ($reserva['status'] !== 'Embarcado'): ?>
            <form method="POST" action="">
                <input type="hidden" name="id_reserva" value="<?= $reserva['id'] ?>">
                <button type="submit" name="embarcar">Marcar como Embarcado</button>
            </form>
        <?php else: ?>
            <div class="mensagem">Este passageiro já foi embarcado.</div>
        <?php endif; ?>
    </div>
<?php elseif (isset($_GET['codigo_reserva'])): ?>
    <div class="erro"> Reserva não encontrada.</div>
<?php endif; ?>


  <style>
    
h2{
    text-align:center;
}
body { 
font-family: Arial, sans-serif; 
background: #f5f5f5; 
padding: 20px; 

}
form, .reserva { 
background: #fff; 
padding: 20px; 
border-radius: 10px; 
box-shadow: 0 0 10px #ccc; 
max-width: 500px; 
margin: auto; }

input[type="text"] { 
width: 90%; 
padding: 10px; 
margin-bottom: 10px; 
}
        
button { padding: 10px 20px; 
background: #007bff; 
color: white; 
border: none; 
border-radius: 5px; 
cursor: pointer; 
}

button:hover { 
background: #0056b3; 
}

.mensagem { 
text-align:center;
}

.erro { 
    text-align:center;
padding: 10px; 


}
    </style>

</body>
</html>


