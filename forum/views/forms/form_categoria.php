<form method="post">
	<label for="nome">Nome:</label>
	<input type="text" name="nome" id="nome" 
		value="<?=$categoria->getNome()?>" /> <br/>
	<input type="submit" 
		value="<?=(isset($_GET['id']) ? 'Atualizar' : 'Criar')?>"/>
</form>

<a href="categorias.php">Voltar</a>