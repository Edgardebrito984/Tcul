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
   <title>Tcul</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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
                <img src="../imagens/novo.jpg" alt="" width=""; height=" ">

         </div> 
         <div class="container2">
         <h1>Pensando em viajar?</h1>
            <p>Escolha o destino e compre online a sua passagem de autocarro interprovincial</p>
            </div> 
           <div class="marcar_viagens">
             <div class="viagens">
                <?php 
                include("../conecao.php");

                $sql ="SELECT origem, destino from rotas"
                ?>
             <form action="">
            
                <input type="radio" value="Somente Ida" required class="tipo_de_viagens">
                <span>Somente ida</span>
               
                <div class="select-container">
                    <select name="" id="">
                        <option value="">Origem</option>
                        <option value="">Luanda</option>
                        <option value="">Malanje</option>
                        <option value="">Huila</option>
                    </select>
              
                    <select name="" id="">
                        <option value="">Destino</option>
                        <option value="">Luanda</option>
                        <option value="">Malanje</option>
                        <option value="">Huila</option>
                    </select>
                </div>
                
                <div class="input-date">
                <input type="date" required>
                
                <button >Procurar</button>
            </div>
               </div>
          
            </form>
           </div>
           </div>
            <div class="card-container swiper">
               <h1> <i class="fa-solid fa-bus-simple"></i>  DESTINOS PARA VC</h1>
                   <div class="card-content wrapper">
                     <div class="card-list swiper-wrapper">
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



            <div class="card-container swiper">
               <h1><i class="fa-solid fa-bus-simple"></i>   OUTROS DESTINOS PARA VOCÊ</h1>
                   <div class="card-content wrapper">
                     <div class="card-list swiper-wrapper">
                        <?php
                        include('../conecao.php');

  
                        $sql ="SELECT id,origem, destino, preco FROM rotas";
                        $result= $conn->query($sql);

                        if($result->num_rows > 0){
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                            <?php
                  
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
            </div>
   <?php 
         include("footer.php");
      ?>
       
       <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../js/index.js"></script>
        <style>


@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
}

ul {
  list-style: none;
}
body{
  background-color:   #f0f0f0;
}

header {
  position: sticky;
  top: 0;
  z-index: 999;
  transition: 0.4s;
}

.nav-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 6rem;
  background-color: rgb(238, 66, 51);
  height: 60px;
}

.logo {
  display: flex;
  align-items: center;
}

.logo h1 {
  color: #fff;
}

.nav-list {
  display: flex;
  align-items: center;
}

.nav-list ul {
  display: flex;
  justify-content: center;
}

.nav-item {
  position: relative;
  width: 200px;
  height: 20px;
  min-width: 100px;
}

.nav-link {
  text-decoration: none;
  color: #EFF6F6;
  font-size: 18px;
  padding: 0 10px;
  font-weight: bold;
  position: relative;
  letter-spacing: 0.5px;
}

.nav-link:after {
  content: "";
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 0;
  height: 3px;
  background-color: #F49609;
  transition: 0.1s;
}

.nav-link:hover {
  color: #F49609;
}

.nav-link:hover:after {
  width: 100%;
}

.login-button button,
.logout-button button {
  border: none;
  background-color: #F49609;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
}

.login-button button a,
.logout-button button a {
  text-decoration: none;
  color: #fff;
  font-weight: 500;
}

.logout-button {
  padding: 10px;
}

/* MOBILE NAVBAR */
.mobile-menu-icon {
  display: none;
}

.mobile-menu {
  display: none;
}

@media screen and (max-width: 730px) {
  .nav-bar {
    padding: 1.5rem 4rem;
  }

  .nav-item,
  .login-button {
    display: none;
  }

  .mobile-menu-icon {
    display: block;
  }

  .mobile-menu-icon button {
    background: transparent;
    border: none;
    cursor: pointer;
  }

  .mobile-menu ul {
    display: flex;
    flex-direction: column;
    text-align: center;
    padding-bottom: 1rem;
  }

.mobile-menu .nav-item {
    display: block;
    padding-top: 1.2rem;
  }

.mobile-menu .login-button {
    display: block;
    padding: 1rem;
}

.mobile-menu .login-button button {
    width: 100%;
}

  .open {
    display: block;
  }

  .card-content {
    margin: 0 10px 40px;
  }

  .swiper-slide-button {
    display: none;
  }
}

