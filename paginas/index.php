<?php
session_start();
$email ="";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">   
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
 <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
   <title>Tcul</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<body>
<?php
                    if (isset($_SESSION['mensagem'])) {
                    include "sucesso.php";  
                    }
    ?>
     
          <?php 
                      
include("nav.php");                
      ?>
        
        <div class="container">     
                

         </div> 
         <div class="container2">
         <h1 class="animate__animated  animate__bounce ">Pensando em viajar?</h1>
            <p class="animate__animated animate__fadeIn">Escolha o seu destino,origem e compre online a sua passagem de autocarro interprovincial!</p>
            </div> 
          <div class="marcar_viagens">
    <div class="viagens">
        <?php 
        include("../conecao.php");

        // Buscar origens e destinos distintos da tabela "rotas"
        $sql = "SELECT DISTINCT origem, destino FROM rotas";
        $result = mysqli_query($conn, $sql);

        $origens = [];
        $destinos = [];

        while($row = mysqli_fetch_assoc($result)) {
            $origens[] = $row['origem'];
            $destinos[] = $row['destino'];
        }

        // Remover duplicados (por segurança)
        $origens = array_unique($origens);
        $destinos = array_unique($destinos);
        ?>

        <form action="consulta.php" method="GET">
            <input type="radio" name="tipo" value="Somente Ida" required class="tipo_de_viagens">
            <span>Somente ida</span>

            <div class="select-container">
                <select name="origem" required>
                    <option value="">Origem</option>
                    <?php foreach($origens as $origem): ?>
                        <option value="<?= htmlspecialchars($origem) ?>"><?= htmlspecialchars($origem) ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="destino" required>
                    <option value="">Destino</option>
                    <?php foreach($destinos as $destino): ?>
                        <option value="<?= htmlspecialchars($destino) ?>"><?= htmlspecialchars($destino) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-date">
                <input type="date" name="data" required>
                <button type="submit">Procurar</button>
            </div>
        </form>
    </div>
</div>

          
            </form>
           </div>
           </div>
                 <div class="card-container swiper">
               <h1> <i class="fa-solid fa-bus-simple"></i>  DESTINOS PARA VOCÊ</h1>
                   <div class="card-content wrapper">
                     <div class="card-list swiper-wrapper"data-aos="fade-up"
     data-aos-duration="3000">
                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button id="abrir_modal">Comprar</button>
                        </div>


                        <div class="card-item swiper-slide">
                            <img src="../imagens/luanda.jpeg" alt="">
                            <h2>Luanda</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button  id="abrir_modal">Comprar</button>    
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/luanda.jpeg" alt="">
                            <h2>Namibe</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button>Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/zaire.jpeg" alt="">
                            <h2>zaire</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button class="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button  class="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button class="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button  class="abrir_modal" href="login">Comprar</button>
                        </div>
                    </div>

                    <div class="swiper-pagination"></div>
                    <div class=" swiper-slide-button swiper-button-prev"></div>
                    <div class=" swiper-slide-button swiper-button-next"></div>
                 </div>
            </div>
  
                  

            <div class="card-container swiper" >
               <h1><i class="fa-solid fa-bus-simple"></i>   OUTROS DESTINOS PARA VOCÊ</h1>
                   <div class="card-content wrapper">
                     <div class="card-list swiper-wrapper" data-aos="fade-up"
     data-aos-duration="3000">
                        <?php
                        include('../conecao.php');

  
                        $sql ="SELECT id,origem, destino, preco FROM rotas";
                        $result= $conn->query($sql);

                        if($result->num_rows > 0){
                            while ($row = $result->fetch_assoc()) {
                        ?>
              
                    
                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2><?php echo $row['origem'];?></h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1><?php echo $row['destino']?></h1>
                     
                            <p class="preco">A partir de: <?php echo number_format ($row['preco'],2,',','.');?>kz</p>

                            <?php if (isset($_SESSION['email'])){?>
                               <!-- Se o usuário estiver logado, redireciona para detalhes da viagem -->
                            <button  onclick="window.location.href='consulta.php?rota_id=<?php echo $row['id'];?>'">
                                Comprar</button>
                             <?php  } else { ?>
                                <!-- Se não estiver logado abre o modal de login-->
                                <button type="button" class="abrir_modal">Comprar</button>

                            <?php }?>
                        
                  
                        </div>
                        
                        <?php
                         }
                        } else {
                            echo"<p>NÃO HÁ ROTAS DISPONÍVEIS DE MOMENTO</p>";
                             }  
                               $conn->close();
                         ?>
                      </div>
                    <div class="swiper-pagination"></div>
                    <div class=" swiper-slide-button swiper-button-prev"></div>
                    <div class=" swiper-slide-button swiper-button-next"></div>
                 </div>
                    <?php
                    include('login_modal.php');
                    ?>
                       </div>
