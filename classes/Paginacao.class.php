<?php 
require_once("DB.php");

class Paginacao extends DB{
	private $table;
	private $itenspagina;
	private $pagina;
	private $condicao;

	public function insert() {}

	public function update($id) {}


	public function setTable($table) {
		$this->table = $table;
	}

	public function setItensPagina($itenspagina) {
		$this->itenspagina = $itenspagina;
	}

	public function setPagina($pagina) {
		$this->pagina = $pagina;
	}

	public function setCondicao($condicao) {
		$this->condicao = $condicao;
	}

	public function consulta() {
		$sql = "SELECT * FROM $this->table LIMIT $this->pagina, $this->itenspagina";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function consultaNum() {
		$sql = "SELECT * FROM $this->table LIMIT $this->pagina, $this->itenspagina";
		$execute = DB::prepare($sql);
		$execute->execute();
		$cliente = $execute->fetch(PDO::FETCH_ASSOC);
		$num = $execute->rowCount();
		return $num;
	}

	private function consultaTotal() {
		$sql_total = "SELECT * FROM $this->table";
		$total = DB::prepare($sql_total);
		$total->execute();
		$num_total = $total->rowCount();
		return $num_total;
	}

	public function totalPaginas() {
		$num_paginas = ceil($this->consultaTotal()/$this->itenspagina);
		return $num_paginas;
	}

	public function sql() {
		$sql = "SELECT * FROM $this->table $this->condicao LIMIT $this->pagina, $this->itenspagina";
		return $sql;
	}
}

?>