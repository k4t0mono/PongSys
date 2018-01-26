<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />
	<link rel="stylesheet" href="./style.css" />
</head>

<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">PongSys</a>

			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="index.php">Home</a></li>
				<li><a href="view/jogadores.html">Jogadores</a></li>
				<li><a href="view/equipes.html">Equipes</a></li>
				<li><a href="view/partidas.html">Partidas</a></li>
			</ul>
		</div>
	</nav>

	<div class="container center-align">
		<?php
			require_once("../persistence/conexao.php");
      require_once("../persistence/equipeDAO.php");
			require_once("../persistence/jogadorDAO.php");
      $nick = $_GET["nick"];

      $c = new Conexao();
			$e = new EquipeDAO();
      $j = new JogadorDAO();
			$jogador = $j->consultarJogadorPorNick($nick,$c->getLink());
      // echo "<div class='col s4'>";
      echo "<div class='card'>";
      echo "<div class='row'>";
      echo "<div class='col s6 right-align'><img src='./img/perfil.jpg' class='imagem-perfil'/></div>";
      echo "<div class='col s6 left-align'><h3>".$jogador->getNickname()."</h3></div>";
      echo "</div>";
      echo "</div>";
      // echo "</div>";

		?>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/tabelas.js"></script>

</body>
</html>
