<!DOCTYPE html>
<html>
<?
	
	require_once './Classes/Topico.php';
	require_once './Classes/Usuario.php';
	require_once './Classes/Post.php';
    session_start();
    if (isset($_GET['idtopico'])){
        $topico_atual = Topico::findById($_GET['idtopico']);
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
	<title>endfor|um - <? print($topico_atual->getNome()); ?></title>
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
					<h1><? print($topico_atual->getNome()); ?></h1>
					<p><? print($topico_atual->getConteudo()); ?></p>
				</div>				
			</div>
			<?
				if(!isset($_SESSION['nome'])){
					print 'Você precisa estar logado para alterar um tópico.';
					print '<a href="login.php">Login</a>';				
				}else {
					if (!empty($_POST)) {
						$usuario = Usuario::findById($_SESSION['id']);
						$topico = Topico::findById($topico_atual->getIdTopico());
						$topico->setNome($_POST['nome']);
						console_log( $topico->getNome());
						$topico->setConteudo($_POST['conteudo']);
						$topico->setFkIdUsuario($usuario->getIdUsuario());
						$topico->setFkIdForum($topico_atual->getFkIdForum());
						$topico->update();
						print '<br>Topico atualizado!<br/>';
					}
					
					else {
						require_once __DIR__.'/views/forms/form_topico_edit.php';
					}
				}
			?>
			<a href="topico.php?idtopico=<? print($topico_atual->getIdTopico()); ?>">Voltar</a>
		</div>
	</main>
	<footer>

	</footer>
</body>
</html>