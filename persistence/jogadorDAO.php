<?php
  class JogadorDAO{
    function cadastrarJogador($jogador, $link){
      $SQL = "INSERT INTO Pessoa VALUES (0,
                                          '$jogador->getNickname()',
                                          '$jogador->getNome()',
                                          '$jogador->getEmail()',
                                          '$jogador->getSenha()',
                                          0);";

  		if (!mysqli_query($link, $SQL)) {
  			die("Erro na inserção de pessoa");
  		}


      $SQL = "INSERT INTO pessoas VALUES (0,
                                          '$jogador->getNickname()',
                                          '$jogador->getNome()',
                                          '$jogador->getEmail()',
                                          '$jogador->getSenha()',
                                          0);";

    }
  }


?>
