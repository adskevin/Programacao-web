
<? $val = 5 ?>
<?
	require_once './Classes/Topico.php';
	$topico = Topico::findAll();
?>

<? foreach ($topico as $topico): ?>
	<? if($val <= 1): ?>
		<? break; ?>	
	<? else: ?>
	<li>
		<a href="topico.php?idtopico=<? print($topico->getIdTopico()); ?>">
			<? print($topico->getNome()); ?>
		</a>
		<? $val = $val-1; ?>
	</li>
	<? endif; ?>
<? endforeach; ?>