<!DOCTYPE html>
<html>
<?
	
	require_once './Classes/Forum.php';
	require_once './Classes/Usuario.php';	
    session_start();
    if (isset($_GET['idforum'])){
        $forum_atual = Forum::findById($_GET['idforum']);
    }else{
        print('Erro');
	}
	
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	  }

	//   console_log( 'Categoria' );
?>
<head>
	<title>endfor|um - <? print($forum_atual->getNome()); ?></title>
	<style type="text/css">
		@import "./css/style.css";
		
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
			<div class="titulo_conteudo">
				<h1><? print($forum_atual->getNome()); ?> - Tópicos:</h1>
			</div>
			<div class="novo_algo">
				<p> <a href="novo_topico.php?idforum=<? print($forum_atual->getIdForum()); ?>">Novo Tópico</a></p>
			</div>
					<? require_once './views/conteudo/lista_conteudo_topico.php' ?>
		</div>
	</main>
	<footer>

	</footer>
</body>
</html>