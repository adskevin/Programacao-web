<?php
session_start();
require_once __DIR__.'/Classes/Usuario.php';
require_once './Classes/Categoria.php';
require_once './Classes/Forum.php';
require_once './Classes/Topico.php';
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
					$topico = new Topico();
					if (!empty($_POST)) {
						if(isset($_SESSION['nome'])){					
							$topico->setNome($_POST['nome']);
							$topico->setConteudo($_POST['conteudo']);
							$topico->setFkIdUsuario($usuario->getIdUsuario());
							$topico->setFkIdForum($_POST['foruns']);
							$topico->insert();
							print '<br>';
							print 'Topico criado!<br/>';
							print '<a href="topicos.php">Voltar</a>';
						}else{
							print 'Você precisa estar logado para criar um Fórum.';
							print '<a href="login.php">Login</a>';
						}
					}
					else {
						require_once __DIR__.'/views/forms/form_topico.php';
					}
				break;
			case 'update': 
				$topico = Topico::findById($_GET['id']);
				if (!empty($_POST)) {
					$topico->setNome($_POST['nome']);
					$topico->setConteudo($_POST['conteudo']);
					$topico->setFkIdUsuario($topico->getFkIdUsuario());
					$topico->setFkIdForum($_POST['foruns']);
					$topico->update();
					print '<br>Topico atualizado!<br/>';
					print '<a href="topicos.php">Voltar</a>';
				}
				else {
					require_once __DIR__.'/views/forms/form_topico.php';
				}
				break;
			case 'delete': 
				$topico = Topico::findById($_GET['id']);
				$topico->delete();
				print '<br>Topico excluido!<br/>';
				print '<a href="topicos.php">Voltar</a>';
				break;
		}
	}else{
		print '<br>';
		print 'Você não possui nivel suficiente para criar/alterar um Topico.';
		print '<br>';
		print '<a href="topicos.php">Voltar</a>';
	}
}
else {
	$topicos = Topico::findAll();
	require_once __DIR__.'/views/listas/lista_topicos.php';
} 