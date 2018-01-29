<?php

	require_once ('../model/desempenho.php');
	require_once ('../persistence/desempenhoDAO.php');
	require_once ('../persistence/jogadorDAO.php');
	require_once ('../persistence/conexao.php');

	$emailJogador = $_POST['jogador'];
	$partida = $_POST['partida'];
	$k = $_POST['k'];
	$d = $_POST['d'];
	$a = $_POST['a'];

	echo $emailJogador."<br /><br />";

	$desempenho = new Desempenho($emailJogador, $partida, $k, $d, $a);

	$conexao = new Conexao();
	$desempenhoDAO = new DesempenhoDAO();
	$desempenhoDAO->cadastrarDesempenho($desempenho, $conexao->getLink());

	$jogadorDAO = new JogadorDAO();
	$jogador = $jogadorDAO->consultarJogadorPorEmail($emailJogador, $conexao->getLink());
	$nickname = $jogador->getNickname();

	header('Location: ../view/visualizarJogador.php?nick='.$nickname);
?>
