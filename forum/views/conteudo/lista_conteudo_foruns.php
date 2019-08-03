
<? $val = 10 ?>
<?
	require_once './Classes/Forum.php';
	$foruns = Forum::findAll();
?>

<? foreach ($foruns as $forum): ?>
	<? if($val <= 1): ?>	
		<div class="categoria_conteudo">
			<? print('<a href="#">Mais...</a>');?>
		</div>
		<? break; ?>	
	<? else: ?>
		<div class="categoria_conteudo">
			<h2>
				<a href="forum.php?idforum=<?print($forum->getIdForum());?>"> <? print($forum->getNome()); ?> </a>
			</h2>
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>