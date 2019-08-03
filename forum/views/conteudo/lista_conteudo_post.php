
<? $val = 5 ?>
<?
	require_once './Classes/Post.php';
	$posts = Post::findByOwner($topico_atual->getIdTopico());
?>

<? foreach ($posts as $post): ?>
	<? if($val <= 1): ?>	
		<div class="conteudo">
			<? print('<a href="topicos.php">Mais...</a>');?>
		</div>
		<? break; ?>	
	<? else: ?>
		<div class="conteudo">
			<div class="area_post">
				<h2 id="titulo_topico_conteudo"><? print($post->getNome()); ?></h2>
				
				<p><? print($post->getConteudo()); ?></p>
			</div>
			<div class="controles">
				<div class="controles_esquerda">
					<? $usuario = Usuario::findById($post->getFkIdUsuario()); ?>
					<p>OP: <? print($usuario->getNome()); ?></p>
				</div>
				<div class="controles_direita">
					<? if (isset($_SESSION['id'])): ?>
						<? if ($usuario->getIdUsuario() == $_SESSION['id']): ?>
							<p> - <a href="editar_post.php?idpost=<? print($post->getIdPost()); ?>">Editar post</a></p>
							<p> - <a href="excluir_post.php?idpost=<? print($post->getIdPost()); ?>">Excluir post</a></p>
						<? endif; ?>
					<? endif; ?>
				</div>
			</div>
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>