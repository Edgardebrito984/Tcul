<?php
include '../conecao.php';
//setlocale(LC_TIME, 'pt_PT.UTF-8', 'pt_BR.UTF-8', 'Portuguese_Portugal.1252');

// Verifica se foi passado rota_id
if (!isset($_GET['rota_id'])) {
    die("Rota não especificada.");
    
    
}

$rota_id = $_GET['rota_id'];

// Buscar dados da rota
$stmt = $conn->prepare("SELECT * FROM rotas WHERE id = ?");
$stmt->bind_param("i", $rota_id);
$stmt->execute();
$result = $stmt->get_result();
$rota = $result->fetch_assoc();

$autocarro_id = $rota['autocarro_id'];

// Buscar as poltronas do autocarro
$sql_poltronas = "SELECT numero, status FROM poltronas WHERE autocarro_id = ?";
$stmt_poltrona = $conn->prepare($sql_poltronas);
$stmt_poltrona->bind_param("i", $autocarro_id);
$stmt_poltrona->execute();
$result_poltrona = $stmt_poltrona->get_result();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viagem</title>
 
 

</head>
<body>

<div class="head">
      <img src="../imagens/tcul2.png" alt="">
 </div>
 

    <div class="container1">
     <div class="container">
        <div class="detalhes-cabecalho">
              <h1>Detalhes da viagem</h1>
        </div>        
          
            
    <div class="info">
        <div class="origem">
        <h1>ORIGEM</h1>
        <p><?php echo htmlspecialchars($rota['origem']); ?></p>
        </div>
        
     <div class="destino">
        <h1>DESTINO</h1> 
        <p> <?php echo htmlspecialchars($rota['destino']); ?></p>
             </div>
       </div>

       <script>
        function selecionarPoltrona(el) {
            if (el.classList.contains('ocupado')) return; 
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



       <h1>poltronas</h1>
       
       <div class="poltronas">
    
    <?php while($poltrona = $result_poltrona->fetch_assoc()) {
        $status_class = ($poltrona['status'] == 'livre') ? 'livre' : 'ocupado';
    ?>
        <div class="poltrona <?php echo $status_class; ?>" 
            data-id="<?php echo $poltrona['numero']; ?>" 
            onclick="selecionarPoltrona(this)">
            <?php echo str_pad($poltrona['numero'], 2, '0', STR_PAD_LEFT); ?>
        </div>
    <?php } ?>
</div>

<button onclick="abrirModal()">Continuar</button>


  /<!--   <form action="reservar.php" method="POST">
        <input type="hidden" name="poltronasSelecionadas" id="poltronasSelecionadas">
     <button>Continuar</button>
     </form>-->
    </div>   
    
    
    <script>
function abrirModal() {
    let selecionadas = document.querySelectorAll('.poltrona.selecionada');
    if (selecionadas.length === 0) {
        alert('Selecione pelo menos uma poltrona!');
        return;
    }

    let ids = Array.from(selecionadas).map(e => e.dataset.id);
    let numeros = Array.from(selecionadas).map(e => e.textContent.trim());

    // Atualiza o input oculto
    document.getElementById('poltronasSelecionadas').value = ids.join(',');

    // Mostra poltronas selecionadas
    document.getElementById('poltronasResumo').textContent = numeros.join(', ');

    // Calcula preço total
    let preco = <?php echo floatval($rota['preco']); ?>;
    let total = preco * selecionadas.length;
    document.getElementById('precoTotal').textContent = total.toLocaleString('pt-AO', { minimumFractionDigits: 2 });

    // Exibe o modal
    document.getElementById('modalReserva').style.display = 'block';

    window.onclick = function(event) {
    var modal = document.getElementById('modalReserva');
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

}
</script>
<script>
function fecharModal() {
    document.getElementById('modalReserva').style.display = 'none';
}
</script>

<!-- Modal de confirmação -->
<div id="modalReserva" class="modal">
  <div class="modal-conteudo">
    <h3>Confirmar Reserva</h3>

    <p><strong>Origem:</strong> <?php echo $rota['origem']; ?></p>
    <p><strong>Destino:</strong> <?php echo $rota['destino']; ?></p>
    <p><strong>Data de partida::</strong> <?php echo $rota['data_partida']; ?></p>
    <p><strong>Preço por poltrona:</strong> <?php echo number_format($rota['preco'], 2, ',', '.'); ?> kz</p>

    <p><strong>Poltronas selecionadas:</strong> <span id="poltronasResumo"></span></p>
    <p><strong>Preço total:</strong> <span id="precoTotal"></span> kz</p>

    <form action="reservar.php" method="POST">
      <input type="hidden" id="poltronasSelecionadas" name="poltronasSelecionadas">
      <button type="submit">OK</button>
      <button type="button" onclick="fecharModal()">Cancelar</button>
    </form>
  </div>
</div>

   <style>
  .modal {
  display: none;
  position: fixed;
  z-index: 10;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
}

.modal-conteudo {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  text-align: center;
}

    body{
        margin: 0;
    }

.head{
 background-color: #F49609;
 /*padding-top: 20px;*/
 padding-bottom: 0px;  
 padding-left: 40px;
 padding-right: 20px;
 height: 100px;
 text-align: center;
}
.head img{
    height: 90px;
    border: none;
    max-width: 100%;
    overflow: clip;
    width: 300px;
    vertical-align: middle;
    display: inline-block;  
}
 .container{
    background-color:rgba(255, 235, 59, 0.97);
    box-shadow: 0 0 10px rgba(0,0,0,0.1); 
    border-radius: 8px; 
    max-width: 100%;
    justify-content: space-between;
    align-items: center;

   
     
    } 

.container1{
    
    padding-right: 50px;
    padding-left: 50px;
    padding-top: 80px;
    text-align: center;
    }
.detalhes-cabecalho{
        
        background-color: #DE3122;
        padding-top: 10px;
        margin-bottom: 20px;
        
    }
.origem{
    background-color: #DE3122;
    
    color: white;

    width: 15%;
    margin: 40px;
}
.origem h1{
    font-size: 10px;
}
.destino h1{
    font-size: 10px;
}
.destino{
    background-color: #DE3122;
    color: white;
    margin: 40px;
    width: 15%;
}
 
.detalhes{
    background-color: blue;
}

.info{
    
    justify-content: center;
    display: flex;
    align-items: center;
    
    }
.info p {
            margin: 10px 0;
            
        }
.info ul{
            display:flex;
        }
.datas {

        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 30px;
        cursor:pointer;
}
.datas-container{
        margin-top: 30px;
}
.data-item {
        border: 1px solid;
        background: #EBEBEB;
        color: black;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        text-align: center;
        min-width: 100px;
    }
.data-item:hover{
    background-color: #DE3122;
    color: white;
    border: none;
    }
.data-item strong {
        display: block;
        font-size: 16px;
        
    }

.data-item span {
        font-size: 12px;
        color: black;
        }
.btn {
     display: inline-block;
     padding: 10px 20px;
    background: green;
    color: #fff;
     text-decoration: none;
  border-radius: 5px;
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
        
        .poltronas {
            display: grid;
            grid-template-columns: repeat(16, 60px);
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
  background-color: white;
  color: black;
}


   </style>
</body>
</html>