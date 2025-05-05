<?php
if(isset($_SESSION['mensagem'])):
?>
<div class="alert alert-warning alert-dismissible fad show" role="alert">

<?=$_SESSION['mensagem'];?>
<button type="button" class="btn-close" data-bs-dimiss="alert" aria-label="close"></button>
</div>

<?php
 unset($_SESSION['mensagem']);
endif;
?>