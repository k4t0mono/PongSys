<?php
  require_once("../persistence/jogadorDAO.php");
  require_once("../persistence/conexao.php");

  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $conexao = new Conexao();

  $jogadorDAO = new JogadorDAO();
  $jogador = $jogadorDAO->consultarJogadorPorEmail($email, $conexao->getLink());
  echo $jogador->getSenha();
  echo $senha;
  if($jogador->getSenha() == $senha){
    echo "deu bao";

  }
  else{
    echo "deu ruim";
  }

?>
