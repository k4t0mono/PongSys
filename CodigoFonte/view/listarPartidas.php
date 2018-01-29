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
          if(array_key_exists('adm',$_SESSION)){
            if($_SESSION["adm"] != null){
              echo "<li><a>Bem-vindo, Organizador</a></li>";
              echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
            }
          }
          else{
            if(array_key_exists('user',$_SESSION)){
              $conexao = new Conexao();
              $jogadorDAO = new JogadorDAO();
              $usuario = $jogadorDAO->consultarJogadorPorEmail($_SESSION['user'], $conexao->getLink());
              if($usuario != null){
                echo "<li><a href='../view/edicaoJogador.php?nick=".$usuario->getNickname()."'>Bem-vindo, ".$usuario->getNome()."</a></li>";
                echo "<li><a href='../control/logoff.php'>Logoff</a></li>";
              }
              else{
                echo "<li><a href='login.html'>Login</a></li>";
              }
            }
            else{
              echo "<li><a href='login.html'>Login</a></li>";
            }
          }
        ?>

      </ul>
    </div>
  </nav>

  <div class="container center-align">
    <h3>Partidas</h3>
    <?php
      require_once("../persistence/partidaDAO.php");
      require_once("../persistence/conexao.php");
      require_once("../persistence/equipeDAO.php");

      $c = new Conexao();
      $p = new PartidaDAO();
      $e = new EquipeDAO();

      $partidas = $p->listarPartidas($c->getLink());
      if($partidas != null) {
        echo "<div class='card z-depth-5'>";
        echo "<table border='1' class='highlight centered responsive-table bordered'>";
        echo "<thead><tr> <th>Id</th> <th>Equipe 1</th> <th>Equipe 2</th> <th>Data</th> <th>Estado</th> <th>Vencedores</th> </tr></thead>";
        echo "<tbody>";

        foreach($partidas as $pr) {
          echo "<tr>";
          echo "<td> <a href = '../view/visualizarPartida.php?id=".$pr->getIdPartida()."'></a>".$pr->getIdPartida()."</td>";

          $equipe1 = $e->buscarEquipe($pr->getEquipe1(), $c->getLink())->getNome();
          echo "<td>".$equipe1."</td>";

          $equipe2 = $e->buscarEquipe($pr->getEquipe2(), $c->getLink())->getNome();
          echo "<td>".$equipe2."</td>";

          echo "<td>".$pr->getData()."</td>";

          $estado = $pr->getEstado();
          if($estado == 0) {
            $estado = "Não realizado";
          } elseif ($estado == 1) {
            $estado = "Em andamento";
          } elseif ($estado == 2) {
            $estado = "Finalizada";
          }

          echo "<td>".$estado."</td>";

          echo "<td>";
          if($estado == "Finalizada") {

            if($pr->getResultado() == 1) {
              $win = $pr->getEquipe1();
            } else {
              $win = $pr->getEquipe2();
            }

            $result = $e->buscarEquipe($win, $c->getLink())->getNome();
            echo $result;
          } else {
            echo "...";
          }
          echo "</td>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

      } else {
        echo "<p>Não há partidas registradas</p>";
      }
      if(array_key_exists('adm',$_SESSION)){
        if($_SESSION["adm"] == true){
          echo "<a href='../view/cadastroPartida.php'><button type='button' class='waves-effect waves-light btn'>Cadastrar nova partida</button></a>";
        }
      }
    ?>
  </div>

'  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/tabelas.js"></script>
</body>
</html>
