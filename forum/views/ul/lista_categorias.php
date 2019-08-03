
<? $val = 5 ?>
<?
	require_once './Classes/Categoria.php';
	$categorias = Categoria::findAll();
?>

<? foreach ($categorias as $categoria): ?>
	<? if($val <= 1): ?>	
		<li>
		<? print('<a href="categorias.php">Mais...</a>'); ?>
		</li>
		<? break; ?>	
	<? else: ?>
	<li>
		<a href="./categoria.php?idcategoria=<? print($categoria->getIdCategoria()); ?>">
			<? print($categoria->getNome()); ?>
		</a>
		<? $val = $val-1; ?>
	</li>
	<? endif; ?>
<? endforeach; ?>