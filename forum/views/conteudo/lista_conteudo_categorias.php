
<? $val = 10 ?>
<?
	require_once './Classes/Categoria.php';
	$categorias = Categoria::findAll();
?>

<? foreach ($categorias as $categoria): ?>
	<? if($val <= 1): ?>	
		<div class="categoria_conteudo">
			<? print('<a href="#">Mais...</a>');?>
		</div>
		<? break; ?>	
	<? else: ?>
		<div class="categoria_conteudo">
			<h2>
				<a href="categoria.php?idcategoria=<?print($categoria->getIdCategoria());?>"> <? print($categoria->getNome()); ?> </a>
			</h2>
		</div>
		<? $val = $val-1; ?>
	<? endif; ?>
<? endforeach; ?>