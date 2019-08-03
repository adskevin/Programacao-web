<?php
require_once './Interface/ORMInterface.php';

class Usuario implements ORMInterface {
	private $idUsuario;
	private $nome;
	private $nivel;
	private $senha;
	private $email;
	private $dataDeCriacao;

	public function getIdUsuario() {
		return $this->idUsuario;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getNivel() {
		return $this->nivel;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getDataDeCriacao() {
		return $this->dataDeCriacao;
	}
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	public function setEmail($email) {
		$this->email = $email;
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
		$sql = "INSERT INTO usuarios
					(nome, nivel, senha, 
						email)
				VALUES
					(:nome, :nivel, :senha, 
						:email)";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(), 
			':nivel' => $this->getNivel(), 
			':senha' => $this->getSenha(), 
			':email' => $this->getEmail()
		]);
		$this->idUsuario = $db->lastInsertId();
	}
	// metodo que vai alterar os dados no BD
	public function update() {
		$db = self::getDB();
		$sql = "UPDATE usuarios SET
					nome = :nome, 
					nivel = :nivel, 
					senha = :senha, 
					email = :email
				WHERE
					idUsuario = :idUsuario ";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(), 
			':nivel' => $this->getNivel(), 
			':senha' => $this->getSenha(), 
			':email' => $this->getEmail(),
			':idUsuario' => $this->getIdUsuario()
		]);
	}
	// metodo que vai excluir do BD
	public function delete() {
		$db = self::getDB();
		$sql = "DELETE FROM usuarios 
				WHERE
					idUsuario = :idUsuario ";
		$query = $db->prepare($sql);
		$query->execute([
			':idUsuario' => $this->getIdUsuario()
		]);
	}
	// metodo que vai procurar no banco por um nome e devolver o objeto
	public static function findByName($nome) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM usuarios 
				WHERE
					nome = :nome ";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $nome
		]);
		$dados = $query->fetch();
		$usuario = new Usuario();
		$usuario->setIdUsuario( $dados['idUsuario'] );
		$usuario->setNome( $dados['nome'] );
		$usuario->setNivel( $dados['nivel'] );
		$usuario->setSenha( $dados['senha'] );
		$usuario->setEmail( $dados['email'] );
		$usuario->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $usuario;
	}
	// metodo que vai procurar no banco por um ID e devolver o objeto
	public static function findById($idUsuario) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM usuarios 
				WHERE
					idUsuario = :idUsuario ";
		$query = $db->prepare($sql);
		$query->execute([
			':idUsuario' => $idUsuario
		]);
		$dados = $query->fetch();
		$usuario = new Usuario();
		$usuario->setIdUsuario($idUsuario);
		$usuario->setNome( $dados['nome'] );
		$usuario->setNivel( $dados['nivel'] );
		$usuario->setSenha( $dados['senha'] );
		$usuario->setEmail( $dados['email'] );
		$usuario->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $usuario;
	}
	// metodo que vai buscar todos os registros do BD
	public static function findAll() {
		$db = self::getDB();
		$sql = "SELECT *
				FROM usuarios ";
		$query = $db->query($sql);
		$usuarios = array();
		foreach ($query as $dados) {
			$usuario = new Usuario();
			$usuario->setIdUsuario( $dados['idUsuario'] );
			$usuario->setNome( $dados['nome'] );
			$usuario->setNivel( $dados['nivel'] );
			$usuario->setSenha( $dados['senha'] );
			$usuario->setEmail( $dados['email'] );
			$usuario->setDataDeCriacao( $dados['dataDeCriacao'] );
			$usuarios[] = $usuario;
		}
		return $usuarios;
	}

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