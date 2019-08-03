<?php 
require_once './Classes/Usuario.php';
if (isset($_GET['req'])) {
	switch ($_GET['req']) {
		case 'insert': 
			$usuario = new Usuario();
			if (!empty($_POST)) {
				$usuario->setNome($_POST['nome']);
				$usuario->setNivel($_POST['nivel']);
				$usuario->setSenha($_POST['senha']);
				$usuario->setEmail($_POST['email']);
				$usuario->insert();
				print 'Usuario inserido!<br/>';
				print '<a href="usuarios.php">Voltar</a>';
			}
			else {
				require_once __DIR__.'/views/forms/form_usuario.php';
			}
			break;
		case 'update': 
			$usuario = Usuario::findById($_GET['id']);
			if (!empty($_POST)) {
				$usuario->setNome($_POST['nome']);
				$usuario->setNivel($_POST['nivel']);
				// $usuario->setSenha($_POST['senha']);
				// $usuario->setEmail($_POST['email']);
				// $usuario->setDataDeCriacao($_POST['dataDeCriacao']);
				$usuario->update();
				print 'Usuario atualizado!<br/>';
				print '<a href="usuarios.php">Voltar</a>';
			}
			else {
				require_once __DIR__.'/views/forms/form_usuario.php';
			}
			break;
		case 'delete': 
			$usuario = Usuario::findById($_GET['id']);
			$usuario->delete();
			print 'Usuario excluido!<br/>';
			print '<a href="usuarios.php">Voltar</a>';
			break;
	}
}
else {
	$usuarios = Usuario::findAll();
	require_once __DIR__.'/views/listas/lista_usuarios.php';
} 