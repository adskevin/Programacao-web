<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
        @import "./css/style.css";
    </style>
</head>
<body>
	<div>
	<?
		session_start();
		require_once __DIR__.'/Classes/Usuario.php';
		if(isset($_POST['nome'])){
			if ($_POST['nome'] != ''){
				$usuario = Usuario::findByName($_POST['nome']);
				if ($usuario->getNome() == $_POST['nome']){
					print ('Encontrou');
					if ($usuario->getSenha() == $_POST['senha']){
						$_SESSION['nome'] = $usuario->getNome();
						$_SESSION['id'] = $usuario->getIdUsuario();
						print('<br>');
						print($_SESSION['nome']);
						print ('<br>Logado');
						print('<br><a href="index.php">Voltar</a>');
					}else{
						print ('Senha incorreta');
					}
				}else{
					print('Usuário não encontrado');
					print('<br><a href="login.php">Tentar novamente</a>');
				}
			}else{
				print('Usuário não encontrado');
				print('<br><a href="login.php">Tentar novamente</a>');
			}
		}else{
			require_once __DIR__.'/views/forms/form_login.php';
		}
		
	?>
	</div>
</body>
</html>