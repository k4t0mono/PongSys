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
  ?>

  <div class="container center-align">
    <div class="row">
      <div class="col s12 m8 m2 offset-m2">
        <div class="card z-depth-5">
          <div class="card-content">
            <!-- <span class="card-title"><?php echo $jogador->getNickname(); ?></span> -->
            <h4><?php echo $jogador->getNickname(); ?></h4>
            <p>Nome: <?php echo $jogador->getNome(); ?></p>
            <p>
              Equipe:
              <a href='visualizarEquipe.php?nome=<?php echo $equipe->getNome(); ?>'>
                <?php echo $equipe->getNome(); ?>
              </a>
            </p>
            <p>Email: <?php echo $jogador->getEmail(); ?></p>
            <hr />

            <h5>Desempenho nas Partidas</h5>
            <table border = '1' class = 'highlight centered responsive-table'>
              <thead>
                <tr>
                  <th>Partida</th>
                  <th>Data</th>
                  <th>Eliminações</th>
                  <th>Mortes</th>
                  <th>Assistências</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($desempenhos != null) {
                    for($i = 0; $i < count($partidas); $i++){
                      echo "<tr>";
                      if($partidas[$i] != null){
                        $equipe1 = $e->buscarEquipe($partidas[$i]->getEquipe1(), $c->getLink());
                        $equipe2 = $e->buscarEquipe($partidas[$i]->getEquipe2(), $c->getLink());
                        echo "<td><a href='../view/visualizarPartida.php?id=".$partidas[$i]->getIdPartida()."'></a>".$equipe1->getNome()." x ".$equipe2->getNome()."</td>";
                        echo "<td>".$partidas[$i]->getData()."</td>";
                      }
                      echo "<td>".$desempenhos[$i]->getEliminacoes()."</td>";
                      echo "<td>".$desempenhos[$i]->getMortes()."</td>";
                      echo "<td>".$desempenhos[$i]->getAssistencias()."</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>

          <?php
            if(array_key_exists('adm',$_SESSION)){
              if($_SESSION["adm"] == true){
                echo "<div>";
                echo "<a href='../view/edicaoJogador.php?nick=".$jogador->getNickname()."'>";
                echo "<button type='button' class='waves-effect waves-light btn'>Editar Jogador</button></a>";
                echo "<button type='button' onclick = 'confirmarDelecao()' class='waves-effect waves-light btn'>Apagar Jogador</button>";
                echo "</div>";
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>

'  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
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
