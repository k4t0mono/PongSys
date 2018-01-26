<?php
  require_once("jogador.php");

  class Equipe{
    private $jogadores;
    private $nomeEquipe;

    function __construct($nomeEquipe){
      $this->jogadores = array();
      $this->nomeEquipe = $nomeEquipe;
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
  }


?>
