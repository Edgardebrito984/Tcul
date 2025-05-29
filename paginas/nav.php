


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
</style>

</body>
</html>

