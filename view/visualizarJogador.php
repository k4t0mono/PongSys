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
				<li><a href="../view">Home</a></li>
				<li><a href="../view/listarJogadores.php">Jogadores</a></li>
				<li><a href="../view/listarEquipes.php">Equipes</a></li>
				<li><a href="../view/listarPartidas.php">Partidas</a></li>
				<?php
					require_once("../persistence/jogadorDAO.php");
					require_once("../persistence/conexao.php");
					session_start();
					if(array_key_exists('user',$_SESSION)){
						$conexao = new Conexao();
						$jogadorDAO = new JogadorDAO();
						$usuario = $jogadorDAO->consultarJogadorPorEmail($_SESSION['user'], $conexao->getLink());
						if($usuario != null){
							echo "<li><a>Bem-vindo, ".$usuario->getNome()."</a></li>";
							echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
						}
						else{
							echo "<li><a href='login.html'>Login</a></li>";
						}
					}
					else{
						echo "<li><a href='login.html'>Login</a></li>";
					}
				?>

			</ul>
		</div>
	</nav>

	<div class="container center-align">
		<?php
			require_once("../persistence/conexao.php");
      require_once("../persistence/equipeDAO.php");
			require_once("../persistence/jogadorDAO.php");
			require_once("../persistence/desempenhoDAO.php");
			require_once("../persistence/partidaDAO.php");

			$nick = $_GET["nick"];

      $c = new Conexao();

			$j = new JogadorDAO();
			$e = new EquipeDAO();
			$p = new PartidaDAO();
			$d = new DesempenhoDAO();

			$jogador = $j->consultarJogadorPorNick($nick,$c->getLink());
      $equipe = $e->buscarEquipe($jogador->getIdEquipe(), $c->getLink());
			$desempenhos = $d->consultarDesempenhoJogador($jogador->getEmail(), $c->getLink());
			$partidas = array();
			if($desempenhos != null){
				foreach($desempenhos as $desempenho){
					$partidas[] = $p->consultarPartidaPorId($desempenho->getIdPartida(), $c->getLink());
				}
			}

      // echo "<div class='col s4'>";
      echo "<div class='card'>";
      echo "  <div class='row'>";
      echo "    <div class='col s6 right-align'><img src='./img/perfil.jpg' class='imagem-perfil'/></div>";
      echo "    <div class='col s6 left-align'><h3>".$jogador->getNickname()."</h3></div>";
      echo "  </div>";
      echo "  <p><b>Nome:</b> ".$jogador->getNome()."</p>";
      echo "  <p><b>Equipe:</b> <a href='visualizarEquipe.php?nome=".$equipe->getNome()."'>".$equipe->getNome()."</a></p>";


			echo "<div class='card'>";
			echo "<h5>Desempenho</h5>";
      echo "<table border = '1' class = 'highlight centered'>";
			echo "<thead><tr><th>"."Partida"."</th><th>"."Data"."</th><th>"."Eliminações"."</th><th>"."Mortes"."</th><th>"."Assistências"."</th></tr></thead>";
			echo "<tbody>";
			if($desempenhos != null) {
				for($i = 0; $i < count($partidas); $i++){
					echo "<tr>";

					if($partidas[$i] != null){
						$equipe1 = $e->buscarEquipe($partidas[$i]->getEquipe1(), $c->getLink());
						$equipe2 = $e->buscarEquipe($partidas[$i]->getEquipe2(), $c->getLink());
						echo "<td><a href=''></a>".$equipe1->getNome()." x ".$equipe2->getNome()."</td>";
						echo "<td>".$partidas[$i]->getData()."</td>";
					}
					echo "<td>".$desempenhos[$i]->getEliminacoes()."</td>";
					echo "<td>".$desempenhos[$i]->getMortes()."</td>";
					echo "<td>".$desempenhos[$i]->getAssistencias()."</td>";
					echo "</tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";


			echo "</div>";

			echo "<a href='../view/edicaoJogador.php?nick=".$jogador->getNickname()."'><button type='button' class='waves-effect waves-light btn'>Editar Jogador</button></a>";
			echo "<button type='button' onclick = 'confirmarDelecao()' class='waves-effect waves-light btn'>Apagar Jogador</button>";

		?>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/tabelas.js"></script>
	<script>
		function confirmarDelecao(){
			var confirmacao = confirm("Deseja realmente deletar esse jogador? (não pode ser revertido)");
			if(confirmacao == true){
				var email = "<?php echo $jogador->getEmail()?>";
				window.location = "../control/deletarJogador.php?email=" + email;
			}
		}
	</script>

</body>
</html>
