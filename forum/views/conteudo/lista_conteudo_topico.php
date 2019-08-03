
<? $val = 5 ?>
<?
	require_once './Classes/Topico.php';
	$topicos = Topico::findByOwner($forum_atual->getIdForum());
?>

<? foreach ($topicos as $topico): ?>
	<? if($val <= 1): ?>	
		<div class="conteudo">
			<? print('<a href="topicos.php">Mais...</a>');?>
		</div>
		<? break; ?>	
	<? else: ?>
		<div class="conteudo">
			<a href="topico.php?idtopico=<? print($topico->getIdTopico()); ?>">
				<h2 id="titulo_topico_conteudo"><? print($topico->getNome()); ?></h2>
			</a>
			<p><? print($topico->getConteudo()); ?></p>
			<div class="controles">
				<div class="controles_esquerda">
					<? $usuario = Usuario::findById($topico->getFkIdUsuario()); ?>
					<p>Criador: <? print($usuario->getNome()); ?></p>
				</div>
				<div class="controles_direita">
					<? if (isset($_SESSION['id'])): ?>
						<? if ($usuario->getIdUsuario() == $_SESSION['id']): ?>
							<p> - <a href="editar_topico.php?idtopico=<? print($topico->getIdTopico()); ?>">Editar tópico</a></p>
							<p> - <a href="excluir_topico.php?idtopico=<? print($topico->getIdTopico()); ?>">Excluir tópico</a></p>
						<? endif; ?>
					<? endif; ?>
				</div>
			</div>
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>