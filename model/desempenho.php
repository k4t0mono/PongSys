<?php
  class Desempenho{
    private $idJogador;
    private $idPartida;
    private $eliminacoes;
    private $mortes;
    private $assistencias;

    function __construct($idJogador, $idPartida, $eliminacoes, $mortes, $assistencias){
      $this->idJogador = $idJogador;
      $this->idPartida = $idPartida;
      $this->eliminacoes = $eliminacoes;
      $this->mortes = $mortes;
      $this->assistencias = $assistencias;

    }

    public function getIdJogador(){
      return $this->idJogador;
    }
    public function getIdPartida(){
      return $this->idPartida;
    }
    public function getEliminacoes(){
      return $this->eliminacoes;
    }
    public function getMortes(){
      return $this->mortes;
    }
    public function getAssistencias(){
      return $this->assistencias;
    }
  }
?>
