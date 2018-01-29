<?php
  require_once("jogador.php");

  class Equipe{
    private $jogadores;
    private $nomeEquipe;
    private $idEquipe;

    function __construct($nomeEquipe, $idEquipe){
      $this->jogadores = array();
      $this->nomeEquipe = $nomeEquipe;
      $this->idEquipe = $idEquipe;
    }

    public function addJogador($jogador){
      $this->jogadores[] = $jogador;
    }

    public function getJogadores(){
      return $this->jogadores;
    }

    public function getNome(){
      return $this->nomeEquipe;
    }

    public function getIdEquipe() {
      return $this->idEquipe;
    }
  }


?>
