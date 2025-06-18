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
                <img src="../imagens/banner.jpg" alt="" width=""; height=" ">

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
                            <button id="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button  id="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button id="abrir_modal">Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button  id="abrir_modal">Comprar</button>
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
                                <button  id="abrir_modal" href ="login">Comprar</button>
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
                    include('login_modal.php')
                    ?>
                         
                         
                       
                     
                
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
header{
    position: sticky;
    z-index: 999;
    top: 0;
    transition: 0.4s;
}
.nav-bar{
    display:flex;
    justify-content:space-between;
    padding: 1.5rem 6rem;
    background-color:rgb(238, 66, 51);
    height: 10px;      
}
.logo{
    display:flex;
    align-items: center;
}
.log h1{
    color:#fff;
}
.nav-list{
    display:flex;
    align-items: center;
    
}
.nav-list ul{
     display: flex;
     justify-content: center;
     list-style: none;
   
}

.nav-list .nav-item{
    align-items: center;
  width: 200px;
    height: 20px;
    min-width: 100px;;
    justify-content: space-around;
 position: relative;
}
.nav-list .nav-link{
    text-decoration: none;
    
    color: #EFF6F6;
    font-size: 18px;
    padding: 0 10px;
    font-weight: bold;
    position: relative;
    letter-spacing: 0.5px;
}
.nav-list .nav-link:after{
    content:"";
    position: absolute;
    background-color: #F49609;
    
    height:3px;
    width:0;
    left:0;
    bottom: -10px;
    transition: 0.1s;
}
.nav-list .nav-link:hover{
     color: #F49609;
     transition: 0.1s;
}
.nav-list .nav-link:hover:after{
    width:100%;
   
}
.login-button button{
    border: none;
    background-color:#F49609;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}

.login-button button a{
    text-decoration: none;
    color:#fff;
    font-weight:500;
}
.logout-button{
    padding: 10px;
}
.logout-button button{
    border: none;
    background-color:#F49609;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
} 
.logout-button button a{
    text-decoration: none;
    color:#fff;
    font-weight:500;
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
 .mobile-menu-icon{
    display:none;
 }
 .mobile-menu{
    display:none;
 }
 .container{
    background-color: red;
    width: 100%;
    height: 400px
 }
 .container img{
    width: 100%;
    /*width: 1600PX;*/
   /* height:400px;*/
   height: 100%;
    margin-bottom: 10px;
 }

 @media screen and (max-width:730px){
    .nav-bar{
        padding: 1.5rem 4rem;
    }
    .nav-item{
        display: none;
    }
    .login-button{
        display:none;
    }
    .mobile-menu-icon{
        display:block;
    }
    .mobile-menu-icon button{
        background-color: transparent;
        border:none;
        cursor:pointer;
    }
    .mobile-menu ul{
        display: flex;
        flex-direction: column;
        text-align:center;
        padding-bottom: 1rem;
    }
    .mobile-menu .nav-item{
        display:block;
        padding-top: 1.2rem;
    }
    .mobile-menu .login-button{
        display: block;
        padding: 1rem;
    }
    .mobile-menu .login-button button{
        width: 100%;
    }
    .container{
        
    }
    .open{
        display:block;
    }
    .card-content{
        margin 0 10px 40px;
    }
    .card-content .swiper-slide-button{
        display:none;
    }
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


 .footer{
    background-color: #DE3122;
    padding:70px 0;
 }
 ul{
    list-style: none;
 }
 .container-footer{
    max-width: 1170px;
    margin:auto;
 }

 .row{
    display:flex;
    flex-wrap: wrap;
    
 }
 .footer-col{
    width:17%;
    padding: 0 15px;
    
 }
 .footer-col h4{
    font-size: 18px;
    color: white;
    text-transform: capitalize;
    margin-bottom: 30px;
    font-weight:500;
    position:relative;
    
 }
 /*.footer-col h4::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    background-color: black;
    height: 2px;
    box-sizing: border-box;
    width:50px;
 }*/

 .footer-col ul li:not(:last-child){
    margin-bottom: 10px;
 }
 .footer-col ul li a{
    font-size: 16px;
    text-transform: capitalize;
    text-decoration:none;
    font-weight:300;
    display: block;
    transition: all 0.3s ease;
    color: white;
 }
 .footer-col ul li a:hover{
    color: #ffffff;
    padding-left: 8px;
 }
 .footer-col .social-links a{
    display: inline-block;
    height:40px;
    width: 40px;
    margin: 0 10px 10px 0;
    text-align:center;
    line-height:40px;
    border-radius:50%;
    color:#ffffff;
    transition: all 0.5s ease;
 }
 .footer-col .social-links a:hover{
    color: #24262b;
    background-color:#ffffff;
 }

 /*footer responsivo*/
 @media(max-width: 760px){
    .footer-col{

        width:50%;
        margin-bottom: 30px;

    }
 }

 @media(max-width: 574px){
    .footer-col{
        width:100%;
      
    }
 }


        </style>
 </body>
 
</html>