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
                echo "<li><a href='login.php'>Login</a></li>";
              }
            }
            else{
              echo "<li><a href='login.php'>Login</a></li>";
            }
          }
        ?>

      </ul>
    </div>
  </nav>

  <div class="container center-align">
    <h3>Jogadores:</h3>
    <?php
      require_once("../persistence/jogadorDAO.php");
      require_once("../persistence/conexao.php");
      require_once("../persistence/equipeDAO.php");
      require_once("../persistence/desempenhoDAO.php");
      $c = new Conexao();
      $j = new JogadorDAO();
      $e = new EquipeDAO();
      $d = new DesempenhoDAO();
      $jogadores = $j->listarJogadores($c->getLink());
      if($jogadores != null){
        echo "<div class='card z-depth-5'>";
        echo "<table border = '1' class = 'highlight centered'>";
        echo "<thead><tr> <th>Nickname</th> <th>Equipe</th> <th>Partida Jogadas</th> </tr></thead>";
        echo "<tbody>";
        foreach($jogadores as $jogador){
          echo "<tr>";
          echo "<td><a href = '../view/visualizarJogador.php?nick=".$jogador->getNickname()."'></a>".$jogador->getNickname()."</td>";
          $equipe = $e->buscarEquipe($jogador->getIdEquipe(), $c->getLink());
          echo "<td>".$equipe->getNome()."</td>";

          $partidas = $d->contarDesempenhoJogador($jogador->getEmail(), $c->getLink());
          echo "<td>".$partidas."</td>";

          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
      }
      else{
        echo "<p>Não há jogadores registrados</p>";
      }
      if(array_key_exists('adm',$_SESSION)){
        if($_SESSION["adm"] == true){
          echo "<a href='./cadastroJogador.php'><button type='button' class='waves-effect waves-light btn'>Cadastrar novo jogador</button></a>";
        }
      }
    ?>
  </div>

'  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/tabelas.js"></script>
</body>
</html>
