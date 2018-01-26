<?php
  class Conexao{
  	var $servidor;
  	var $usuario;
  	var $senha;
  	var $bd;
  	var $link;

  	function Conexao() {
  		$this->servidor = 'localhost';
  		$this->usuario = 'root';
  		$this->senha = '';
  		$this->bd = 'PongSys';

  		$this->link = mysqli_connect($this->servidor,
  						$this->usuario,$this->senha,$this->bd);

  		if(!$this->link) {
  			die("conexao falhou");
  		}

  	}
  	function getLink(){
  		return $this->link;
  	}

  	function fechar(){
  		mysqli_close($this->link);
  	}
  }


?>
