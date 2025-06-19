
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tcul</title>
</head>
<body>

<dialog id="modal-login">
  <div class="titulo">Log in</div>
  <form action="" method="POST">
    <div class="user_detalhes">
      <div class="input-box">
        <span class="detalhes">Email</span>
        <input name="email" type="text" placeholder="exemple@gmail.com" required>
      </div>
      <div class="input-box">
        <span class="detalhes">Password</span>
        <input name="password" type="password" placeholder="Introduza a palavra passe" required>
      </div>
    </div>      
    <div class="button">
      <input name="login" type="submit" value="LOGIN"> 
    </div>
    <div class="login">
      <label>Não tem uma conta? <a id="cadastro_modal" href="cadastro_modal.php">criar conta</a></label>
    </div>
  </form>
</dialog>

                    <?php
                    include('../scriptlogin.php');
                    ?>
              <script>
  const modal = document.getElementById("modal-login");

  // Abre o modal ao clicar em qualquer botão com class .abrir_modal
  document.querySelectorAll('.abrir_modal').forEach(button => {
    button.addEventListener('click', () => {
      modal.showModal();
    });
  });

  // Fechar o modal ao clicar fora do conteúdo
  modal.addEventListener("click", (e) => {
    const rect = modal.getBoundingClientRect();
    const isInDialog = (
      rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
      rect.left <= e.clientX && e.clientX <= rect.left + rect.width
    );
    if (!isInDialog) {
      modal.close();
    }
  });
</script>


    <style>
        dialog{
    max-width: 700px;
    width: 100%;
    background: #fff;
    padding: 25px 30px;
    border-radius: 5px;
    border: none;
/*position: relative;*/
top: 40%;
left: 40%;
width: 20%;

}
dialog .titulo{
    font-size: 25px;
    font-weight: 500px;
    position: relative;
    text-align: center;
 
}
/*dialog .titulo::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 30px;
    
}*/
dialog form .user_detalhes{ 
   /* display: flex;*/
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
     
}
dialog form .user_detalhes .input-box{
   margin-bottom: 15px;
   
    /*width: calc(100% / 2 - 1px);*/
}
dialog .user_detalhes .input-box .detalhes{
    display: block;
    font-weight: 500px;
    margin-bottom: 5px;
   
}
dialog .user_detalhes .input-box input{ 
    
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
.user_detalhes .input-box input:focus,
.user_detalhes .input-box input:valid{

}



dialog form .button{
    height: 45px;
    margin: 25px 0;
}
dialog form .button input{
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
dialog form .login{
    text-align: center;
}
    </style>
</body>
</html>