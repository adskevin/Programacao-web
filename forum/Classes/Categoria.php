<?php
require_once './Interface/ORMInterface.php';
class Categoria implements ORMInterface {
	private $idCategoria;
	private $nome;
	private $fk_idUsuario;
	private $dataDeCriacao;

	public function getIdCategoria() {
		return $this->idCategoria;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getFkIdUsuario() {
		return $this->fk_idUsuario;
	}
	public function getDataDeCriacao() {
		return $this->dataDeCriacao;
	}

	public function setIdCategoria($idCategoria) {
		$this->idCategoria = $idCategoria;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setFkIdUsuario($fk_idUsuario) {
		$this->fk_idUsuario = $fk_idUsuario;
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
		$sql = "INSERT INTO categorias
					(nome, fk_idUsuario)
				VALUES
					(:nome, :fk_idUsuario)";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(), 
			':fk_idUsuario' => $this->getFkIdUsuario()
		]);
		$this->idCategoria = $db->lastInsertId();
	}
	// metodo que vai alterar os dados no BD
	public function update() {
		$db = self::getDB();
		$sql = "UPDATE categorias SET
					nome = :nome,
					fk_idUsuario = :fk_idUsuario,
					dataDeCriacao = :dataDeCriacao
				WHERE
					idCategoria = :idCategoria ";
		$query = $db->prepare($sql);
		$query->execute([
			':idCategoria' => $this->getIdCategoria(),
			':nome' => $this->getNome(), 
			':dataDeCriacao' => $this->getDataDeCriacao(),
			':fk_idUsuario' => $this->getFkIdUsuario()
		]);
	}
	// metodo que vai excluir do BD
	public function delete() {
		$db = self::getDB();
		$sql = "DELETE FROM categorias 
				WHERE
					idCategoria = :idCategoria ";
		$query = $db->prepare($sql);
		$query->execute([
			':idCategoria' => $this->getIdCategoria()
		]);
	}
	// metodo que vai procurar no banco por um ID e devolver o objeto
	public static function findById($idCategoria) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM categorias 
				WHERE
					idCategoria = :idCategoria ";
		$query = $db->prepare($sql);
		$query->execute([
			':idCategoria' => $idCategoria
		]);
		$dados = $query->fetch();
		$categoria = new Categoria();
		$categoria->setIdCategoria($idCategoria);
		$categoria->setNome( $dados['nome'] );
		$categoria->setFkIdUsuario( $dados['fk_idUsuario'] );
		$categoria->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $categoria;
	}
	// metodo que vai buscar todos os registros do BD
	public static function findAll() {
		$db = self::getDB();
		$sql = "SELECT *
				FROM categorias ";
		$query = $db->query($sql);
		$categorias = array();
		foreach ($query as $dados) {
			$categoria = new Categoria();
			$categoria->setIdCategoria( $dados['idCategoria'] );
			$categoria->setNome( $dados['nome'] );
			$categoria->setFkIdUsuario( $dados['fk_idUsuario'] );
			$categoria->setDataDeCriacao( $dados['dataDeCriacao'] );
			$categorias[] = $categoria;
		}
		return $categorias;
	}

	// Método que encontra os fóruns de certa categoria e os retorna.
	public static function findByOwner($fk_idCategoria) {
		echo($fk_idCategoria);
		$db = self::getDB();
		$sql = "SELECT *
				FROM foruns 
				WHERE
					fk_idCategoria = :fk_idCategoria ";
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
}