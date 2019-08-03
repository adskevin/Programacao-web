<?php
require_once './Interface/ORMInterface.php';
class Forum implements ORMInterface {
	private $idForum;
	private $nome;
	private $fk_idUsuario;
	private $fk_idCategoria;
	private $dataDeCriacao;

	public function getIdForum() {
		return $this->idForum;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getFkIdUsuario() {
		return $this->fk_idUsuario;
	}
	public function getFkIdCategoria() {
		return $this->fk_idCategoria;
	}
	public function getDataDeCriacao() {
		return $this->dataDeCriacao;
	}

	public function setIdForum($idForum) {
		$this->idForum = $idForum;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setFkIdUsuario($fk_idUsuario) {
		$this->fk_idUsuario = $fk_idUsuario;
	}
	public function setFkIdCategoria($fk_idCategoria) {
		$this->fk_idCategoria = $fk_idCategoria;
	}
	public function setDataDeCriacao($dataDeCriacao) {
		$this->dataDeCriacao = $dataDeCriacao;
	}
	public static function getDB() {
		$db = new PDO('mysql:host=localhost;dbname=forum', 
						'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, 
				PDO::ERRMODE_EXCEPTION);
		return $db;
	}

	// metodo que vai inserir no BD
	public function insert() {
		$db = self::getDB();
		$sql = "INSERT INTO foruns
					(nome, fk_idUsuario, fk_idCategoria)
				VALUES
					(:nome, :fk_idUsuario, :fk_idCategoria)";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(), 
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idCategoria' => $this->getFkIdCategoria()
		]);
		$this->idForum = $db->lastInsertId();
	}
	// metodo que vai alterar os dados no BD
	public function update() {
		$db = self::getDB();
		$sql = "UPDATE foruns SET
					nome = :nome, 
					fk_idUsuario = :fk_idUsuario,
					fk_idCategoria = :fk_idCategoria,
					dataDeCriacao = :dataDeCriacao
				WHERE
					idForum = :idForum ";
		$query = $db->prepare($sql);
		$query->execute([
			':idForum' => $this->getIdForum(), 
			':nome' => $this->getNome(), 
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idCategoria' => $this->getFkIdCategoria(),
			':dataDeCriacao' => $this->getDataDeCriacao()
		]);
	}
	// metodo que vai excluir do BD
	public function delete() {
		$db = self::getDB();
		$sql = "DELETE FROM foruns 
				WHERE
					idForum = :idForum ";
		$query = $db->prepare($sql);
		$query->execute([
			':idForum' => $this->getIdForum()
		]);
	}
	// metodo que vai procurar no banco por um ID e devolver o objeto
	public static function findById($idForum) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM foruns 
				WHERE
					idForum = :idForum ";
		$query = $db->prepare($sql);
		$query->execute([
			':idForum' => $idForum
		]);
		$dados = $query->fetch();
		$forum = new Forum();
		$forum->setIdForum($idForum);
		$forum->setNome( $dados['nome'] );
		$forum->setFkIdUsuario( $dados['fk_idUsuario'] );
		$forum->setFkIdCategoria( $dados['fk_idCategoria'] );
		$forum->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $forum;
	}
	// metodo que vai buscar todos os registros do BD
	public static function findAll() {
		$db = self::getDB();
		$sql = "SELECT *
				FROM foruns ";
		$query = $db->query($sql);
		$foruns = array();
		foreach ($query as $dados) {
			$forum = new Forum();
			$forum->setIdForum( $dados['idForum'] );
			$forum->setNome( $dados['nome'] );
			$forum->setFkIdUsuario( $dados['fk_idUsuario'] );
			$forum->setFkIdCategoria( $dados['fk_idCategoria'] );
			$forum->setDataDeCriacao( $dados['dataDeCriacao'] );
			$foruns[] = $forum;
		}
		return $foruns;
	}

	// Método que encontra os fóruns de certa categoria e os retorna.
	public static function findByOwner($fk_idCategoria) {
		// console_log( $fk_idCategoria );
		$db = self::getDB();
		$sql = "SELECT *
				FROM foruns
				WHERE
					fk_idCategoria = :fk_idCategoria ";
		
		$query = $db->prepare($sql);
		// console_log( $query );
		$query->execute([
			':fk_idCategoria' => $fk_idCategoria
		]);
		// $dados = $query->fetch();
		// console_log( $dados );
		$foruns = array();
		foreach ($query as $dados) {
			$forum = new Forum();
			$forum->setIdForum($dados['idForum']);
			$forum->setNome( $dados['nome'] );
			$forum->setFkIdUsuario( $dados['fk_idUsuario'] );
			$forum->setFkIdCategoria( $dados['fk_idCategoria'] );
			$forum->setDataDeCriacao( $dados['dataDeCriacao'] );
			$foruns[] = $forum;
		}
		return $foruns;
	}
}