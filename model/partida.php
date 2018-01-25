<?php
  require_once("partida.php");

  class Partida{
    private $idPartida;
    private $equipe1;
    private $equipe2;
    private $data;
    private $estado;
    private $resultado;

    function __construct($idPartida,$equipe1,$equipe2,$data,$estado,$resultado){
      $this->idPartida = $idPartida;
      $this->equipe1 = $equipe1;
      $this->equipe2 = $equipe2;
      $this->data = $data;
      $this->estado = $estado;
      $this->resultado = $resultado;
    }
    public function getIdPartida(){
      return $this->idPartida;
    }

    public function getEquipe1(){
      return $this->equipe1;
    }

    public function getEquipe2(){
      return $this->equipe2;
    }

    public function getData(){
      return $this->data;
    }

    public function getEstado(){
      return $this->estado;
    }

    public function getResultado(){
      return $this->resultado;
    }
  }
?>
