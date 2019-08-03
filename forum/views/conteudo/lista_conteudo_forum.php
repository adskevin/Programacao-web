
<? $val = 5 ?>
<?
	require_once './Classes/Forum.php';
	require_once './Classes/Usuario.php';
	$foruns = Forum::findByOwner($categoria_atual->getIdCategoria());
	// console_log( $foruns );
?>

<? foreach ($foruns as $forum): ?>
	<? if($val <= 1): ?>	
		<div class="conteudo">
			<? print('<a href="foruns.php">Mais...</a>');?>
		</div>
		<? break; ?>	
	<? else: ?>
		<div class="conteudo">
			<a href="forum.php?idforum=<? print($forum->getIdForum()); ?>">
				<h2 id="titulo_forum_conteudo"><? print($forum->getNome()); ?></h2>
			</a>
			<div class="controles">
				<div class="controles_esquerda">
					<? $usuario = Usuario::findById($forum->getFkIdUsuario()); ?>
					<p>Criador: <? print($usuario->getNome()); ?></p>
				</div>
				<div class="controles_direita">
					<? if (isset($_SESSION['id'])): ?>
						<? if ($usuario->getIdUsuario() == $_SESSION['id']): ?>
							<p> - <a href="editar_forum.php?idforum=<? print($forum->getIdForum()); ?>">Editar forum</a></p>
							<p> - <a href="excluir_forum.php?idforum=<? print($forum->getIdForum()); ?>">Excluir forum</a></p>
						<? endif; ?>
					<? endif; ?>
				</div>
			</div>
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>