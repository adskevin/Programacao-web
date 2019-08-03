
<? $val = 5 ?>
<?
	require_once './Classes/Topico.php';
	$topicos = Topico::findAll();
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
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>