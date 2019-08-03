<?php
interface ORMInterface {
	// metodo que conecta no BD
	public static function getDB();
	// metodo que vai inserir no BD
	public function insert();
	// metodo que vai alterar os dados no BD
	public function update();
	// metodo que vai excluir do BD
	public function delete();
	// metodo que vai procurar no banco por um ID e devolver o ojeto
	public static function findById($id);
	// metodo que vai buscar todos os registros do BD
	public static function findAll();
	// metodo que vai buscar todos os registros que estiverem dentro dos paramentros
	public static function findByOwner($id);

}