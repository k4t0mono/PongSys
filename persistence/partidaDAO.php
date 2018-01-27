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

  }

?>
