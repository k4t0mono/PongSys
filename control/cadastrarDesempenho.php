<?php

	require_once ('../model/desempenho.php');
	require_once ('../persistence/desempenhoDAO.php');
	require_once ('../persistence/conexao.php');

	$jogador = $_POST['jogador'];
	$partida = $_POST['partida'];
	$k = $_POST['k'];
	$d = $_POST['d'];
	$a = $_POST['a'];

	$desempenho = new Desempenho($jogador, $partida, $k, $d, $a);

	$conexao = new Conexao();
	$desempenhoDAO = new DesempenhoDAO();
	$desempenhoDAO->cadastrarDesempenho($desempenho, $conexao->getLink());

	header('Location: ../view/');
?>
