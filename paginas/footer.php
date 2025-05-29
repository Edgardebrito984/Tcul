<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title></title>
</head>
<body>
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

        <style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
}

ul {
  list-style: none;
}
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