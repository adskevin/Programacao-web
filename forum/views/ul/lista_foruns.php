
<? $val = 5 ?>
<?
	require_once './Classes/Forum.php';
	$foruns = Forum::findAll();
?>

<? foreach ($foruns as $forum): ?>
	<? if($val <= 1): ?>	
		<li>
		<? print('<a href="foruns.php">Mais...</a>');?>
		</li>
		<? break; ?>	
	<? else: ?>
	<li>
		<a href="forum.php?idforum=<? print($forum->getIdForum()); ?>">
			<? print($forum->getNome()); ?>
		</a>
		<? $val = $val-1; ?>
	</li>
	<? endif; ?>
<? endforeach; ?>