<div class="faq-container2" >

  <div class="faq-container" >
  <h1>Perguntas Frequentes</h1>

  <div class="faq-item active">
    <div class="faq-question" onclick="toggleFAQ(this)">
      Trocas e Cancelamentos <span class="faq-icon">−</span>
    </div>
    <div class="faq-answer">
    <p> Caso não viaje por algum motivo, deve regularizar a situação da sua passagem no mesmo dia.
      Não efetuamos trocas de passagem com data vencida, exceto aos casos justificados documentalmente.</p>  
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleFAQ(this)">
      Transporte de animais de estimação <span class="faq-icon">+</span>
    </div>
    <div class="faq-answer">
      <p> O porte do seu cão ou gato deve ser pequeno ou médio com peso de até 10 kg; 
      estar acomodado em caixa de transporte apropriada ou mesmo uma bolsa de transporte própria para viagens,
       onde deve abrigar somente 1 animal. 
       <p> Ele precisa estar totalmente dentro da caixa/bolsa e não poderá ser retirado dela durante a viagem;
        recomendamos que o seu animal esteja devidamente vacinado e sedado. </p>
      <p>  Não pode faltar coleira, potes de água e comida (ração suficiente para consumir durante a viagem).
         Nas paragens do autocarro poderá retirar o seu animal da caixa para que ele se exercite e possa ir ao quarto de banho.</p>
     
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleFAQ(this)">
      Regras para crianças <span class="faq-icon">+</span>
    </div>
    <div class="faq-answer">
      <p>A criança deverá estar acompanhada dos seus pais ou responsável legal, 
        com a comprovação pela certidão do nascimento ou BI ou passaporte ou autorização. Oferecemos gratuidade de passagem
         para criança de 0 até 5 anos,  desde que não ocupe o assento, viajando no colo dos pais ou responsável legal;
          a partir dos 6 anos paga-se a tarifa normal.</p>

    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleFAQ(this)">
      Bagagem <span class="faq-icon">+</span>
    </div>
    <div class="faq-answer">
     <p> Os nossos clientes tem o direito de transportar 1 (uma) mala média no porão do
       autocarro. Se exceder a quantidade ou peso ou dimensão pagará por excesso de bagagem
        ou de volume adicional. Pesquise as tarifas nos nossos pontos de vendas.</p>

    <p>É proibido o transporte de TV e outros meios como: botija de gás (vazia ou cheia), 
       gerador, geleira, arca, peças de automóveis/motorizadas, plantas, vasos de cerâmica, 
      produtos inflamáveis. Se transportar frescos (peixe, carne, marisco, bebida, etc.) deve 
      colocar em meios apropriados: 
      caixa térmica ou baú para não danificar as outras bagagens.</p>

      <p>Ao pagar o excesso de bagagem, exija o recibo e certifique que o valor pago consta no recibo/fatura, caso contrário, “denuncie”.</p>
    </div>
  </div>

</div>
    
</div>
<script>
  function toggleFAQ(element) {
    const item = element.parentElement;
    const allItems = document.querySelectorAll('.faq-item');

    allItems.forEach(faq => {
      if (faq !== item) {
        faq.classList.remove('active');
        faq.querySelector('.faq-icon').textContent = '+';
      }
    });

    item.classList.toggle('active');
    const icon = element.querySelector('.faq-icon');
    icon.textContent = item.classList.contains('active') ? '−' : '+';
  }
</script>

                       <div class="banner">
                        </div>
   <?php 
         include("footer.php");
      ?>
       <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

       <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../js/index.js"></script>
        <style>


