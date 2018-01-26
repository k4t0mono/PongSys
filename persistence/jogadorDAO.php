<?php
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
        $resultado = new Pessoa($ret[0],$ret[1],$ret[2],$ret[3]);
        return $resultado;
      }
      return null;
    }


  }


?>
