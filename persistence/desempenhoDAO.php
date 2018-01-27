<?php

require_once('../model/desempenho.php');

class DesempenhoDAO {

	function cadastrarDesempenho($d, $link) {
		$SQL = "INSERT INTO Desempenho VALUES(".$d->getIdPartida().",
						'".$d->getIdJogador()."', ".$d->getEliminacoes().",
						".$d->getMortes().", ".$d->getAssistencias().");";

		echo $SQL;
		if(!mysqli_query($link, $SQL)){
			die("Nao foi possivel inserir desempenho");
		}
	}

}

?>
