<?php
  require_once("../model/jogador.php");

  class JogadorDAO{
    function cadastrarJogador($jogador, $link){
      $SQL = "INSERT INTO Jogador VALUES ('".$jogador->getEmail()."',
                                          '".$jogador->getIdEquipe()."',
                                          '".$jogador->getNickname()."',
                                          '".$jogador->getNome()."',
                                          '".$jogador->getSenha()."');";

      echo $SQL."<br />";
      if (!mysqli_query($link, $SQL)) {
  			die("Erro na inserção de pessoa");
  		}

    }

    function consultarJogadorPorEmail($email, $link){

      $SQL = "SELECT * FROM Jogador WHERE email ='$email';";

      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de cliente");
      }
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $resultado = new Jogador($linha[0],$linha[1],$linha[2],$linha[3],$linha[4]);
          return $resultado;
        }
      }
      return null;
    }


  }


?>
