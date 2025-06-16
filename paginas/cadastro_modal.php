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

       
          <?php 
                      
include("nav.php");                
      ?>

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


<?php
include('../paginas/footer.php');
?>

</style>

</html>