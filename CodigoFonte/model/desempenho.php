<?php
  class Desempenho{
    private $email;
    private $idPartida;
    private $eliminacoes;
    private $mortes;
    private $assistencias;

    function __construct($email, $idPartida, $eliminacoes, $mortes, $assistencias){
      $this->email = $email;
      $this->idPartida = $idPartida;
      $this->eliminacoes = $eliminacoes;
      $this->mortes = $mortes;
      $this->assistencias = $assistencias;

    }

    public function getIdJogador(){
      return $this->email;
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
