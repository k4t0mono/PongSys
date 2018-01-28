<?php
  require_once('../model/organizador.php');
  class OrganizadorDAO{

    function consultarOrganizadorPorEmail($email, $link){

      $SQL = "SELECT * FROM Organizador WHERE email ='$email';";

      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de cliente");
      }
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $resultado = new Organizador($linha[0],$linha[1]);
          return $resultado;
        }
      }
    }
  }

?>
