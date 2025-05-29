<?php
include "../conecao.php";  
session_start();

if (isset($_SESSION['mensagem'])) {
    echo '
    <div style="text-align: center;">
        <p id="mensagemTemporaria" style="
            color: green;
            background-color: white;
            border: 1px solid #9a9a9a;
            border-radius: 4px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            padding: 10px;
            display: inline-block;
            max-width: 100%;
        ">
            ' . $_SESSION['mensagem'] . '
        </p>
    </div>

    <script>
        setTimeout(function() {
            var mensagem = document.getElementById("mensagemTemporaria");
            mensagem.style.opacity = "0";
            mensagem.style.transform = "translateY(-20px)";
            setTimeout(function() {
                mensagem.parentElement.remove();
            }, 800);
        }, 1500);
    </script>
    ';

    unset($_SESSION['mensagem']); // limpa a mensagem após exibir
}
?>
