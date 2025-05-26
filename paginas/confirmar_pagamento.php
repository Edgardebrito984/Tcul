<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $arquivo = $_FILES['comprovativo'];
    $chave_fasmapay = "32y3103T2tp26YLvltbtaIdq1QB3ubHstuB1RsGgK4Ac6tgLPILDc2b4RXeG240509";

    if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
        exit(" Erro no upload do arquivo.");
    }

    $permitidos = ['application/pdf', 'image/jpeg', 'image/png'];
    if (!in_array($arquivo['type'], $permitidos)) {
        exit(" Formato de arquivo inválido.");
    }

    if ($arquivo['size'] > 5 * 1024 * 1024) {
        exit("Arquivo muito grande.");
    }

    $postData = [
        'sudopay_key' => $chave_fasmapay,
        'sudopay_file' => new CURLFile($arquivo['tmp_name'], $arquivo['type'], $arquivo['name']),
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fasma.ao/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
    ]);

    $resposta = curl_exec($curl);

    if (curl_errno($curl)) {
        echo " Erro cURL: " . curl_error($curl);
        curl_close($curl);
        exit;
    }

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    echo "HTTP Status Code: $http_code <br>";
    echo "Resposta da API:<br><pre>" . htmlspecialchars($resposta) . "</pre>";

} else {
    echo "❌ Requisição inválida.";
}


