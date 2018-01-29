<?php
  require_once ('../model/jogador.php');
  require_once ('../persistence/jogadorDAO.php');
  require_once ('../persistence/conexao.php');
  
  class JogadorController{
    function cadastrarJogador($email, $equipe, $nick, $nome, $senha){

      $jogador = new Jogador($email, $equipe, $nick, $nome, $senha);

      $conexao = new Conexao();

      $jogadorDAO = new JogadorDAO();

      $jogadorDAO->cadastrarJogador($jogador, $conexao->getLink());

    }
  }

?>
