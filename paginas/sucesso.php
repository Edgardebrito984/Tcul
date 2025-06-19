<?php
include "../conecao.php";  



if (isset($_SESSION['mensagem'])) {
    echo '
    <style>
        .mensagem-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            text-align: center;
            z-index: 9999;
            max-width: 90%;
            width: 300px;
            animation: fadeIn 0.3s ease-in-out;
        }

    

        .mensagem-container h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .mensagem-container p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        .mensagem-container button {
            background-color: #007BFF;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        .mensagem-container button:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
    </style>

    <div class="mensagem-container" id="mensagemPopup">
        <div class="icone">✔️</div>
        <h2>Sucesso</h2>
        <p>' . $_SESSION['mensagem'] . '</p>
        <button onclick="fecharMensagem()">Ok</button>
    </div>

   <script>
    function fecharMensagem() {
        const mensagem = document.getElementById("mensagemPopup");
        mensagem.style.opacity = "0";
        mensagem.style.transform = "translate(-50%, -60%)";
        setTimeout(() => mensagem.remove(), 500);
    }

    // Fecha a mensagem quando clicar em qualquer lugar fora dela
    document.addEventListener("click", function (e) {
        const mensagem = document.getElementById("mensagemPopup");

        if (mensagem && !mensagem.contains(e.target)) {
            fecharMensagem();
        }
    });

    // Se quiser também permitir fechar clicando no botão "Ok"
    // (mantém funcionalidade original)
</script>
    ';

    unset($_SESSION['mensagem']); // limpa a mensagem após exibir
}
?>

