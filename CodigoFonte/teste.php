<?php
  require_once("./model/pessoa.php");
  require_once("./model/jogador.php");
  require_once("./model/equipe.php");
  require_once("./model/partida.php");
  require_once("./model/desempenho.php");
  require_once("./persistence/conexao.php");
  require_once("./persistence/pessoaDAO.php");

  $pedro = new Pessoa("lol", "kk", "kk", "kk", "kk");

  $breno = new Jogador("Brenex","oi", "oi", "oi", "oi", "idEquipe do brenex");
  $breno2 = new Jogador("Brenexon","oi", "oi", "oi", "oi", "idEquipe do brenex");

  echo $pedro->getNome()."<br />";
  echo $breno->getIdEquipe()."<br />";

  $time1 = new Equipe("Curintians");
  $time2 = new Equipe("Mengão");

  $time1->addJogador($breno);
  $time2->addJogador($breno2);

  $array = $time1->getJogadores();

  echo count($array)."<br />";


  echo $array[0]->getNome()."<br />";

  $conexao = new Conexao();
  $pessoaDAO = new PessoaDAO();
  // $pessoaDAO->cadastrarPessoa($pedro, $conexao->getLink());

  $consulta = $pessoaDAO->consultarPessoaPorEmail("okok", $conexao->getLink());
  echo "<br />";
  echo "<br />";
  if($consulta != null){
    echo $consulta->getNome();
  }


?>
