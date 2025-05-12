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
    
     
   <div class="head">
    
    <img src="../imagens/tcul2.png" alt="">
   </div>
        <header>
            <nav class="nav-bar">
               
                <div class="nav-list">
                    <ul>
                        <li class="nav-item" ><a href="# "class="nav-link">Início</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Sobre</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Projectos</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Início</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Sobre</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Projectos</a></li>
                    </ul>
                    <?php if(isset($_SESSION['email'])){ ?>
                        <div>
                             <?php echo "". $_SESSION['nome'];?>
                        </div>
                     <div class="logout-button"> 
                        <button><a href="logout.php">sair</a></button>
                    </div>
                    <?php }else{ ?>
                    <div class="login-button"> 
                        
                        <button id="abrir_modal" href ="login">Entrar</button>
                      <?php  }?>
                    </div>
                   
                    <?php
                    include('login_modal.php')
                    ?>
                </div>
                    
                    <div class="mobile-menu-icon">
                    <button onclick="menuShow()"><img src="../imagens/menu.png" alt="" height="20px"width="20px"></button>
                    </div>
                    </nav>
                   
                   
                  
                 <!--   <script>
                // Seleciona o botão e o dialog
                const abrir_modal = document.querySelector("#abrir_modal");
                const modal = document.querySelector("dialog");

                // Ao clicar no botão, abre o modal
                abrir_modal.onclick = function() {
                    modal.showModal();
                };

                // (Opcional) Se quiser fechar o modal ao clicar fora dele
                modal.addEventListener("click", (e) => {
                    // Se o usuário clicar fora do conteúdo do modal, fecha
                    const dialogDimensions = modal.getBoundingClientRect();
                    if (
                    e.clientX < dialogDimensions.left ||
                    e.clientX > dialogDimensions.right ||
                    e.clientY < dialogDimensions.top ||
                    e.clientY > dialogDimensions.bottom
                    ) {
                    modal.close();
                    }
                });
                </script>
-->
            
             <div class="mobile-menu">
              <ul>
                        <li class="nav-item" ><a href="# "class="nav-link">Início</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Sobre</a></li>
                        <li class="nav-item" ><a href="# "class="nav-link">Projectos</a></li>
                    </ul>
                    <div class="login-button"> 
                        <button >Entrar</button>
                    </div>
             </div>

         
         </header>
        
        <div class="container">     
                <img src="../imagens/novo.jpg" alt="" width=""; height=" ">

         </div> 
         <div class="container2">
         <h1>Pensando em viajar?</h1>
            <p>Escolha o destino e compre online a sua passagem de autocarro interprovincial</p>
            </div> 
           <div class="marcar_viagens">
             <div class="viagens">
             <form action="">
            
                <input type="radio" value="Somente Ida" required class="tipo_de_viagens">
                <span>Somente ida</span>
                <input type="radio" value="Somente Ida" class="tipo_de_viagens">
                <span>Ida e volta</span><br> <br>
               
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
                    
                         
                         
                       

                        <!--<div class="card-item swiper-slide">
                            <img src="../imagens/luanda.jpeg" alt="">
                            <h2>Luanda</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button>Comprar</button>    
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
                            <button>Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button>Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button>Comprar</button>
                        </div>

                        <div class="card-item swiper-slide">
                            <img src="../imagens/huambo.jpeg" alt="">
                            <h2>Huambo</h2>
                            <p><i class="fa-solid fa-arrow-down"></i></p>
                            <h1>lubango</h1>
                            <p class="preco">A partir de: 4.000kz</p>
                            <button>Comprar</button>
                        </div>
                     </div>-->
                     
                </div>
                    <div class="swiper-pagination"></div>
                    <div class=" swiper-slide-button swiper-button-prev"></div>
                    <div class=" swiper-slide-button swiper-button-next"></div>
                 </div>
            </div>
        <footer class="footer">
            <div class="container-footer">
                <div class="row">
                    <div class="footer-col">
                        <h4> INSTUTUCIONAL</h4>
                            <ul>
                                <li><a href="#">A nossa história</a></li>
                            </ul>
                        </div>

                        <div class="footer-col">
                        <h4>SERVIÇOS</h4>
                            <ul>
                                <li><a href="#">Urbano</a></li>
                                <li><a href="#">Fretamento</a></li>
                                <li><a href="#">Aluguer</a></li>
                                <li><a href="#">Encomendas</a></li>
                            </ul>
                        </div>
                        
                        <div class="footer-col">
                        <h4>ATENDIMENTO</h4>
                            <ul>
                            <li><a href="#">Duvidas frequentes</a></li>
                                <li><a href="#">Reclamações</a></li>
                                <li><a href="#">Trabalhe conosco</a></li>
                            </ul>
                        </div>

                        <div class="footer-col">
                         <h4>ENDEREÇO</h4>
                            <ul>
                               <li><a href="#">Mutamba</a></li>
                            </ul>
                        </div>

                        <div class="footer-col">
                        <h4>SIGA-NOS NAS REDES SOCIAIS </h4>
                            <div class="social-links">
                           <a href="#"><i class="fa-brands fa-twitter"></i></a>
                           <a href="#"><i class="fa-brands fa-facebook"></i></a> 
                           <a href="#"><i class="fa-brands fa-instagram"></i></a>
                           <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                           <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                           </div>

                    </div>
                </div>
            </div>
        </footer>
       
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