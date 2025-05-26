   <html lang="pt">

        <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FasmaPay - teste</title>
     </head>

     <body>

     <form action="https://api.fasma.ao/?sudopay_key=32y3103T2tp26YLvltbtaIdq1QB3ubHstuB1RsGgK4Ac6tgLPILDc2b4RXeG240509" method="post" enctype="multipart/form-data">

     <input type="file" name="sudopay_file" accept="application/pdf" required/>
     <button type="submit">validar</button>
     </form>

     <script>

     if (form = document.querySelector('form')) {

         //verifica se o botao do tipo submit foi pressionado
         form.addEventListener('submit', function (e) {

         //cancela a a accão normal do botão submit
        
         e.preventDefault();

         //pega todos os dados do formulario e coloca na variavel do tipo FormData
         var dados = new FormData(form);

         //faz a requisicao com o fetch
         fetch(form.action, {
                method: form.method,
                body: dados
             })
              .then(res => {
                 //em caso de erro
                 if (!res.ok) throw new Error(res.status);
                 return res.json();
             })
             .then(data => {
                 //pegar os parametros necessarios caso for sucesso
			 	alert("sucesso: "+data.OPERACAO);
                

             })
             .catch((error) => {
                 //pegar o codigo de erro caso haja
                 alert("erro: "+error.message);
                
             });
     })

 }

 </script>

 </body>

 </html>