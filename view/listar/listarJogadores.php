<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection" />

	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">PongSys</a>

			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="index.html">Home</a></li>
				<li><a href="listar/listarJogadores.html">Jogadores</a></li>
				<li><a href="view/equipes.html">Equipes</a></li>
				<li><a href="view/partidas.html">Partidas</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<ul>
			<?php

			require_once ('../../model/jogador.php');
			require_once ('../../persistence/jogadorDAO.php');
			require_once ('../../persistence/conexao.php');

			$conexao = new Conexao();
			// $jogadorDAO = new JogadorDAO();

			// $jogadorDAO->listarJogadores($conexao->getLink());
			// echo $jogadores;

			?>
			<li>
				<div class="col s12 m12">
					<div class="card blue-grey darken-1 waves-effect waves-light ">
						<div class="card-content white-text">
							<span class="card-title center">Listagem de Jogadores</span>
						</div>
					</div>
				</div>
			</li>
		</ul>

		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>
