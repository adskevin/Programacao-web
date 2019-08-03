<!DOCTYPE html>
<html>
<?
	
	require_once './Classes/Topico.php';
	require_once './Classes/Usuario.php';
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
				<div class="conteudo_baixo">
					<div class="conteudo_esquerda">
						<? $usuario = Usuario::findById($topico->getFkIdUsuario()); ?>
						<p>OP: <? print($usuario->getNome()); ?></p>
					</div>
					<div class="conteudo_direita">
						<p>
							<? if (isset($_SESSION['id'])): ?>							
								<? if ($usuario->getIdUsuario() == $_SESSION['id']): ?>									
									- <a href="editar_topico.php?idtopico=<? print($topico_atual->getIdTopico()); ?>">Editar tópico</a>									
								<? endif; ?>
							<? endif; ?>
							- <a href="responder_topico.php?idtopico=<? print($topico_atual->getIdTopico()); ?>">Responder</a>
						</p>
					</div>
				</div>
			</div>
					<? require_once './views/conteudo/lista_conteudo_post.php' ?>
		</div>
	</main>
	<footer>

	</footer>
</body>
</html>