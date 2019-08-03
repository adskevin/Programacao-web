<!DOCTYPE html>
<html>
<?
	
	require_once './Classes/Categoria.php';
	require_once './Classes/Forum.php';
	require_once './Classes/Usuario.php';

	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	  }

    session_start();
    if (isset($_GET['idforum'])){
		// console_log( $_GET['idpost'] );
		$forum_atual = Forum::findById($_GET['idforum']);
		// console_log( $post_atual->getNome() );
    }else{
        print('Erro');
	}
	
?>
<head>
	<? $categoria_atual = Categoria::findById($forum_atual->getFkIdCategoria()) ?>
	<title>endfor|um - <? print($forum_atual->getNome()); ?></title>
	<style type="text/css">
		@import "./css/style.css";
		@import "./css/style_topico.css";
		
    </style>
</head>
<body>
	<header>
		<div id="div_logo">
			<a href="index.php">
				<img src="./img/endforum_logo_no-back_small.png" alt="Logo endforum.">
			</a>
		</div>
		<div id="div_pesquisa">
			<!-- Pesquisa -->
		</div>
		<div id="div_usuario">
			<div id="conteudo_usuario">
				<?
					// session_start();
					if(isset($_SESSION['nome'])){
						print('<p>Bem-vindo(a), '.$_SESSION['nome']);
						print(' - <a href="sair.php">Sair</a></p>');
					}else{
						print('<p><a href="login.php">Login</a></p>');
					}
				?>
			</div>
		</div>
	</header>
	<main>
		<div id="menu_lateral">
			<div id="lista_lateral">
				<ul><a href="categorias.php">Categorias:</a>
					<? require_once './views/ul/lista_categorias.php' ?>
				</ul>
				<ul><a href="foruns.php">Fóruns:</a>
					<? require_once './views/ul/lista_foruns.php' ?>
				</ul>
				<ul>Últimos Tópicos:
					<? require_once './views/ul/lista_topicos.php' ?>
				</ul>
			</div>
		</div>
		<div id="lateral_direita">
			<div class="conteudo">
				<div>
					<h1><? print($forum_atual->getNome()); ?></h1>
				</div>
			</div>
			<?
				if(!isset($_SESSION['nome'])){
					print 'Você precisa estar logado para alterar um forum.';
					print '<a href="login.php">Login</a>';				
				}else {
					if (!empty($_POST)) {
						$usuario = Usuario::findById($_SESSION['id']);
						$forum_atual = Forum::findById($forum_atual->getIdForum());
						$forum_atual->setNome($_POST['nome']);
						console_log( $forum_atual->getNome());
						$forum_atual->setFkIdUsuario($usuario->getIdUsuario());
						$forum_atual->setFkIdCategoria($forum_atual->getFkIdCategoria());
						$forum_atual->update();
						print '<br>Forum atualizado!<br/>';
					}
					
					else {
						require_once __DIR__.'/views/forms/form_forum_edit.php';
					}
				}
			?>
			<a href="categoria.php?idcategoria=<? print($categoria_atual->getIdCategoria()); ?>">Voltar</a>
		</div>
	</main>
	<footer>

	</footer>
</body>
</html>