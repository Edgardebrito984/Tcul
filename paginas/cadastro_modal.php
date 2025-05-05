<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="/css/cadastro.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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











        <div class="container1">
        <div class="container">
            
            <div class="titulo">REGISTRAR</div>
            
            <form action="" id="form" method="POST">
                <div class="user_detalhes">
                    <div class="input-box">
                        <span class="detalhes">Nome Completo</span>
                        <input name="nome" type="text" placeholder="Insira o seu nome completo" required pattern="^[A-Za-zÀ-ú]+(\s[A-Za-zÀ-ú]+)+$">
                    </div>
                    <div class="input-box">
                        <span class="detalhes">Data de nascimento</span>
                        <input name="data_nascimento" type="date" placeholder=""required>
                        
                    </div>
                    <div class="input-box">
                        <span class="detalhes">Email</span>
                        <input name="email" type="text" placeholder="amadeu@gmail.com"required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <div class="input-box">
                        <span class="detalhes">Numero do telefone</span>
                        <input name="telefone"type="text" placeholder="introduza o número de telefone"required pattern="^\d{9}$">
                    </div>
                    <div class="input-box">
                        <span class="detalhes">BI Nº</span>
                        <input name="numero_bilhete"type="text" placeholder=""required pattern="^\d{9}[A-Z]{2}\d{3}$">
                    </div>
                    <div class="input-box">
                        <span class="detalhes">PASSWORD</span>
                        <input name="password"type="password" placeholder="XXXXXXX"required>
                    </div>
                </div>               
                 <div class="button">
                <input name="cadastrar"type="submit" value="REGISTAR" href="login_modal.php"> 
                </div>
                
                 </div>
                </div>
                <?php
                include('../scriptcadastro.php');
                ?>
            </form>
          </div>
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

</body>
<style>

body{

   
   
font-family: sans-serif;
}

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



.container1{
   display: flex;
   align-items: center;
   justify-content: center;
   height: 100vh;
   padding-top: 40px;
   
}

 .container{
   
   max-width: 700px;
   width: 100%;
   background-color: linear;
   padding: 25px 30px;
   border-radius: 5px;
   justify-content: center;
   align-items: center;
   
}

.container form .user_detalhes{
   display: flex;
   flex-wrap: wrap;
   justify-content: space-between;
    margin: 20px 0 12px 0;
}



form .user_detalhes .input-box{
  /*margin-bottom: 15px;*/
   width: calc(100% / 1 - 20px);
}

.user_detalhes .input-box .detalhes{
   display: block;
   font-weight: 500px;
   margin-bottom: 5px;
}
.user_detalhes .input-box input{ 
   height: 45px;
   width: 100%;
   outline: none;
   border-radius: 5px;
   border: 1px solid #ccc;
   padding-left: 15px;
   font-size: 16px;
   border-bottom-width: 2px;
   transition: all 0.3s ease;
}


form .button{
   height: 45px;
   margin: 25px 0;
}
form .button input{
   height: 100%;
   width: 100%;
   outline: none;
   color: #fff;
   border: none;
   font-size: 18px;
   font-weight: 500;
   border-radius: 5px;
   letter-spacing: 1px;
   background: #F49609;
   cursor: pointer;
}

@media(max-width: 584px){
   .container{
       max-width: 100%;
   }
   form .user_detalhes .input-box{
       margin-bottom: 15px;
       width: 100%;
   }
   .container form .user_detalhes{
       max-height: 300px;
       overflow-y: scroll;
   }
   .user_detalhes::-webkit-scrollbar{
       width: 0;
       
   }
}
 .titulo{
    font-size: 1.8em;
   margin-bottom: 10%;
 }
 .input{
    min-width: 280px;
    border-radius: 22px;
    border: 2px solid;
    padding: 10px;
    margin: 0px 0px 12px -5px;
 }
 
 .input input{
    width: 80%;
    border: none;
    transform: translateY(-10%);
 }
 #btn{
    margin-top: 10%;
    width: 100%;
    text-align: center;
 }
 #btn button{
    
    width: 100%;
    height: 40px;
    border: none;
    font-size: 1.2em;
    border-radius: 20px;
    outline: none;
    color:  #D15941;
    cursor: pointer; 
 }
 

 #btn button:hover{
    background: -webkit-linear-gradient(-45deg, #ffce51, #ff7253, #fd5754);
 }
 @keyframes iniciar{
    0%{
        top: -20%;
        opacity: 0;
        pointer-events: none;
    }
    100%{
        top: 50%;
        opacity: 100%;
        pointer-events: all;
    }
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

</html>