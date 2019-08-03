<?php
session_start();
require_once __DIR__.'/Classes/Usuario.php';
require_once './Classes/Categoria.php';
require_once './Classes/Forum.php';
require_once './Classes/Topico.php';
require_once './Classes/Post.php';
if(isset($_SESSION['nome'])){
	print $_SESSION['nome'];
	print ' - ';
	print $_SESSION['id'];
}else{
	print('não tem usuario logado');
}
if (isset($_SESSION['id'])){
	$usuario = Usuario::findById($_SESSION['id']);
}else{
	$usuario = new Usuario();
}
if (isset($_GET['req'])) {
	if($usuario->getNivel() >= 2){
		switch ($_GET['req']) {
			case 'insert':
					$post = new Post();
					if (!empty($_POST)) {
						if(isset($_SESSION['nome'])){					
							$post->setNome($_POST['nome']);
							$post->setConteudo($_POST['conteudo']);
							$post->setFkIdUsuario($usuario->getIdUsuario());
							$post->setFkIdTopico($_POST['idtopico']);
							$post->insert();
							print '<br>';
							print 'Post criado!<br/>';
							print '<a href="posts.php">Voltar</a>';
						}else{
							print 'Você precisa estar logado para criar um Fórum.';
							print '<a href="login.php">Login</a>';
						}
					}
					else {
						require_once __DIR__.'/views/forms/form_post.php';
					}
				break;
			case 'update': 
				$post = Post::findById($_GET['id']);
				if (!empty($_POST)) {
					$post->setNome($_POST['nome']);
					$post->setConteudo($_POST['conteudo']);
					$post->setFkIdUsuario($post->getFkIdUsuario());
					$post->setFkIdTopico($_POST['topicos']);
					$post->update();
					print '<br>Post atualizado!<br/>';
					print '<a href="posts.php">Voltar</a>';
				}
				else {
					require_once __DIR__.'/views/forms/form_post.php';
				}
				break;
			case 'delete': 
				$post = Post::findById($_GET['id']);
				$post->delete();
				print '<br>Post excluido!<br/>';
				print '<a href="posts.php">Voltar</a>';
				break;
		}
	}else{
		print '<br>';
		print 'Você não possui nivel suficiente para criar/alterar um Post.';
		print '<br>';
		print '<a href="topicos.php">Voltar</a>';
	}
}
else {
	$posts = Post::findAll();
	require_once __DIR__.'/views/listas/lista_posts.php';
} 