@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
 *{
    padding: 0;
    margin: 0;
    
    font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
    
}

 .container{
    background: url("../imagens/2banner.jpg") no-repeat center;
    background-size: cover;
    width: 100%;
    height: 442px;
 }
 


 
 .conteudo{
    background-color: black;
 }
  
 .container2{
    text-align:center;
    padding-top: 40px;
 }

 .marcar_viagens {
   display:flex;
    justify-content:center;
    align-items:center;
    padding-top:20px;
    width: 100%; 
 }
 .viagens {
    justify-content:center;
    align-items:center;
    padding-top:40px;
    padding-right:20px;
    padding-left:20px;
    margin-top: 0em;
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.5);
    border-radius: 20px 20px 20px 20px;
    max-width:720px;
    width: 100%;  
 }
 .viagens span{
    
    align-items: center;
    color:black;
    
 }
 .viagens .select-container select{
    font-weight: 800;
    color: black;
    background-color: #EFF6F6;
    margin: 08px 0px 0px 0px;
    border-style: none;
    border-radius: 8px 8px 8px 8px;
    max-width: 712px;
    height:45px;
    width:100%;
    cursor:pointer;
 }
 .viagens .input-date input{
    font-weight: 800;
    color: black;
    background-color: #EFF6F6;
    margin: 08px 0px 0px 0px;
    border-style: none;
    border-radius: 8px 8px 8px 8px;
    max-width: 712px;
    height:45px;
    cursor:pointer;
    width:100%;  
 }
 .viagens .input-date button{
    background-color: #F49609;
    margin-top:20px;
    text-align:center;
    width:90px;
    height:40px;
    font-weight:800;
    cursor:pointer;
    border-radius:5px;
    border-style:none;
 }
 .viagens .input-date button:hover{
    color: white;
    transition:0.2s ease;
 }
 .card-content {
    overflow: hidden;
   max-width: 2500px;
   padding-top:40px;
   margin: 0 70px 55px;
 }
 .card-container h1{
    font-weight: 200;
   text-align:center;
   padding-top:20px;
 }
 .card-list .card-item{
    background-color: #DE3122;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction: column;
    user-select:none;
    padding: 5px;
    border-radius:8px;
    
 }
 .card-list .card-item img{
    width: 200px;
    height:200px;
    border-radius:50%;
    border: 3px solid #fff;
    padding:4px;
    
 }
 
 .card-list .card-item p{
    font-size:1.25rem;
    color:#e3e3e3;
    font-weight:500;
    margin: 14px 0 10px;
    color:rgb(251, 255, 44);
 }
 .card-list .card-item h2 {
    color:white;
 }
 .card-list .card-item h1 {
    color:white;
 }
 .card-list .card-item button{
    font-size:1.25rem;
    padding: 10px 35px;
    color:#030728;
    border-radius:6px;
    font-weight:500;
    border-style:none;
    background-color: #F49609;
    cursor: pointer;
    transition: 0.2 ease;
 }
 .card-list .card-item button:hover{
    color:white;
    transition: 0.2 ease;
 }
 .card-content .swiper-pagination-bullet{
    background:black;
    height: 15px;
    width: 15px;
 }
 .card-content .swiper-slide-button{
    color: black;
    margin-top:-50px;
    transition: 0.2s ease;
 }
 .card-content .swiper-slide-button:hover{
    color:white;
 }


.perguntas{
    height: 530px;
    width: 100%;
    background-color: #DE3122;
}
.perguntas h1{
    color: white;
}

.banner{
    width: 100%;
    height: 620px;
    background: url("../imagens/banner2.jpg") no-repeat center;
    background-size: cover;
}
  .faq-container2 {
   
    background-color: #DE3122;
   
    width: 100%;
    }
  .faq-container2 h1{
    color: white;
  }
  .faq-container {
      max-width: 800px;
      margin:  auto;
      padding: 80px;

    }

    h1 {
      text-align: center;
      font-size: 2em;
  
    }

    .faq-item {
        
      background-color:rgba(253, 187, 4, 0.88);
      margin-top: 10px;
      border-radius: 5px;
      overflow: hidden;
    }

    .faq-question {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      padding: 15px;
      font-weight: bold;
      color: #fff;
    }

      .faq-answer  p{
          margin-block-start: 0;
    margin-block-end: .9rem;
    text-align: justify;
    }
    .faq-answer {
      display: none;
      padding: 15px;
        background-color: #DE3122;
      font-size: 0.95em;
      color: #fff;
    }

    .faq-item.active .faq-answer {
      display: block;
    }

    .faq-icon {
      font-size: 20px;
      transition: transform 0.3s;
    }

    .faq-item.active .faq-icon {
      transform: rotate(180deg);
    }
        </style>
 </body>
 
</html>