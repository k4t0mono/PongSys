<?php
  require_once ('../model/jogador.php');
  require_once ('../persistence/jogadorDAO.php');
  require_once ('../persistence/conexao.php');
  
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $nick = $_POST["nick"];
  $equipe = $_POST["equipe"];
  $senha = $_POST["pass"];

  $jogador = new Jogador($email, $equipe, $nick, $nome, $senha);

  $conexao = new Conexao();

  $jogadorDAO = new JogadorDAO();

  $jogadorDAO->cadastrarJogador($jogador, $conexao->getLink());
  header('Location: ../view/listarJogadores.php');

?>
