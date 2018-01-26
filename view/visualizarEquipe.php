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
      $nome = $_GET["nome"];

      $c = new Conexao();
			$e = new EquipeDAO();
			$jogadores = $e->consultarJogadoresDaEquipePorNome($nome,$c->getLink());
      echo "<h3>".$nome."</h3>";
      echo "<table border = '1' class = 'highlight centered'>";
			echo "<thead><tr><th>"."Nickname"."</th><th>"."Nome"."</th></tr></thead>";
			echo "<tbody>";
			foreach($jogadores as $jogador){
				echo "<tr>";
        echo "<td><a href='visualizarJogador.php?nick=".$jogador->getNickname()."'></a>".$jogador->getNickname()."</td>";
				echo "<td>".$jogador->getNome()."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
		?>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/tabelas.js"></script>

</body>
</html>
