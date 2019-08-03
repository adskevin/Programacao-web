<?php
require_once './Interface/ORMInterface.php';
class Topico implements ORMInterface {
	private $idTopico;
	private $nome;
	private $conteudo;
	private $fk_idUsuario;
	private $fk_idForum;
	private $dataDeCriacao;

	public function getIdTopico() {
		return $this->idTopico;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getConteudo() {
		return $this->conteudo;
	}
	public function getFkIdUsuario() {
		return $this->fk_idUsuario;
	}
	public function getFkIdForum() {
		return $this->fk_idForum;
	}
	public function getDataDeCriacao() {
		return $this->dataDeCriacao;
	}

	public function setIdTopico($idTopico) {
		$this->idTopico = $idTopico;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setConteudo($conteudo) {
		$this->conteudo = $conteudo;
	}
	public function setFkIdUsuario($fk_idUsuario) {
		$this->fk_idUsuario = $fk_idUsuario;
	}
	public function setFkIdForum($fk_idForum) {
		$this->fk_idForum = $fk_idForum;
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
		$sql = "INSERT INTO topicos
					(nome, conteudo, fk_idUsuario, fk_idForum)
				VALUES
					(:nome, :conteudo, :fk_idUsuario, :fk_idForum)";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(),
			':conteudo' => $this->getConteudo(),
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idForum' => $this->getFkIdForum()
		]);
		$this->idTopico = $db->lastInsertId();
	}
	// metodo que vai alterar os dados no BD
	public function update() {
		$db = self::getDB();
		$sql = "UPDATE topicos SET
					nome = :nome,
					conteudo = :conteudo,
					fk_idUsuario = :fk_idUsuario,
					fk_idForum = :fk_idForum,
					dataDeCriacao = :dataDeCriacao
				WHERE
					idTopico = :idTopico ";
		$query = $db->prepare($sql);
		$query->execute([
			':idTopico' => $this->getIdTopico(), 
			':nome' => $this->getNome(),
			':conteudo' => $this->getConteudo(), 
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idForum' => $this->getFkIdForum(),
			':dataDeCriacao' => $this->getDataDeCriacao()
		]);
	}
	// metodo que vai excluir do BD
	public function delete() {
		$db = self::getDB();
		$sql = "DELETE FROM topicos 
				WHERE
					idTopico = :idTopico ";
		$query = $db->prepare($sql);
		$query->execute([
			':idTopico' => $this->getIdTopico()
		]);
	}
	// metodo que vai procurar no banco por um ID e devolver o objeto
	public static function findById($idTopico) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM topicos 
				WHERE
					idTopico = :idTopico ";
		$query = $db->prepare($sql);
		$query->execute([
			':idTopico' => $idTopico
		]);
		$dados = $query->fetch();
		$topico = new Topico();
		$topico->setIdTopico($idTopico);
		$topico->setNome( $dados['nome'] );
		$topico->setConteudo( $dados['conteudo'] );
		$topico->setFkIdUsuario( $dados['fk_idUsuario'] );
		$topico->setFkIdForum( $dados['fk_idForum'] );
		$topico->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $topico;
	}
	// metodo que vai buscar todos os registros do BD
	public static function findAll() {
		$db = self::getDB();
		$sql = "SELECT *
				FROM topicos ";
		$query = $db->query($sql);
		$topicos = array();
		foreach ($query as $dados) {
			$topico = new Topico();
			$topico->setIdTopico( $dados['idTopico'] );
			$topico->setNome( $dados['nome'] );
			$topico->setConteudo( $dados['conteudo'] );
			$topico->setFkIdUsuario( $dados['fk_idUsuario'] );
			$topico->setFkIdForum( $dados['fk_idForum'] );
			$topico->setDataDeCriacao( $dados['dataDeCriacao'] );
			$topicos[] = $topico;
		}
		return $topicos;
	}

	// Método que encontra os fóruns de certa categoria e os retorna.
	public static function findByOwner($fk_idForum) {
		console_log( $fk_idForum );
		$db = self::getDB();
		$sql = "SELECT *
				FROM topicos
				WHERE
					fk_idForum = :fk_idForum ";
		
		$query = $db->prepare($sql);
		// console_log( $query );
		$query->execute([
			':fk_idForum' => $fk_idForum
		]);
		// $dados = $query->fetch();
		// console_log( $dados );
		$topicos = array();
		foreach ($query as $dados) {
			$topico = new Topico();
			$topico->setIdTopico($dados['idTopico']);
			$topico->setNome( $dados['nome'] );
			$topico->setConteudo( $dados['conteudo'] );
			$topico->setFkIdUsuario( $dados['fk_idUsuario'] );
			$topico->setFkIdForum( $dados['fk_idForum'] );
			$topico->setDataDeCriacao( $dados['dataDeCriacao'] );
			$topicos[] = $topico;
		}
		return $topicos;
	}
}