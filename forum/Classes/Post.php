<?php
require_once './Interface/ORMInterface.php';
class Post implements ORMInterface {
	private $idPost;
	private $nome;
	private $conteudo;
	private $fk_idUsuario;
	private $fk_idTopico;
	private $dataDeCriacao;

	public function getIdPost() {
		return $this->idPost;
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
	public function getFkIdTopico() {
		return $this->fk_idTopico;
	}
	public function getDataDeCriacao() {
		return $this->dataDeCriacao;
	}

	public function setIdPost($idPost) {
		$this->idPost = $idPost;
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
	public function setFkIdTopico($fk_idTopico) {
		$this->fk_idTopico = $fk_idTopico;
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
		$sql = "INSERT INTO posts
					(nome, conteudo, fk_idUsuario, fk_idTopico)
				VALUES
					(:nome, :conteudo, :fk_idUsuario, :fk_idTopico)";
		$query = $db->prepare($sql);
		$query->execute([
			':nome' => $this->getNome(),
			':conteudo' => $this->getConteudo(),
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idTopico' => $this->getFkIdTopico()
		]);
		$this->idPost = $db->lastInsertId();
	}
	// metodo que vai alterar os dados no BD
	public function update() {
		$db = self::getDB();
		$sql = "UPDATE posts SET
					nome = :nome,
					conteudo = :conteudo,
					fk_idUsuario = :fk_idUsuario,
					fk_idTopico = :fk_idTopico,
					dataDeCriacao = :dataDeCriacao
				WHERE
					idPost = :idPost ";
		$query = $db->prepare($sql);
		$query->execute([
			':idPost' => $this->getIdPost(), 
			':nome' => $this->getNome(),
			':conteudo' => $this->getConteudo(), 
			':fk_idUsuario' => $this->getFkIdUsuario(),
			':fk_idTopico' => $this->getFkIdTopico(),
			':dataDeCriacao' => $this->getDataDeCriacao()
		]);
	}
	// metodo que vai excluir do BD
	public function delete() {
		$db = self::getDB();
		$sql = "DELETE FROM posts 
				WHERE
					idPost = :idPost ";
		$query = $db->prepare($sql);
		$query->execute([
			':idPost' => $this->getIdPost()
		]);
	}
	// metodo que vai procurar no banco por um ID e devolver o objeto
	public static function findById($idPost) {
		$db = self::getDB();
		$sql = "SELECT *
				FROM posts 
				WHERE
					idPost = :idPost ";
		$query = $db->prepare($sql);
		$query->execute([
			':idPost' => $idPost
		]);
		$dados = $query->fetch();
		$post = new Post();
		$post->setIdPost($idPost);
		$post->setNome( $dados['nome'] );
		$post->setConteudo( $dados['conteudo'] );
		$post->setFkIdUsuario( $dados['fk_idUsuario'] );
		$post->setFkIdTopico( $dados['fk_idTopico'] );
		$post->setDataDeCriacao( $dados['dataDeCriacao'] );
		return $post;
	}
	// metodo que vai buscar todos os registros do BD
	public static function findAll() {
		$db = self::getDB();
		$sql = "SELECT *
				FROM posts ";
		$query = $db->query($sql);
		$posts = array();
		foreach ($query as $dados) {
			$post = new Post();
			$post->setIdPost( $dados['idPost'] );
			$post->setNome( $dados['nome'] );
			$post->setConteudo( $dados['conteudo'] );
			$post->setFkIdUsuario( $dados['fk_idUsuario'] );
			$post->setFkIdTopico( $dados['fk_idTopico'] );
			$post->setDataDeCriacao( $dados['dataDeCriacao'] );
			$posts[] = $post;
		}
		return $posts;
	}

	// Método que encontra os fóruns de certa categoria e os retorna.
	public static function findByOwner($fk_idTopico) {
		console_log( $fk_idTopico );
		$db = self::getDB();
		$sql = "SELECT *
				FROM posts
				WHERE
					fk_idTopico = :fk_idTopico ";
		
		$query = $db->prepare($sql);
		// console_log( $query );
		$query->execute([
			':fk_idTopico' => $fk_idTopico
		]);
		// $dados = $query->fetch();
		// console_log( $dados );
		$posts = array();
		foreach ($query as $dados) {
			$post = new Post();
			$post->setIdPost($dados['idPost']);
			$post->setNome( $dados['nome'] );
			$post->setConteudo( $dados['conteudo'] );
			$post->setFkIdUsuario( $dados['fk_idUsuario'] );
			$post->setFkIdTopico( $dados['fk_idTopico'] );
			$post->setDataDeCriacao( $dados['dataDeCriacao'] );
			$posts[] = $post;
		}
		return $posts;
	}
}