<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="tcul";

$conn= new mysqli ($hostname,$username,$password,$dbname);
/*echo"conection sucessful";*/


if($conn->error){
    die("falha na conexão com o banco de dados");
}
/*$con= mysqli_connect ("localhost","root","","tcul") or die("Erro");*/

?>