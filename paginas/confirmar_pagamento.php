<?php
include("../conecao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Captura dos dados do formulário
    $viagem_id = intval($_POST['viagem_id']);
    $poltronas = explode(',', $_POST['poltronas']); // Ex: "1,2,3"
    $valor_esperado = intval($_POST['valor_total']); // Total a ser pago
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $arquivo = $_FILES['comprovativo'];

    // 2. Verifica se um arquivo foi enviado
    if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('⚠️ Erro no upload do comprovativo.'); window.history.back();</script>";
        exit;
    }

    // 3. Validação do tipo de arquivo (somente imagens e PDF)
    $permitidos = ['application/pdf', 'image/jpeg', 'image/png'];
    if (!in_array($arquivo['type'], $permitidos)) {
        echo "<script>alert('❌ Formato de comprovativo inválido. Envie um PDF ou imagem.'); window.history.back();</script>";
        exit;
    }

    // 4. Envio para a API da FasmaPay
    $chave_fasmapay = "5937"; // Sua chave da FasmaPay
    $caminho_temporario = $arquivo['tmp_name'];

    $postData = [
        'sudopay_key' => $chave_fasmapay,
        'comprovativo' => new CURLFile($caminho_temporario, $arquivo['type'], $arquivo['name'])
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fasma.ao/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
    ]);

    $resposta = curl_exec($curl);
    curl_close($curl);

    // 5. Analisar resposta
    $resposta_api = json_decode($resposta, true);

    if (
        isset($resposta_api['STATUS']) &&
        $resposta_api['STATUS'] == 200 &&
        intval($resposta_api['MONTANTE']) === $valor_esperado
    ) {
        // 6. Marcar poltronas como ocupadas
        foreach ($poltronas as $numero) {
            $numero = intval($numero);
            $stmt = $conn->prepare("UPDATE poltronas_viagem SET status = 'ocupado' WHERE viagem_id = ? AND numero = ?");
            $stmt->bind_param("ii", $viagem_id, $numero);
            $stmt->execute();
        }

        // 7. (Opcional) Enviar e-mail de confirmação
        $assunto = "TCUL - Confirmação da Reserva";
        $mensagem = "Sua reserva foi confirmada com sucesso!\n\nViagem nº $viagem_id\nPoltronas: " . implode(', ', $poltronas) . "\nValor: Kz $valor_esperado";
        @mail($email, $assunto, $mensagem);

        // 8. Redirecionamento ou mensagem
        echo "<script>alert('✅ Pagamento confirmado e poltronas reservadas!'); window.location='bilhete.php';</script>";
    } else {
        echo "<script>alert('❌ Pagamento inválido ou valor incorreto.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Requisição inválida.'); window.history.back();</script>";
}
?>