/* LOGO / CABEÇALHO*/
.head {
  background-color: #F49609;
  padding-left: 40px;
  padding-right: 20px;
  height: 100px;
  text-align: center;
}

.head img {
  height: 90px;
  width: 300px;
  display: inline-block;
  vertical-align: middle;
  max-width: 100%;
}

/* CONTAINER IMAGEM / SLIDER */
.container {
  background-color: red;
  width:100%;
  height: 400px;
}

.container img {
  width: 100%;
  height: 100%;
  margin-bottom: 10px;
}
.container2 {
  display: flex;
  flex-direction: column;
  justify-content: center; /* Centraliza verticalmente */
  align-items: center;     /* Centraliza horizontalmente */
  text-align: center;
  
  
}

.container2 h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.container2 p {
  font-size: 1.2rem;
  max-width: 600px;
}

/* ÁREA DE viagens*/
.marcar_viagens {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 20px;
  width: 100%;
}

.viagens {
  margin-top: 0;
  padding: 40px 20px 0;
  max-width: 720px;
  width: 100%;
 /* box-shadow: 0 0 5px rgba(0,0,0,0.5);*/
  border-radius: 20px;

   background-color: #fff;
    padding: 30px;
    
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

.viagens span {
  color: black;
}

.viagens .select-container select,
.viagens .input-date input {
  font-weight: 800;
  color: black;
  background-color: #EFF6F6;
  margin-top: 8px;
  border: none;
  border-radius: 8px;
  height: 45px;
  width: 100%;
  cursor: pointer;
}

.viagens .input-date button {
  margin-top: 20px;
  background-color: #F49609;
  width: 90px;
  height: 40px;
  font-weight: 800;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.viagens .input-date button:hover {
  color: white;
  transition: 0.2s ease;
}

/* CARDS */
.card-container h1 {
  text-align: center;
  padding-top: 20px;
  font-weight: 200;
}

.card-content {
  max-width: 2500px;
  padding-top: 40px;
  margin: 0 70px 55px;
  overflow: hidden;
}

.card-list .card-item {
  background-color: #DE3122;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 5px;
  border-radius: 8px;
  user-select: none;
}

.card-item img {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  border: 3px solid #fff;
  padding: 4px;
}

.card-item h1,
.card-item h2 {
  color: white;
}

.card-item p {
  font-size: 1.25rem;
  font-weight: 500;
  color: rgb(251, 255, 44);
  margin: 14px 0 10px;
}

.card-item button {
  font-size: 1.25rem;
  padding: 10px 35px;
  font-weight: 500;
  background-color: #F49609;
  color: #030728;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.2s ease;
}

.card-item button:hover {
  color: white;
}

/* Swiper customization */
.card-content .swiper-pagination-bullet {
  background: black;
  width: 15px;
  height: 15px;
}

.card-content .swiper-slide-button {
  color: black;
  margin-top: -50px;
  transition: 0.2s ease;
}

.card-content .swiper-slide-button:hover {
  color: white;
}

/* FOOTER */
.footer {
  background-color: #DE3122;
  padding: 70px 0;
}

.container-footer {
  max-width: 1170px;
  margin: auto;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.footer-col {
  width: 17%;
  padding: 0 15px;
}

.footer-col h4 {
  font-size: 18px;
  color: white;
  text-transform: capitalize;
  margin-bottom: 30px;
  font-weight: 500;
  position: relative;
}

.footer-col ul li:not(:last-child) {
  margin-bottom: 10px;
}

.footer-col ul li a {
  font-size: 16px;
  color: white;
  text-transform: capitalize;
  font-weight: 300;
  text-decoration: none;
  transition: all 0.3s ease;
}

.footer-col ul li a:hover {
  color: #ffffff;
  padding-left: 8px;
}

.footer-col .social-links a {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: 0 10px 10px 0;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #ffffff;
  transition: all 0.5s ease;
}
.row {
  display: flex;
  flex-wrap: wrap;
  gap: 40px; /* Aumenta o espaço entre colunas */
}

.footer-col .social-links a:hover {
  background-color: #ffffff;
  color: #24262b;
}

/* Footer responsivo */
@media (max-width: 760px) {
  .footer-col {
    width: 50%;
    margin-bottom: 30px;
  }
}

@media (max-width: 574px) {
  .footer-col {
    width: 100%;
  }
}


        </style>
 </body>
 
</html>