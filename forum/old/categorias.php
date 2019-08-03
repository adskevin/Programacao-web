<?php
session_start();
require_once __DIR__.'/Classes/Usuario.php';
require_once './Classes/Categoria.php';
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
	if($usuario->getNivel() >= 3){
			switch ($_GET['req']) {
				case 'insert':
					$categoria = new Categoria();
						if (!empty($_POST)) {
							if(isset($_SESSION['nome'])){					
								$categoria->setNome($_POST['nome']);
								$categoria->setFkIdUsuario($usuario->getIdUsuario());
								$categoria->insert();
								print '<br>';
								print 'Categoria criada!<br/>';
								print '<a href="categorias.php">Voltar</a>';
							}else{
								print 'Você precisa estar logado para criar uma categoria.';
								print '<a href="login.php">Login</a>';
							}
						}
						else {
							require_once __DIR__.'/views/forms/form_categoria.php';
						}
					break;
				case 'update': 
					$categoria = Categoria::findById($_GET['id']);
					if (!empty($_POST)) {
						$categoria->setNome($_POST['nome']);
						$categoria->update();
						print '<br>';
						print 'Categoria atualizada!<br/>';
						print '<a href="categorias.php">Voltar</a>';
					}
					else {
						require_once __DIR__.'/views/forms/form_categoria.php';
					}
					break;
				case 'delete': 
					$categoria = Categoria::findById($_GET['id']);
					$categoria->delete();
					print 'Categoria excluida!<br/>';
					print '<a href="categorias.php">Voltar</a>';
					break;
			}
	}else{
		print '<br>';
		print 'Você não possui nivel suficiente para criar/alterar uma categoria.';
		print '<br>';
		print '<a href="categorias.php">Voltar</a>';
	}
}
else {
	$categorias = Categoria::findAll();
	require_once __DIR__.'/views/listas/lista_categorias.php';
} 