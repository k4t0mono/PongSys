<?php
  require_once('../model/partida.php');

  class PartidaDAO {

    function cadastrarPartida($partida, $link) {
      echo $partida->getEquipe1();
      echo "<br />";

      $SQL = "INSERT INTO Partida VALUES('', '".$partida->getEquipe1()."',
             '".$partida->getEquipe2()."', '".$partida->getData()."',
             '".$partida->getEstado()."', '".$partida->getResultado()."');";

      echo $SQL."<br />";

      if(!mysqli_query($link, $SQL)){
        die("Nao foi possivel inserir equipe");
      }
    }

    function listarPartidas($link) {
      $SQL = "SELECT * FROM Partida";
      $retorno = mysqli_query($link, $SQL);

      if(!$retorno){
        die("Erro na consulta de cliente");
      }
      $partidas = array();
      if(mysqli_num_rows($retorno) > 0) {
        $ret = $retorno->fetch_all();
        foreach($ret as $l) {
          $partidas[] = new Partida($l[1], $l[2], $l[3], $l[4], $l[5], $l[0]);
        }
        return $partidas;
      }
      return null;
    }

  }

?>
