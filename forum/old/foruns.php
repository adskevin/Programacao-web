<?php
session_start();
require_once __DIR__.'/Classes/Usuario.php';
require_once './Classes/Categoria.php';
require_once './Classes/Forum.php';
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
					$forum = new Forum();
					if (!empty($_POST)) {
						if(isset($_SESSION['nome'])){					
							$forum->setNome($_POST['nome']);
							$forum->setFkIdUsuario($usuario->getIdUsuario());
							$forum->setFkIdCategoria($_POST['categorias']);
							$forum->insert();
							print '<br>';
							print 'Fórum criado!<br/>';
							print '<a href="foruns.php">Voltar</a>';
						}else{
							print 'Você precisa estar logado para criar um Fórum.';
							print '<a href="login.php">Login</a>';
						}
					}
					else {
						require_once __DIR__.'/views/forms/form_forum.php';
					}
				break;
			case 'update': 
				$forum = Forum::findById($_GET['id']);
				if (!empty($_POST)) {
					$forum->setNome($_POST['nome']);
					$forum->setFkIdUsuario($forum->getFkIdUsuario());
					$forum->setFkIdCategoria($_POST['categorias']);
					$forum->update();
					print '<br>Fórum atualizado!<br/>';
					print '<a href="foruns.php">Voltar</a>';
				}
				else {
					require_once __DIR__.'/views/forms/form_forum.php';
				}
				break;
			case 'delete': 
				$forum = Forum::findById($_GET['id']);
				$forum->delete();
				print 'Fórum excluido!<br/>';
				print '<a href="foruns.php">Voltar</a>';
				break;
		}
	}else{
		print '<br>';
		print 'Você não possui nivel suficiente para criar/alterar um Fórum.';
		print '<br>';
		print '<a href="foruns.php">Voltar</a>';
	}
}
else {
	$foruns = Forum::findAll();
	require_once __DIR__.'/views/listas/lista_foruns.php';
} 