<?php
  require_once('../model/equipe.php');

  class EquipeDAO{
    function buscarEquipe($idEquipe, $link){
      $SQL = "SELECT * FROM Equipe WHERE idEquipe = ".$idEquipe.";";
      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de equipe");
      }
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $resultado = new Equipe($linha[1],$linha[0]);
          return $resultado;
        }
      }
      return null;
    }

    function listarEquipes($link){
      $SQL = "SELECT * FROM Equipe";
      $retorno = mysqli_query($link, $SQL);

      if(!$retorno){
        die("Erro na consulta de equipes.");
      }
      $equipes = array();
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $equipes[] = new Equipe($linha[1]);
        }
        return $equipes;
      }
      return null;
    }

    function consultarJogadoresDaEquipePorNome($nome, $link){
      $SQL = "SELECT * FROM Equipe WHERE nomeEquipe ='$nome';";

      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de equipe");
      }
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $resultado = $this->consultarJogadoresDaEquipePorId($linha[0],$link);
          return $resultado;
        }
      }
      return null;
    }

    function consultarJogadoresDaEquipePorId($id, $link){
      $SQL = "SELECT * FROM Jogador WHERE idEquipe ='$id';";

      $retorno = mysqli_query($link, $SQL);
      if(!$retorno){
        die("Erro na consulta de equipe");
      }
      $resultado = array();
      if(mysqli_num_rows($retorno) > 0){
        $ret = $retorno->fetch_all();
        foreach($ret as $linha){
          $resultado[] = new Jogador($linha[0],$linha[1],$linha[2],$linha[3],$linha[4]);
        }
        return $resultado;
      }
      return null;
    }
  }

?>
