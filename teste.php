<?php
  require_once("./model/pessoa.php");
  require_once("./model/jogador.php");

  $pedro = new Pessoa("oi", "oi", "oi", "oi", "oi");

  $breno = new Jogador("Brenex","oi", "oi", "oi", "oi", "oi");

  echo $pedro->getNome();
?>
