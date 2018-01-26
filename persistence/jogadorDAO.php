<?php
  class JogadorDAO{
    function cadastrarJogador($jogador, $link){
      $SQL = "INSERT INTO pessoas VALUES (0,
                                          '$jogador->getNickname()',
                                          '$jogador->getNome()',
                                          '$jogador->getEmail()',
                                          '$jogador->getSenha()',
                                          0);";

  		if (!mysqli_query($link, $SQL)) {
  			die("Erro na inserção de cliente");
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
