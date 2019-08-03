<!DOCTYPE html>
<html>
<head>
	<title>Fórum</title>
	<style type="text/css">
        @import "./css/style.css";
    </style>
</head>
<body>
	<div>
		<?
			session_start();
			if(isset($_SESSION['nome'])){
				print $_SESSION['nome'];
				print ' - ';
				print $_SESSION['id'];
			}else{
				print('não tem usuario logado');
			}
		?>
		<ul>
			<li><a href="usuarios.php">CRUD Usuários</a></li>
			<li><a href="categorias.php">Categorias</a></li>
			<li><a href="foruns.php">Fóruns</a></li>
			<li><a href="topicos.php">Tópicos</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="destroisessao.php">Sair</a></li>
		</ul>
	</div>
</body>
</html>